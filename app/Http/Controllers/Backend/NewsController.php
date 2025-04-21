<?php

namespace App\Http\Controllers\Backend;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(News::withoutGlobalScope('published'))
                ->addIndexColumn() // Thêm số thứ tự
                ->addColumn('status', function ($row) {
                    return '
                    <div class="radio-container">
                        <label class="toggle">
                            <input type="checkbox" class="status-change update-status" data-id="' . $row->id . '" ' . ($row->status == 1 ? 'checked' : '') . '>
                            <span class="slider"></span>
                        </label>
                    </div>
                ';
                })
                ->editColumn('category_name', fn($row) => $row->Category->name ?? 'Chưa có danh mục')
                ->addColumn('posted_at', function ($row) {
                    return Carbon::parse($row->posted_at)->format('d/m/Y');
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group">
                            <button class="btn btn-danger btn-sm delete-btn" data-url="' . route('admin.news.destroy', $row->id) . '">    <i class="fas fa-trash-alt"></i></button>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('backend.news.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allTags = Tag::all();

        $categories  = Category::query()->type('posts')->latest()->pluck('name', 'id');
        return view('backend.news.create', compact('categories', 'allTags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payloads = $request->validate([
            'category_id'       => 'required|exists:sgo_categories,id',
            'subject'           => 'required|string|max:255|unique:sgo_news,subject',
            'short_name'        => 'nullable|string|max:100|unique:sgo_news,short_name',
            'slug'              => 'required|string|max:255|unique:sgo_news,slug',
            'posted_at'         => 'nullable|date_format:d-m-Y|after_or_equal:today',
            'article'           => 'required|string',
            'is_favorite'       => 'nullable',
            'view'              => 'nullable|integer|min:0',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string|max:300',
            'status'            => 'required|in:1,2', // hoặc: '0,1,2' tùy hệ thống bạn định nghĩa
            'summary'           => 'nullable|string|max:500',
            'featured_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB
            'tags'              => 'nullable|array',
            'tags.*'            => 'string',
        ], __('request.messages'), [
            'category_id'       => 'danh mục',
            'subject'           => 'tiêu đề',
            'short_name'        => 'tên ngắn',
            'slug'              => 'đường dẫn (slug)',
            'posted_at'         => 'ngày đăng',
            'article'           => 'nội dung',
            'is_favorite'       => 'bài viết nổi bật',
            'view'              => 'lượt xem',
            'seo_title'         => 'tiêu đề SEO',
            'seo_description'   => 'mô tả SEO',
            'status'            => 'trạng thái',
            'summary'           => 'tóm tắt',
            'featured_image'    => 'hình ảnh nổi bật',
            'tags'              => 'thẻ',
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('featured_image')) {
                $payloads['featured_image'] = saveImage($request, 'featured_image', 'news');
            }

            $payloads['posted_at'] ??= now()->format('d-m-Y');

            if ($news = News::create($payloads)) {
                $this->newTags($request, $news);
            }

            DB::commit();
            toastr()->success('Thêm bài viết thành công.');
            return redirect()->route('admin.news.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            toastr()->error('Có lỗi xảy ra trong quá trình thêm bài viết.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::withoutGlobalScope('published')->findOrFail($id);
        $categories  = Category::query()->where('type', 'posts')->latest()->pluck('name', 'id');

        $allTags = Tag::all();

        $tagSelectedId = $news->tags->pluck('id')->toArray();

        return view('backend.news.edit', compact('news', 'categories', 'allTags', 'tagSelectedId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $payloads = $request->validate([
            'category_id'       => 'required|exists:sgo_categories,id',
            'subject'           => 'required|string|max:255|unique:sgo_news,subject,' . $id,
            'short_name'        => 'nullable|string|max:100|unique:sgo_news,short_name,' . $id,
            'slug'              => 'required|string|max:255|unique:sgo_news,slug,' . $id,
            'posted_at'         => 'nullable|date_format:d-m-Y|after_or_equal:today',
            'article'           => 'required|string',
            'is_favorite'       => 'nullable',
            'view'              => 'nullable|integer|min:0',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string|max:300',
            'status'            => 'required|in:1,2', // hoặc: '0,1,2' tùy hệ thống bạn định nghĩa
            'summary'           => 'nullable|string|max:500',
            'featured_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB
            'tags'              => 'nullable|array',
            'tags.*'            => 'string',
        ], __('request.messages'), [
            'category_id'       => 'danh mục',
            'subject'           => 'tiêu đề',
            'short_name'        => 'tên ngắn',
            'slug'              => 'đường dẫn (slug)',
            'posted_at'         => 'ngày đăng',
            'article'           => 'nội dung',
            'is_favorite'       => 'bài viết nổi bật',
            'view'              => 'lượt xem',
            'seo_title'         => 'tiêu đề SEO',
            'seo_description'   => 'mô tả SEO',
            'status'            => 'trạng thái',
            'summary'           => 'tóm tắt',
            'featured_image'    => 'hình ảnh nổi bật',
            'tags'              => 'thẻ',
        ]);

        try {
            DB::beginTransaction();
            $news = News::withoutGlobalScope('published')->findOrFail($id);
            $oldImage = $news->featured_image;

            if ($request->hasFile('featured_image')) {
                $payloads['featured_image'] = saveImage($request, 'featured_image', 'news');
            }

            $payloads['posted_at'] ??= now()->format('d-m-Y');

            if ($news->update($payloads)) {
                if (!empty($payloads['featured_image'])) {
                    deleteImage($oldImage);
                }

                $this->newTags($request, $news);
            }


            DB::commit();
            toastr()->success('Chỉnh sửa bài viết thành công.');
            return redirect()->route('admin.news.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            toastr()->error('Có lỗi xảy ra trong quá trình cập nhật bài viết.');
            return redirect()->back()->withInput();
        }
    }

    protected function newTags($request, $new)
    {
        if ($request->has('tags')) {
            $tags = $request->input('tags');

            foreach ($tags as $key => $tag) {
                $tags[$key] = Tag::firstOrCreate(['tag' => $tag]);
            }

            $formattedTags = collect($tags)->map(fn($tag) => [
                'tag_id' => $tag->id,
            ])->toArray();

            $new->tags()->sync($formattedTags);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::withoutGlobalScope('published')->findOrFail($id);

        deleteImage($news->featured_image);

        $news->delete();

        return response()->json([
            'status' => true,
            'message' => 'News item deleted successfully'
        ]);
    }

    public function changeStatus(Request $request)
    {
        $news = News::withoutGlobalScope('published')->find($request->id);

        if (!$news) {
            return response()->json([
                'status' => false,
            ]);
        }

        $news->status = 'published' == $news->status ? 'unpublished' : 'published';
        $news->save();

        return response()->json([
            'status' => true
        ]);
    }
}

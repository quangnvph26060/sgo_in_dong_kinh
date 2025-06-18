<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Backend\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Category::query())
                ->addIndexColumn()
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
                ->editColumn('created_at', fn($row) => $row->created_at->format('d-m-Y'))
                ->editColumn('image', fn($row) => "<img class='img-fluid' src='" . showImage($row->image) . "' />")
                ->addColumn('action', function ($row) {
                    return '
                        <a class="btn btn-sm btn-warning" href="' . route('admin.category.edit', $row->id) . '"><i class="fas fa-edit"></i></a>
                        <div class="btn-group">
                            <button class="btn btn-danger btn-sm delete-btn" data-url="' . route('admin.category.destroy', $row->id) . '">    <i class="fas fa-trash-alt"></i></button>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action', 'image'])
                ->make(true);
        }


        return view('backend.category.index');
    }

    protected function validated($request, $id = null)
    {
        $payloads = $request->validate([
            'name'              => 'required|string|max:255|unique:sgo_categories,name,' . $id,
            'slug'              => 'required|string|max:255|unique:sgo_categories,slug,' . $id,
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description'       => 'nullable|string',
            'title_seo'         => 'nullable|string|max:255',
            'description_seo'   => 'nullable|string|max:300',
            'type'              => 'required|in:products,posts', // hoặc kiểu int như 'required|in:1,2,3'
            'status'            => 'required|in:1,2',
        ], __('request.messages'), [
            'name'              => 'tên',
            'slug'              => 'đường dẫn',
            'image'             => 'hình ảnh',
            'banner'            => 'banner',
            'description'       => 'mô tả',
            'title_seo'         => 'tiêu đề SEO',
            'description_seo'   => 'mô tả SEO',
            'type'              => 'loại',
            'status'            => 'trạng thái',
        ]);

        return $payloads;
    }


    public function update(Request $request, $id)
    {

        $payloads =  $this->validated($request, $id);

        $category = Category::query()->findOrFail($id);

        $oldImage = $category->image;

        if ($request->hasFile('image')) {
            $payloads['image'] = saveImage($request, 'image', 'categories');
        }

        if ($request->hasFile('banner')) {
            $payloads['banner'] = saveImage($request, 'banner', 'categories');
        }

        if ($category->update($payloads)) {
            if (!empty($payloads['image'])) {
                deleteImage($oldImage);
            }

            if (!empty($payloads['banner'])) {
                deleteImage($oldImage);
            }

            toastr()->success('Cập nhật danh mục thành công');
            return redirect()->route('admin.category.index');
        }

        toastr()->error('Cập nhật danh mục thất bại');
        return redirect()->back();
    }

    public function create()
    {
        return view('backend.category.save');
    }

    public function store(Request $request)
    {
        $payloads =  $this->validated($request);

        if ($request->hasFile('image')) {
            $payloads['image'] = saveImage($request, 'image', 'categories');
        }

        if (Category::query()->create($payloads)) {
            toastr()->success('Thêm danh mục thành công');
            return redirect()->route('admin.category.index');
        }

        toastr()->error('Thêm danh mục thất bại');
        return redirect()->back();
    }


    public function destroy($id)
    {

        $category = Category::findOrFail($id);

        if ($category->delete()) {
            deleteImage($category->image);
            return response()->json(['success' => true, 'message' => 'Xóa danh mục thành công']);
        }
        return response()->json(['success' => false, 'message' => 'Xóa danh mục thất bại']);
    }


    public function edit($id)
    {
        try {
            $category = Category::find($id);
            return view('backend.category.save', compact('category'));
        } catch (Exception $e) {
            Log::error('Failed to find this Category: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Tìm danh mục thất bại']);
        }
    }

    public function updateCategoryStatus(Request $request)
    {
        try {
            $category = Category::findOrFail($request->id);
            $category->status = $category->status == 1 ? 2 : 1;

            $category->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật danh mục thành công']);
        } catch (Exception $e) {
            Log::error('Failed to update category status: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Cập nhật danh mục thất bại']);
        }
    }
}

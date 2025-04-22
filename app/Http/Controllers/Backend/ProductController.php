<?php

namespace App\Http\Controllers\Backend;

use Exception;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\Backend\ProductService;
use Carbon\Carbon;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            DB::reconnect();
            return datatables()->of(Product::select(['id', 'image', 'name', 'short_name', 'sku', 'status', 'price', 'sale_price', 'category_id'])->with('category'))
                ->addColumn('image', function ($row) {
                    return '<img src="' . showImage($row->image) . '" class="img-fluid" style="width: 50px; height: 50px;" />';
                })
                ->addColumn('category_id', function ($row) {
                    return $row->category->name ?? '';
                })
                ->addColumn('status', function ($row) {
                    return $row->status ? 'Còn hàng' : 'Hết hàng';
                })
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
                ->addColumn('action', function ($row) {
                    return '
                <div class="btn-group">
                    <button class="btn btn-danger btn-sm delete-btn" data-url="' . route('admin.product.delete', $row->id) . '">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            ';
                })
                ->rawColumns(['status', 'action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('backend.product.index');
    }



    public function add()
    {
        $categories = Category::type('products')->get();

        return view('backend.product.add', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $payloads = $request->validate([
            'name' => 'required|string|max:255|unique:sgo_products,name,' . $id,
            'slug' => 'required|string|max:255|unique:sgo_products,slug,' . $id,
            'short_name' => 'nullable|string|max:255',
            'price' => 'required|regex:/^\d{1,3}(?:\.\d{3})*(?:,\d{2})?$/',
            'sale_price' => 'nullable|regex:/^\d{1,3}(?:\.\d{3})*(?:,\d{2})?$/',
            'start_date' => 'required|date_format:d-m-Y H:i',
            'end_date' => 'nullable|date_format:d-m-Y H:i|after_or_equal:start_date',
            'sku' => 'nullable|string|max:50',
            'view_count' => 'nullable|integer|min:0',
            'short_description' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'status' => 'required|in:1,2',
            'is_top' => 'nullable|boolean',
            'category_id' => 'required|exists:sgo_categories,id',
            'is_advertisement' => 'nullable|boolean',
            'is_tet_edition' => 'nullable|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'advertisement_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description_seo' => 'nullable|string|max:255',
            'title_seo' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ], __('request.messages'), [ // 👇 Friendly attribute labels
            'name' => 'tên sản phẩm',
            'slug' => 'đường dẫn sản phẩm',
            'short_name' => 'tên ngắn',
            'price' => 'giá gốc',
            'sale_price' => 'giá khuyến mãi',
            'start_date' => 'ngày bắt đầu',
            'end_date' => 'ngày kết thúc',
            'sku' => 'mã SKU',
            'view_count' => 'lượt xem',
            'short_description' => 'mô tả ngắn',
            'description' => 'mô tả chi tiết',
            'status' => 'trạng thái',
            'is_top' => 'sản phẩm nổi bật',
            'category_id' => 'danh mục',
            'is_advertisement' => 'hiển thị quảng cáo',
            'is_tet_edition' => 'phiên bản tết',
            'images' => 'hình ảnh sản phẩm',
            'images.*' => 'tệp hình ảnh',
            'advertisement_image' => 'ảnh quảng cáo',
            'image' => 'ảnh chính',
            'description_seo' => 'mô tả SEO',
            'title_seo' => 'tiêu đề SEO',
            'tags' => 'thẻ',
        ]);

        // ✅ Convert price formats "199.000" => 199000
        $payloads['price'] = (int) str_replace('.', '', $payloads['price']);
        if (!empty($payloads['sale_price'])) {
            $payloads['sale_price'] = (int) str_replace('.', '', $payloads['sale_price']);
        }

        $oldImage = null;
        $oldAdvertisementImage = null;

        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);

            if ($request->hasFile('image')) {
                $oldImage = $product->image;
                $payloads['image'] = saveImage($request, 'image', 'products');
            }

            if ($request->hasFile('advertisement_image')) {
                $oldAdvertisementImage = $product->advertisement_image;
                $payloads['advertisement_image'] = saveImage($request, 'advertisement_image', 'products');
            }

            foreach (['is_top', 'is_advertisement', 'is_tet_edition'] as $key) {
                $payloads[$key] = !empty($payloads[$key]) ? 1 : 2;
            }

            if ($product->update($payloads)) {
                if (!empty($payloads['image'])) {
                    deleteImage($oldImage);
                }
                if (!empty($payloads['advertisement_image'])) {
                    deleteImage($oldAdvertisementImage);
                }

                $this->productImages($request, $product);
                $this->productTags($request, $product);
                toastr()->success('Cập nhật sản phẩm thành công');
            }

            DB::commit();
            return redirect()->route('admin.product.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update Product: ' . $e->getMessage());
            toastr()->error('Cập nhật sản phẩm thất bại');
            return redirect()->back();
        }
    }

    protected function productImages($request, $product)
    {
        if ($request->hasFile('images')) {
            $images = saveImages($request, 'images', 'thumbnails', 150, 150, true);

            $formattedImages = collect($images)->map(fn($image) => [
                'image' => $image,
            ])->toArray();

            $product->images()->createMany($formattedImages);
        }
    }

    protected function productTags($request, $product)
    {
        if ($request->has('tags')) {
            $tags = $request->input('tags');

            foreach ($tags as $key => $tag) {
                $tags[$key] = Tag::firstOrCreate(['tag' => $tag]);
            }

            $formattedTags = collect($tags)->map(fn($tag) => [
                'tag_id' => $tag->id,
            ])->toArray();

            $product->tags()->sync($formattedTags);
        }
    }

    public function store(Request $request)
    {

        $payloads = $request->validate([
            'name' => 'required|string|max:255|unique:sgo_products,name',
            'slug' => 'required|string|max:255|unique:sgo_products,slug',
            'short_name' => 'nullable|string|max:255',
            'price' => 'required|regex:/^\d{1,3}(?:\.\d{3})*(?:,\d{2})?$/',
            'sale_price' => 'nullable|regex:/^\d{1,3}(?:\.\d{3})*(?:,\d{2})?$/',
            'start_date' => 'required|date_format:d-m-Y H:i',
            'end_date' => 'nullable|date_format:d-m-Y H:i|after_or_equal:start_date',
            'sku' => 'nullable|string|max:50',
            'view_count' => 'nullable|integer|min:0',
            'short_description' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'status' => 'required|in:1,2',
            'is_top' => 'nullable|boolean',
            'category_id' => 'required|exists:sgo_categories,id',
            'is_advertisement' => 'nullable|boolean',
            'is_tet_edition' => 'nullable|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'advertisement_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description_seo' => 'nullable|string|max:255',
            'title_seo' => 'nullable|string|max:255',
        ], __('request.messages'), [ // 👇 Friendly attribute labels
            'name' => 'tên sản phẩm',
            'slug' => 'đường dẫn sản phẩm',
            'short_name' => 'tên ngắn',
            'price' => 'giá gốc',
            'sale_price' => 'giá khuyến mãi',
            'start_date' => 'ngày bắt đầu',
            'end_date' => 'ngày kết thúc',
            'sku' => 'mã SKU',
            'view_count' => 'lượt xem',
            'short_description' => 'mô tả ngắn',
            'description' => 'mô tả chi tiết',
            'status' => 'trạng thái',
            'is_top' => 'sản phẩm nổi bật',
            'category_id' => 'danh mục',
            'is_advertisement' => 'hiển thị quảng cáo',
            'is_tet_edition' => 'phiên bản tết',
            'images' => 'hình ảnh sản phẩm',
            'images.*' => 'tệp hình ảnh',
            'advertisement_image' => 'ảnh quảng cáo',
            'image' => 'ảnh chính',
            'description_seo' => 'mô tả SEO',
            'title_seo' => 'tiêu đề SEO',
        ]);


        // ✅ Convert price formats "199.000" => 199000
        $payloads['price'] = (int) str_replace('.', '', $payloads['price']);
        if (!empty($payloads['sale_price'])) {
            $payloads['sale_price'] = (int) str_replace('.', '', $payloads['sale_price']);
        }

        try {
            DB::beginTransaction();

            foreach (['is_top', 'is_advertisement', 'is_tet_edition'] as $key) {
                $payloads[$key] = !empty($payloads[$key]) ? 1 : 2;
            }

            $payloads['image'] = saveImage($request, 'image', 'products');
            $payloads['advertisement_image'] = saveImage($request, 'advertisement_image', 'products');

            if ($product = Product::create($payloads)) {
                $this->productImages($request, $product);
                $this->productTags($request, $product);
                toastr()->success('Thêm sản phẩm thành công');
            }

            DB::commit();
            return redirect()->route('admin.product.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create Product: ' . $e->getMessage());
            toastr()->error('Thêm sản phẩm thất bại');
            return redirect()->back();
        }
    }


    public function delete($id)
    {
        try {
            $this->productService->deleteProduct($id);

            return response()->json([
                'status' => true,
                'message' => 'Xóa sản phẩm thành công',
            ]);
        } catch (Exception $e) {
            Log::error('Failed to delete this Product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xóa sản phẩm thất bại',
            ]);
        }
    }

    public function deleteImage($id)
    {
        $data = explode('-', $id);

        $product = Product::findOrFail($data[0]);

        $images = $product->images;

        if (isset($images[$data[1]])) {

            deleteImage($images[$data[1]]);

            unset($images[$data[1]]);

            $product->images = array_values($images);

            $product->save();

            return response()->json(['status' => true, 'message' => 'Ảnh đã được xóa!']);
        }

        return response()->json(['status' => false, 'message' => 'Ảnh không tồn tại!']);
    }

    public function detail($id)
    {
        try {
            $categories = Category::type('products')->get();
            $product = Product::with('images')->find($id);

            $albums = $product->images->map(fn($image, $index) => [
                'src' => showImage($image->image),
                'id' => $index + 1,
            ])->toArray();

            $allTags = Tag::all();

            $tagSelectedId = $product->tags->pluck('id')->toArray();

            return view('backend.product.edit', compact('product', 'categories', 'albums', 'allTags', 'tagSelectedId'));
        } catch (Exception $e) {
            Log::error('Failed to find this Product: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Tìm sản phẩm thất bại']);
        }
    }

    public function changeStatus(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại trên hệ thống!',
            ]);
        }

        $product->status = $product->status == 1 ? 0 : 1;
        $product->updated_at = now();

        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công',
        ]);
    }

    // ProductController.php

    public function updateDisplayPosition(Request $request)
    {
        $product = Product::find($request->id);

        if ($product) {
            $product->display_position = $request->display_position;
            $product->save();

            // Trả về phản hồi thành công
            return response()->json(['success' => true]);
        }

        // Trả về lỗi nếu không tìm thấy sản phẩm
        return response()->json(['success' => false], 400);
    }

    public function search(Request $request)
    {
        $query = trim($request->get('q', ''));
        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $perPage = 10;
        $page = (int) $request->get('page', 1);

        $products = Product::where('name', 'like', "%{$query}%")
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get(['id', 'name', 'image']);

        return response()->json($products);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\QuoteRequestMail;
use App\Models\Category;
use App\Models\Form;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function list()
    {
        $query = Product::query();

        $query = $this->filter($query);

        $products = $query->active()->paginate(12)->appends(request()->query());

        $pageName = 'Sản phẩm';

        return view('frontend.pages.shop', compact('products', 'pageName'));
    }

    public function listFastProduct()
    {
        $query = Product::query();

        $query->where('is_fast_print', 1);

        $query = $this->filter($query);

        $products = $query->active()->paginate(12)->appends(request()->query());

        $pageName = 'Sản phẩm in nhanh';

        return view('frontend.pages.shop', compact('products', 'pageName'));
    }

    public function detail($categorySlug, $productSlug)
    {
        $product = Product::query()->with(['category', 'images', 'tags'])->where(['slug' => $productSlug, 'status' => 1])->firstOrFail();
        $tags = $product->tags?->pluck('tag', 'slug')->toArray();
        $images = array_merge(
            [$product->image],
            $product->images ? $product->images->pluck('image')->toArray() : []
        );

        $relatedProducts = Product::query()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->with('category')
            ->latest()
            ->take(10)
            ->get();

        return view('frontend.pages.product-detail', compact('product', 'images', 'tags', 'relatedProducts'));
    }

    public function quoteRequest(Request $request)
    {
        $ip = $request->ip();
        $cacheKey = 'quote_request_' . $ip;

        if (Cache::has($cacheKey)) {
            return response()->json([
                'message' => 'Bạn đã gửi yêu cầu báo giá gần đây. Vui lòng thử lại sau 5 phút.'
            ], 429); // HTTP 429 Too Many Requests
        }

        $payloads = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'notes' => 'required',
                'productId' => 'nullable|exists:sgo_products,id',
            ],
            __('request.messages'),
            [
                'name' => 'Họ tên',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'notes' => 'Nội dung',
                'productId' => 'Sản phẩm',
            ]
        );

        if ($payloads['productId']) {
            $payloads['productName'] = Product::find($payloads['productId'])?->name;
        }

        Form::create([
            'product_id' => $payloads['productId'],
            'name' => $payloads['name'],
            'email' => $payloads['email'],
            'phone' => $payloads['phone'],
            'message' => $payloads['notes'],
        ]);

        // Gửi mail
        Mail::to(config('mail.to'))->send(new QuoteRequestMail($payloads));

        // Lưu cache để chặn tiếp trong 5 phút
        Cache::put($cacheKey, true, now()->addMinutes(5));

        return response()->json(['message' => 'Gửi yêu cầu báo giá thành công!']);
    }

    public function categoryProduct($slug)
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail();

        $query = Product::query()->where('category_id', $category->id);

        $query = $this->filter($query);

        $products = $query->active()->paginate(12)->appends(request()->query());

        $pageName = $category->name;

        return view('frontend.pages.shop', compact('category', 'products', 'pageName'));
    }


    public function tagProduct($slug)
    {
        $tag = Tag::query()->where('slug', $slug)->firstOrFail();

        $query = Product::query()->whereHas('tags', function ($query) use ($tag) {
            $query->where('id', $tag->id);
        });

        $query = $this->filter($query);

        $products = $query->active()->paginate(12)->appends(request()->query());

        $pageName = $tag->tag;

        return view('frontend.pages.shop', compact('products', 'pageName'));
    }

    public function filter($query)
    {
        $orderby = request('orderby');
        $now = now()->toDateTimeString();

        switch ($orderby) {
            case 'popularity':
                $query->orderByDesc('view_count');
                break;
            case 'date':
                $query->orderByDesc('created_at');
                break;
            case 'price':
            case 'price-desc':
                $direction = $orderby === 'price-desc' ? 'DESC' : 'ASC';

                $rawPrice = "
                    IF(
                        sale_price > 0 AND
                        (
                            (start_date IS NULL AND end_date IS NULL)
                            OR
                            (start_date IS NOT NULL AND end_date IS NOT NULL AND start_date <= '$now' AND end_date >= '$now')
                            OR
                            (start_date IS NOT NULL AND end_date IS NULL AND start_date <= '$now')
                            OR
                            (start_date IS NULL AND end_date IS NOT NULL AND end_date >= '$now')
                        ),
                        sale_price,
                        price
                    )
                ";

                $query->orderByRaw("{$rawPrice} {$direction}");
                break;
            default:
                $query->orderByDesc('id');
                break;
        }

        return $query;
    }
}

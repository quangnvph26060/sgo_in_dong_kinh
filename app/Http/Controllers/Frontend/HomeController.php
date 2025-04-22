<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\News;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Support;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        if (request()->has('s')) {

            $products = new ProductController();

            $pageName = 'Kết quả tìm kiếm cho từ khóa: ' . request()->input('s');

            $query = Product::query();

            $products = $products->filter($query);

            $products = $products->where('name', 'like', '%' . request()->input('s') . '%')->active()->paginate(12)->appends(request()->query());

            return view('frontend.pages.shop', compact('products', 'pageName'));
        }

        $sliders = Slider::query()->orderByDesc('position')->get();

        // $advertisementProducts = Product::query()
        //     ->where('is_advertisement', 1)
        //     ->orderByDesc('updated_at')
        //     ->limit(3)
        //     ->get();

        // $topViewedProducts = Product::query()
        //     ->with('category')
        //     ->active()
        //     ->orderByDesc('view_count')
        //     ->limit(6)
        //     ->get();

        $labels = Label::query()
            ->whereHas('products') // chỉ lấy label có sản phẩm
            ->with(['products.category' => function ($query) {
                $query->latest('updated_at')->limit(7); // lấy tối đa 6 sản phẩm mới nhất
            }])
            ->orderBy('position') // sắp xếp label theo position giảm dần
            ->get();

        $postsNews = News::query()
            ->where('posted_at', '<=', now()) //(chỉ lấy các bài đã được đăng)
            ->latest('posted_at')
            ->limit(9)
            ->get();

        $supports = Support::query()->orderBy('id', 'asc')->get();

        return view('frontend.pages.home', compact('sliders', 'labels', 'postsNews', 'supports'));
    }
}

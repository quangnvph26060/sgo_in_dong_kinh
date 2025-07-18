<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\introStep;
use App\Models\Label;
use App\Models\News;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Support;
use App\Models\Partner;
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
        // ->orderByDesc('position')
        $categoriesPageHome = Category::query()->active()->get();

        $products = Product::query()
            ->whereHas('category', function ($q) {
                $q->where('status', 1);
            })
            ->with('category')
            ->where('is_top', 1)
            ->active()
            ->orderByDesc('updated_at')
            ->limit(15)
            ->get();

        $postsNews = News::query()
            ->where('posted_at', '<=', now()) //(chỉ lấy các bài đã được đăng)
            ->latest('posted_at')
            ->limit(6)
            ->get();

        $introStep = IntroStep::query()->orderBy('id', 'asc')->first();

        $contents = $introStep->content ?? [];

        $supports = Support::query()->orderBy('id', 'asc')->get();

        $partners = Partner::where('status', 1)->orderBy('location', 'asc')->get();

        return view('frontend.pages.home', compact('sliders', 'postsNews', 'supports', 'categoriesPageHome', 'products', 'contents', 'introStep', 'partners'));
    }
}

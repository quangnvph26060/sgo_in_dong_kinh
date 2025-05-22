<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Blade::component('frontend.components.sidebar', 'sidebar');
        // Blade::component('frontend.components.breadcrumb', 'breadcrumb');

        // View::composer('frontend.components.sidebar', function ($view) {
        //     $view->with([
        //         'popularNews' => News::latest('view')->limit(3)->get(),
        //         'latestProduct' => Product::latest()->first(),
        //     ]);
        // });

        View::composer(['frontend.includes.header', 'frontend.pages.home', 'frontend.includes.offcanvas'], function ($view) {
            $categories = Category::query()->active()->get();
            $policyCategoryIds = Category::query()
                ->whereIn('slug', ['chinh-sach', 'huong-dan-su-dung'])
                ->pluck('id')
                ->toArray(); // chuyển về mảng để dùng whereNotIn

            $posts = News::query()
                ->with('category')
                ->where('is_favorite', 1)
                ->whereNotIn('category_id', $policyCategoryIds)
                ->latest()
                ->limit(11)
                ->get();

            $view->with(
                [
                    'categories' => $categories,
                    'posts' => $posts,
                ]
            );
        });

        View::composer(['frontend.includes.footer', 'frontend.includes.header', 'frontend.pages.news', 'frontend.pages.news-detail', 'frontend.pages.shop', 'frontend.pages.product-detail'], function ($view) {
            $topProducts = Product::query()
                ->with('category')
                ->where('is_advertisement', 1)
                ->orderByDesc('created_at')
                ->active()
                ->limit(12)
                ->get();

            $tetProducts = Product::query()
                ->where('is_tet_edition', 1)
                ->with('category')
                ->orderByDesc('created_at')
                ->active()
                ->limit(6)
                ->get();

            $categoryIds = Category::whereIn('slug', ['chinh-sach'])->pluck('id');

            $policyPosts = News::query()
                ->where('posted_at', '<', now())
                ->whereIn('category_id', $categoryIds)
                ->where('status', 1)
                ->get();


            $view->with(
                [
                    'topProducts' => $topProducts,
                    'tetProducts' => $tetProducts,
                    'policyPosts' => $policyPosts
                ]
            );
        });

        View::composer('*', function ($view) {
            $view->with([
                'setting' => \App\Models\Contact::first()
                // 'categoryProduct' => Cache::remember('category_product', 60, function () {
                //     return Category::query()->where(['type' => 'products', 'status' => 1])->get();
                // })
            ]);
        });

        Paginator::useBootstrapFive();
    }
}

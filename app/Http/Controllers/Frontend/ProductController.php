<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {



        $products = Product::query()->active()->paginate(12);
        return view('frontend.pages.shop', compact('products'));
    }


    public function detail($categorySlug, $productSlug)
    {
        $product = Product::query()->with(['category', 'imgaes', 'tags'])->where('slug', $productSlug)->firstOrFail();
        $tags = $product->tags?->pluck('tag')->toArray();
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

        $bestProducts = Product::query()->active()->with('category')->where('is_top', 1)->take(12)->get();

        return view('frontend.pages.product-detail', compact('product', 'images', 'tags', 'relatedProducts', 'bestProducts'));
    }
}

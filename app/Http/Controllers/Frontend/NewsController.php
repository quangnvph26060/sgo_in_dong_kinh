<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news($slug = null)
    {
        $tags = Tag::query()->get();

        if (!empty($slug)) {
            $news = News::query()
                ->with('tags')
                ->where('slug', $slug)
                ->firstOrFail();

            $tags = $news->tags->pluck('tag', 'slug')->toArray();

            // dd($tags);

            return view('frontend.pages.news-detail', compact('news', 'tags'));
        }

        $news = News::query()->with('category')->latest('posted_at')->paginate(12);

        return view('frontend.pages.news', compact('news'));
    }
}

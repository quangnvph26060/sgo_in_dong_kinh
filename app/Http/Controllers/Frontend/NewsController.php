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
                ->with(['tags', 'category'])
                ->where('slug', $slug)
                ->firstOrFail();

            $tags = $news->tags->pluck('tag', 'slug')->toArray();

            // Lấy 4 bài viết mới nhất, trừ bài hiện tại
            $latestNews = News::query()
                ->where('id', '<>', $news->id)
                ->with('category')
                ->latest('posted_at')
                ->limit(5)
                ->get();

            // Lấy 4 bài viết liên quan (dựa vào tags hoặc category)
            $relatedNews = News::query()
                ->with('category')
                ->where('id', '<>', $news->id)
                ->whereHas('tags', function ($q) use ($news) {
                    $q->whereIn('tags.id', $news->tags->pluck('id'));
                })
                ->orWhere('category_id', $news->category_id)
                ->latest('posted_at')
                ->limit(4)
                ->get();

            return view('frontend.pages.news-detail', compact('news', 'tags', 'latestNews', 'relatedNews'));
        }

        $news = News::query()->with('category')->latest('posted_at')->paginate(12);

        return view('frontend.pages.news', compact('news'));
    }
}

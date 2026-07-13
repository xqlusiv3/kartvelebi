<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $newsList = News::query()
            ->published()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('news.index', compact('newsList'));
    }

    public function show(News $news): View
    {
        abort_unless(
            $news->is_published
            && $news->published_at
            && $news->published_at->lte(now()),
            404
        );

        $relatedNews = News::query()
            ->published()
            ->whereKeyNot($news->id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}

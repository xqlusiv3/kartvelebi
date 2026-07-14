<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $categories = [
            'Мероприятия',
            'Культура',
            'Объявления',
            'Образование',
            'Партнёрство',
        ];

        $activeCategory = $request->string('category')->toString();

        if (! in_array($activeCategory, $categories, true)) {
            $activeCategory = null;
        }

        $newsList = News::query()
            ->published()
            ->when($activeCategory, fn ($query) => $query->where('category', $activeCategory))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('news.index', compact('newsList', 'categories', 'activeCategory'));
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

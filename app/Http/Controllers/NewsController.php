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

        $activeCategory = $request->query('category');

        if (! in_array($activeCategory, $categories, true)) {
            $activeCategory = null;
        }

        $newsList = News::query()
            ->published()
            ->when($activeCategory, fn ($query) => $query->where('category', $activeCategory))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(9)
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

        $previousNews = News::query()
            ->published()
            ->where(function ($query) use ($news) {
                $query
                    ->whereDate('published_at', '>', $news->published_at)
                    ->orWhere(function ($query) use ($news) {
                        $query
                            ->whereDate('published_at', $news->published_at)
                            ->where('id', '>', $news->id);
                    });
            })
            ->orderBy('published_at')
            ->orderBy('id')
            ->first();

        $nextNews = News::query()
            ->published()
            ->where(function ($query) use ($news) {
                $query
                    ->whereDate('published_at', '<', $news->published_at)
                    ->orWhere(function ($query) use ($news) {
                        $query
                            ->whereDate('published_at', $news->published_at)
                            ->where('id', '<', $news->id);
                    });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->first();

        $relatedNews = News::query()
            ->published()
            ->whereKeyNot($news->id)
            ->when($news->category, fn ($query) => $query->where('category', $news->category))
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        if ($relatedNews->count() < 3) {
            $fallbackNews = News::query()
                ->published()
                ->whereKeyNot($news->id)
                ->whereNotIn('id', $relatedNews->pluck('id'))
                ->orderByDesc('published_at')
                ->take(3 - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->concat($fallbackNews);
        }

        return view('news.show', compact('news', 'relatedNews', 'previousNews', 'nextNews'));
    }
}

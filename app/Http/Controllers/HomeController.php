<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $homeNews = News::query()
            ->published()
            ->forHome()
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->take(8)
            ->get();

        return view('welcome', compact('homeNews'));
    }
}
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Новости — ФГНКА в России</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="top"></div>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('home') }}#top" aria-label="Вернуться на главную страницу">
                <span class="brand-symbol" aria-hidden="true">ФГ</span>

                <span class="brand-text">
                    <strong>ФГНКА</strong>
                    <small>грузин России</small>
                </span>
            </a>

            <button class="menu-toggle" type="button" aria-label="Открыть меню" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <nav class="main-nav" aria-label="Основная навигация">
                <a href="{{ route('home') }}#about">Об автономии</a>
                <a href="{{ route('news.index') }}">Новости</a>
                <a href="{{ route('home') }}#leader">Руководство</a>
                <a href="{{ route('home') }}#activity">Направления работы</a>
                <a href="{{ route('home') }}#contacts">Контакты</a>
            </nav>

            <a class="btn btn-red header-cta" href="{{ route('home') }}#join">Присоединиться</a>
        </div>
    </header>

    <main class="news-page">
        <section class="news-archive section-pad">
            <div class="container">
                <div class="news-archive-top">
                    <div class="section-title title-bordered">
                        <span>Новости и события</span>
                        <h1>Все новости автономии</h1>
                    </div>

                    <p class="news-archive-lead">
                        Актуальная хроника деятельности ФГНКА, культурных проектов, встреч, общественных инициатив и важных объявлений.
                    </p>
                </div>

                <nav class="news-filter" aria-label="Фильтр новостей по категориям">
                    <a href="{{ route('news.index') }}" @class(['is-active' => $activeCategory === null])>
                        Все
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('news.index', ['category' => $category]) }}" @class(['is-active' => $activeCategory === $category])>
                            {{ $category }}
                        </a>
                    @endforeach
                </nav>

                @if($newsList->isNotEmpty())
                    @php
                        $featuredNews = $newsList->first();
                        $regularNews = $newsList->skip(1);
                    @endphp

                    <article class="news-featured">
                        <a class="news-featured-image" href="{{ route('news.show', $featuredNews) }}" aria-label="{{ $featuredNews->title }}">
                            @if($featuredNews->image_url)
                                <img src="{{ $featuredNews->image_url }}" alt="{{ $featuredNews->title }}">
                            @else
                                <div class="news-card-placeholder">ФГНКА</div>
                            @endif
                        </a>

                        <div class="news-featured-body">
                            <div class="news-card-meta news-featured-meta">
                                @if($featuredNews->category)
                                    <span>{{ $featuredNews->category }}</span>
                                @endif

                                @if($featuredNews->published_at)
                                    <time datetime="{{ $featuredNews->published_at->format('Y-m-d') }}">
                                        {{ $featuredNews->published_at->format('d.m.Y') }}
                                    </time>
                                @endif
                            </div>

                            <h2>
                                <a href="{{ route('news.show', $featuredNews) }}">{{ $featuredNews->title }}</a>
                            </h2>

                            @if($featuredNews->excerpt)
                                <p>{{ $featuredNews->excerpt }}</p>
                            @endif

                            <a class="news-read-link" href="{{ route('news.show', $featuredNews) }}">Читать полностью →</a>
                        </div>
                    </article>

                    @if($regularNews->isNotEmpty())
                        <div class="news-list-head">
                            <span>Последние публикации</span>
                        </div>

                        <div class="news-list">
                            @foreach($regularNews as $news)
                                <article class="news-list-item">
                                    <a class="news-list-image" href="{{ route('news.show', $news) }}" aria-label="{{ $news->title }}">
                                        @if($news->image_url)
                                            <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                                        @else
                                            <div class="news-card-placeholder">ФГНКА</div>
                                        @endif
                                    </a>

                                    <div class="news-list-body">
                                        <div class="news-card-meta news-list-meta">
                                            @if($news->category)
                                                <span>{{ $news->category }}</span>
                                            @endif

                                            @if($news->published_at)
                                                <time datetime="{{ $news->published_at->format('Y-m-d') }}">
                                                    {{ $news->published_at->format('d.m.Y') }}
                                                </time>
                                            @endif
                                        </div>

                                        <h2>
                                            <a href="{{ route('news.show', $news) }}">{{ $news->title }}</a>
                                        </h2>

                                        @if($news->excerpt)
                                            <p>{{ $news->excerpt }}</p>
                                        @endif

                                        <a class="news-read-link" href="{{ route('news.show', $news) }}">Читать →</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif

                    @if($newsList->hasPages())
                        <nav class="simple-pagination" aria-label="Навигация по новостям">
                            @if($newsList->onFirstPage())
                                <span class="is-disabled">← Новее</span>
                            @else
                                <a href="{{ $newsList->previousPageUrl() }}">← Новее</a>
                            @endif

                            <span>Страница {{ $newsList->currentPage() }} из {{ $newsList->lastPage() }}</span>

                            @if($newsList->hasMorePages())
                                <a href="{{ $newsList->nextPageUrl() }}">Старее →</a>
                            @else
                                <span class="is-disabled">Старее →</span>
                            @endif
                        </nav>
                    @endif
                @else
                    <p class="news-empty">Пока опубликованных новостей в этой категории нет.</p>
                @endif
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <a class="brand brand-footer" href="{{ route('home') }}#top">
                <span class="brand-symbol brand-footer-symbol" aria-hidden="true">ФГ</span>
                <span class="brand-footer-text">Федеральная грузинская НКА в России</span>
            </a>
            <nav>
                <a href="{{ route('home') }}#about">Об автономии</a>
                <a href="{{ route('news.index') }}">Новости</a>
                <a href="{{ route('home') }}#leader">Руководство</a>
                <a href="{{ route('home') }}#activity">Направления работы</a>
                <a href="{{ route('home') }}#contacts">Контакты</a>
            </nav>
            <span>© 2026 · საქართველო</span>
        </div>
    </footer>
</body>
</html>

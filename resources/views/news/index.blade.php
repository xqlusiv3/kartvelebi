<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Новости — ФГНКА в России</title>
    <meta name="description" content="Новости и события Федеральной грузинской национально-культурной автономии в России.">
    <meta property="og:title" content="Новости — ФГНКА в России">
    <meta property="og:description" content="Актуальная хроника деятельности ФГНКА, культурных проектов, встреч и общественных инициатив.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('news.index') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="top"></div>
    <x-site-header active="news" />

    <main class="news-page">
        <section class="news-archive section-pad">
            <div class="container">
                <div class="news-archive-hero">
                    <div class="section-title title-bordered">
                        <span>Новости и события</span>
                        <h1>Все новости автономии</h1>
                    </div>

                    <p class="news-archive-lead">
                        Актуальная хроника деятельности ФГНКА, культурных проектов, встреч и общественных инициатив.
                    </p>
                </div>

                <div class="news-filter-panel" aria-label="Фильтр новостей">
                    <div class="news-filter-list">
                        <a href="{{ route('news.index') }}" class="news-filter-link {{ $activeCategory ? '' : 'is-active' }}">
                            Все
                        </a>

                        @foreach($categories as $category)
                            <a href="{{ route('news.index', ['category' => $category]) }}" class="news-filter-link {{ $activeCategory === $category ? 'is-active' : '' }}">
                                {{ $category }}
                            </a>
                        @endforeach
                    </div>

                    <span class="news-filter-count">
                        Найдено: {{ $newsList->total() }}
                    </span>
                </div>

                @if($newsList->isNotEmpty())
                    @php
                        $featuredNews = $newsList->first();
                        $archiveNews = $newsList->getCollection()->slice(1);
                    @endphp

                    <article class="news-featured-card">
                        <a href="{{ route('news.show', $featuredNews) }}" class="news-featured-link" aria-label="{{ $featuredNews->title }}">
                            <figure class="news-featured-image">
                                @if($featuredNews->image_url)
                                    <img src="{{ $featuredNews->image_url }}" alt="{{ $featuredNews->title }}">
                                @else
                                    <div class="news-card-placeholder">ФГНКА</div>
                                @endif
                            </figure>

                            <div class="news-featured-content">
                                <div class="news-card-meta news-featured-meta">
                                    <span>Главное</span>

                                    @if($featuredNews->category)
                                        <span>{{ $featuredNews->category }}</span>
                                    @endif

                                    @if($featuredNews->published_at)
                                        <time datetime="{{ $featuredNews->published_at->format('Y-m-d') }}">
                                            {{ $featuredNews->published_at->format('d.m.Y') }}
                                        </time>
                                    @endif
                                </div>

                                <h2>{{ $featuredNews->title }}</h2>

                                @if($featuredNews->excerpt)
                                    <p>{{ $featuredNews->excerpt }}</p>
                                @endif

                                <span class="text-read-link">Читать полностью <span>→</span></span>
                            </div>
                        </a>
                    </article>

                    @if($archiveNews->isNotEmpty())
                        <div class="news-list-head">
                            <h2>Последние публикации</h2>
                        </div>

                        <div class="news-list">
                            @foreach($archiveNews as $news)
                                <article class="news-list-item">
                                    <a href="{{ route('news.show', $news) }}" class="news-list-link" aria-label="{{ $news->title }}">
                                        <figure class="news-list-image">
                                            @if($news->image_url)
                                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                                            @else
                                                <div class="news-card-placeholder">ФГНКА</div>
                                            @endif
                                        </figure>

                                        <div class="news-list-content">
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

                                            <h3>{{ $news->title }}</h3>

                                            @if($news->excerpt)
                                                <p>{{ $news->excerpt }}</p>
                                            @endif

                                            <span class="text-read-link">Читать <span>→</span></span>
                                        </div>
                                    </a>
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
                    <div class="news-empty-state">
                        <h2>В этой категории пока нет новостей</h2>
                        <p>Материалы появятся здесь после публикации в админке.</p>
                        @if($activeCategory)
                            <a href="{{ route('news.index') }}" class="text-read-link">Показать все новости <span>→</span></a>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    </main>

    <x-site-footer />
</body>
</html>

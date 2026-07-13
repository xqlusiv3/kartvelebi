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
                <div class="section-title title-bordered">
                    <span>Новости и события</span>
                    <h1>Все новости автономии</h1>
                </div>

                @if($newsList->isNotEmpty())
                    <div class="news-archive-grid">
                        @foreach($newsList as $news)
                            <article class="news-card">
                                <a href="{{ route('news.show', $news) }}" class="news-card-link" aria-label="{{ $news->title }}">
                                    <figure class="news-card-image">
                                        @if($news->image_url)
                                            <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                                        @else
                                            <div class="news-card-placeholder">ФГНКА</div>
                                        @endif
                                    </figure>

                                    <div class="news-card-body">
                                        <div class="news-card-meta">
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
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

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
                    <p class="news-empty">Пока опубликованных новостей нет.</p>
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
                <a href="{{ route('home') }}#leader">Руководство</a>
                <a href="{{ route('home') }}#activity">Направления работы</a>
                <a href="{{ route('home') }}#contacts">Контакты</a>
            </nav>
            <span>© 2026 · საქართველო</span>
        </div>
    </footer>
</body>
</html>

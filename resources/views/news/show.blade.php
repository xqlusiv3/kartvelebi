<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $news->title }} — ФГНКА в России</title>
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
                <a href="{{ route('home') }}#activity">Направления работы</a>
                <a href="{{ route('home') }}#contacts">Контакты</a>
            </nav>

            <a class="btn btn-red header-cta" href="{{ route('home') }}#join">Присоединиться</a>
        </div>
    </header>

    <main class="news-single-page">
        <article class="news-single section-pad">
            <div class="container news-single-container">
                <a class="back-link" href="{{ route('news.index') }}">← Все новости</a>

                <div class="news-single-meta">
                    @if($news->category)
                        <span>{{ $news->category }}</span>
                    @endif

                    @if($news->published_at)
                        <time datetime="{{ $news->published_at->format('Y-m-d') }}">
                            {{ $news->published_at->format('d.m.Y') }}
                        </time>
                    @endif
                </div>

                <h1>{{ $news->title }}</h1>

                @if($news->excerpt)
                    <p class="news-single-excerpt">{{ $news->excerpt }}</p>
                @endif

                @if($news->image_url)
                    <figure class="news-single-image">
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                    </figure>
                @endif

                @if($news->content)
                    <div class="news-single-content">
                        {!! $news->content !!}
                    </div>
                @endif
            </div>
        </article>

        @if($relatedNews->isNotEmpty())
            <section class="related-news section-pad">
                <div class="container">
                    <div class="section-title title-bordered">
                        <span>Читайте также</span>
                        <h2>Другие новости</h2>
                    </div>

                    <div class="news-archive-grid">
                        @foreach($relatedNews as $item)
                            <article class="news-card">
                                <a href="{{ route('news.show', $item) }}" class="news-card-link" aria-label="{{ $item->title }}">
                                    <figure class="news-card-image">
                                        @if($item->image_url)
                                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                                        @else
                                            <div class="news-card-placeholder">ФГНКА</div>
                                        @endif
                                    </figure>

                                    <div class="news-card-body">
                                        <div class="news-card-meta">
                                            @if($item->category)
                                                <span>{{ $item->category }}</span>
                                            @endif

                                            @if($item->published_at)
                                                <time datetime="{{ $item->published_at->format('Y-m-d') }}">
                                                    {{ $item->published_at->format('d.m.Y') }}
                                                </time>
                                            @endif
                                        </div>

                                        <h3>{{ $item->title }}</h3>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
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

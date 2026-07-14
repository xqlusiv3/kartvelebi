<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $news->title }} — ФГНКА в России</title>
    <meta name="description" content="{{ $news->excerpt ?: 'Новость Федеральной грузинской национально-культурной автономии в России.' }}">
    <meta property="og:title" content="{{ $news->title }} — ФГНКА в России">
    <meta property="og:description" content="{{ $news->excerpt ?: 'Новость Федеральной грузинской национально-культурной автономии в России.' }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('news.show', $news) }}">
    @if($news->image_url)
        <meta property="og:image" content="{{ $news->image_url }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="top"></div>
    <x-site-header active="news" />

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

                <div class="news-share" aria-label="Поделиться новостью">
                    <span>Поделиться</span>
                    <a href="https://t.me/share/url?url={{ urlencode(route('news.show', $news)) }}&text={{ urlencode($news->title) }}" target="_blank" rel="noopener">Telegram</a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' ' . route('news.show', $news)) }}" target="_blank" rel="noopener">WhatsApp</a>
                    <button type="button" data-copy-link="{{ route('news.show', $news) }}">Скопировать ссылку</button>
                </div>

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

                <div class="news-single-bottom">
                    <a class="back-link" href="{{ route('news.index') }}">← Все новости</a>
                </div>
            </div>
        </article>

        @if($previousNews || $nextNews)
            <section class="news-neighbor-section">
                <div class="container news-single-container">
                    <div class="news-neighbor-grid">
                        @if($previousNews)
                            <a class="news-neighbor-card" href="{{ route('news.show', $previousNews) }}">
                                <span>Новее</span>
                                <strong>{{ $previousNews->title }}</strong>
                            </a>
                        @else
                            <span class="news-neighbor-card is-empty"></span>
                        @endif

                        @if($nextNews)
                            <a class="news-neighbor-card is-next" href="{{ route('news.show', $nextNews) }}">
                                <span>Старее</span>
                                <strong>{{ $nextNews->title }}</strong>
                            </a>
                        @else
                            <span class="news-neighbor-card is-empty"></span>
                        @endif
                    </div>
                </div>
            </section>
        @endif

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
                                        <span class="text-read-link">Читать <span>→</span></span>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

    <x-site-footer />
</body>
</html>

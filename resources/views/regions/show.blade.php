<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $organization->title }} — Региональная сеть ФГНКА</title>
    <meta name="description" content="{{ $organization->short_description ?: 'Региональная организация ФГНКА в России.' }}">
    <meta property="og:title" content="{{ $organization->title }} — Региональная сеть ФГНКА">
    <meta property="og:description" content="{{ $organization->short_description ?: 'Региональная организация ФГНКА в России.' }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('regions.show', $organization) }}">
    @if($organization->leader_photo_url)
        <meta property="og:image" content="{{ $organization->leader_photo_url }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="top"></div>
    <x-site-header active="regions" />

    <main class="region-single-page">
        <article class="region-single section-pad">
            <div class="container region-single-container">
                <a class="back-link" href="{{ route('regions.index') }}">← Региональная сеть</a>

                <div class="region-single-grid">
                    <div class="region-single-main">
                        <div class="region-single-meta">
                            @if($organization->federal_district)
                                <span>{{ $organization->federal_district }}</span>
                            @endif
                            @if($organization->city)
                                <span>{{ $organization->city }}</span>
                            @endif
                            @if($organization->type)
                                <span>{{ $organization->type }}</span>
                            @endif
                        </div>

                        <h1>{{ $organization->title }}</h1>

                        @if($organization->short_description)
                            <p class="region-single-excerpt">{{ $organization->short_description }}</p>
                        @endif

                        @if($organization->description)
                            <div class="region-single-content">
                                {!! $organization->description !!}
                            </div>
                        @endif

                        @if($organization->leader_bio)
                            <section class="region-info-block">
                                <h2>О руководителе</h2>
                                <p>{{ $organization->leader_bio }}</p>
                            </section>
                        @endif
                    </div>

                    <aside class="region-single-sidebar">
                        <div class="region-leader-card">
                            @if($organization->leader_photo_url)
                                <figure>
                                    <img src="{{ $organization->leader_photo_url }}" alt="{{ $organization->leader_name ?: $organization->title }}">
                                </figure>
                            @else
                                <div class="region-leader-placeholder">ФГ</div>
                            @endif

                            <div>
                                <span>Руководитель</span>
                                <strong>{{ $organization->leader_name ?: 'Информация уточняется' }}</strong>
                                @if($organization->leader_position)
                                    <small>{{ $organization->leader_position }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="region-contact-card">
                            <h2>Контакты</h2>

                            <dl>
                                @if($organization->location_label)
                                    <div>
                                        <dt>Локация</dt>
                                        <dd>{{ $organization->location_label }}</dd>
                                    </div>
                                @endif

                                @if($organization->public_address)
                                    <div>
                                        <dt>Адрес</dt>
                                        <dd>{{ $organization->public_address }}</dd>
                                    </div>
                                @endif

                                @if($organization->phone)
                                    <div>
                                        <dt>Телефон</dt>
                                        <dd><a href="tel:{{ preg_replace('/[^0-9+]/', '', $organization->phone) }}">{{ $organization->phone }}</a></dd>
                                    </div>
                                @endif

                                @if($organization->email)
                                    <div>
                                        <dt>Email</dt>
                                        <dd><a href="mailto:{{ $organization->email }}">{{ $organization->email }}</a></dd>
                                    </div>
                                @endif

                                @if($organization->website)
                                    <div>
                                        <dt>Сайт</dt>
                                        <dd><a href="{{ $organization->website }}" target="_blank" rel="noopener">Открыть сайт</a></dd>
                                    </div>
                                @endif

                                @if($organization->work_hours)
                                    <div>
                                        <dt>График связи</dt>
                                        <dd>{{ $organization->work_hours }}</dd>
                                    </div>
                                @endif
                            </dl>

                            @if(! empty($organization->social_links))
                                <div class="region-socials">
                                    @foreach($organization->social_links as $link)
                                        @continue(empty($link['url']))
                                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener">
                                            {{ $link['label'] ?? ucfirst($link['type'] ?? 'Ссылка') }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </aside>
                </div>

                <div class="news-single-bottom">
                    <a class="back-link" href="{{ route('regions.index') }}">← Все региональные организации</a>
                </div>
            </div>
        </article>

        @if($relatedOrganizations->isNotEmpty())
            <section class="related-news section-pad">
                <div class="container">
                    <div class="section-title title-bordered">
                        <span>Этот же округ</span>
                        <h2>Другие организации</h2>
                    </div>

                    <div class="regions-related-grid">
                        @foreach($relatedOrganizations as $item)
                            <article class="region-mini-card">
                                <a href="{{ route('regions.show', $item) }}">
                                    <span>{{ $item->city ?: $item->region }}</span>
                                    <h3>{{ $item->title }}</h3>
                                    @if($item->leader_name)
                                        <p>Руководитель: {{ $item->leader_name }}</p>
                                    @endif
                                    <strong class="text-read-link">Подробнее <span>→</span></strong>
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

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Региональная сеть — ФГНКА в России</title>
    <meta name="description" content="Региональные организации и представители грузинской общины в регионах России.">
    <meta property="og:title" content="Региональная сеть — ФГНКА в России">
    <meta property="og:description" content="Организации, культурные объединения и представители грузинской общины в регионах России.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('regions.index') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="top"></div>
    <x-site-header active="regions" />

    <main class="regions-page">
        <section class="regions-archive section-pad">
            <div class="container">
                <div class="regions-hero">
                    <div class="section-title title-bordered">
                        <span>Региональная сеть</span>
                        <h1>Организации в регионах России</h1>
                    </div>

                    <p class="regions-lead">
                        Каталог региональных организаций, городских объединений и представителей грузинской общины.
                        Здесь собраны контакты, руководители и краткая информация о деятельности на местах.
                    </p>
                </div>

                <form class="regions-filter-panel" method="GET" action="{{ route('regions.index') }}" aria-label="Поиск региональных организаций">
                    <div class="regions-search">
                        <input
                            type="search"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Город, регион, руководитель"
                            aria-label="Поиск по городу, региону или руководителю"
                        >
                        @if($activeDistrict)
                            <input type="hidden" name="district" value="{{ $activeDistrict }}">
                        @endif
                        <button type="submit">Найти</button>
                    </div>

                    <div class="regions-filter-list" aria-label="Фильтр по федеральному округу">
                        <a href="{{ route('regions.index', array_filter(['search' => $search])) }}" class="regions-filter-link {{ $activeDistrict ? '' : 'is-active' }}">
                            Все округа
                        </a>

                        @foreach($districts as $district)
                            <a href="{{ route('regions.index', array_filter(['district' => $district, 'search' => $search])) }}" class="regions-filter-link {{ $activeDistrict === $district ? 'is-active' : '' }}">
                                {{ $district }}
                            </a>
                        @endforeach
                    </div>

                    <span class="regions-filter-count">
                        Найдено: {{ $organizations->total() }}
                    </span>
                </form>

                @if($organizations->isNotEmpty())
                    <div class="regions-list">
                        @foreach($organizations as $organization)
                            <article class="region-card">
                                <a href="{{ route('regions.show', $organization) }}" class="region-card-link" aria-label="{{ $organization->title }}">
                                    <div class="region-card-side">
                                        <span>{{ $organization->federal_district ?: 'Регион' }}</span>
                                        <strong>{{ $organization->city ?: $organization->region }}</strong>
                                        @if($organization->type)
                                            <small>{{ $organization->type }}</small>
                                        @endif
                                    </div>

                                    <div class="region-card-main">
                                        <div class="region-card-meta">
                                            @if($organization->region)
                                                <span>{{ $organization->region }}</span>
                                            @endif
                                            @if($organization->city)
                                                <span>{{ $organization->city }}</span>
                                            @endif
                                        </div>

                                        <h2>{{ $organization->title }}</h2>

                                        @if($organization->short_description)
                                            <p>{{ $organization->short_description }}</p>
                                        @endif

                                        <dl class="region-card-details">
                                            @if($organization->leader_name)
                                                <div>
                                                    <dt>Руководитель</dt>
                                                    <dd>{{ $organization->leader_name }}</dd>
                                                </div>
                                            @endif

                                            @if($organization->phone)
                                                <div>
                                                    <dt>Телефон</dt>
                                                    <dd>{{ $organization->phone }}</dd>
                                                </div>
                                            @endif

                                            @if($organization->email)
                                                <div>
                                                    <dt>Email</dt>
                                                    <dd>{{ $organization->email }}</dd>
                                                </div>
                                            @endif
                                        </dl>

                                        <span class="text-read-link">Подробнее <span>→</span></span>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    @if($organizations->hasPages())
                        <nav class="simple-pagination" aria-label="Навигация по региональным организациям">
                            @if($organizations->onFirstPage())
                                <span class="is-disabled">← Назад</span>
                            @else
                                <a href="{{ $organizations->previousPageUrl() }}">← Назад</a>
                            @endif

                            <span>Страница {{ $organizations->currentPage() }} из {{ $organizations->lastPage() }}</span>

                            @if($organizations->hasMorePages())
                                <a href="{{ $organizations->nextPageUrl() }}">Дальше →</a>
                            @else
                                <span class="is-disabled">Дальше →</span>
                            @endif
                        </nav>
                    @endif
                @else
                    <div class="regions-empty-state">
                        <h2>Организации не найдены</h2>
                        <p>Попробуйте изменить поисковый запрос или выбрать другой федеральный округ.</p>
                        <a href="{{ route('regions.index') }}" class="text-read-link">Показать все организации <span>→</span></a>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <x-site-footer />
</body>
</html>

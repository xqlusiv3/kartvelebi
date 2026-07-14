@props([
    'active' => null,
    'home' => false,
])

@php
    $topHref = $home ? '#top' : route('home') . '#top';
    $aboutHref = $home ? '#about' : route('home') . '#about';
    $leaderHref = $home ? '#leader' : route('home') . '#leader';
    $activityHref = $home ? '#activity' : route('home') . '#activity';
    $contactsHref = $home ? '#contacts' : route('home') . '#contacts';
    $joinHref = $home ? '#join' : route('home') . '#join';
@endphp

<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="{{ $topHref }}" @if($home) data-scroll-top @endif aria-label="Вернуться к началу страницы">
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
            <a href="{{ $aboutHref }}">Об автономии</a>
            <a href="{{ route('news.index') }}" class="{{ $active === 'news' ? 'is-active' : '' }}">Новости</a>
            <a href="{{ $leaderHref }}">Руководство</a>
            <a href="{{ $activityHref }}">Направления работы</a>
            <a href="{{ $contactsHref }}">Контакты</a>
        </nav>

        <a class="btn btn-red header-cta" href="{{ $joinHref }}">Присоединиться</a>
    </div>
</header>

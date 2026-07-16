@props([
    'home' => false,
])

@php
    $topHref = $home ? '#top' : route('home') . '#top';
    $aboutHref = $home ? '#about' : route('home') . '#about';
    $leaderHref = $home ? '#leader' : route('home') . '#leader';
    $activityHref = $home ? '#activity' : route('home') . '#activity';
    $contactsHref = $home ? '#contacts' : route('home') . '#contacts';
@endphp

<footer class="footer">
    <div class="container footer-inner">
        <a class="brand brand-footer" href="{{ $topHref }}" @if($home) data-scroll-top @endif>
            <span class="brand-symbol brand-footer-symbol" aria-hidden="true">ФГ</span>
            <span class="brand-footer-text">Федеральная грузинская НКА в России</span>
        </a>

        <nav aria-label="Навигация в подвале сайта">
            <a href="{{ $aboutHref }}">Об автономии</a>
            <a href="{{ route('news.index') }}">Новости</a>
            <a href="{{ route('regions.index') }}">Регионы</a>
            <a href="{{ $leaderHref }}">Руководство</a>
            <a href="{{ $activityHref }}">Направления работы</a>
            <a href="{{ $contactsHref }}">Контакты</a>
        </nav>

        <span>© 2026 · საქართველო</span>
    </div>
</footer>

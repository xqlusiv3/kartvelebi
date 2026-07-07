{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    {{-- Hero-блок с фоновым эффектом --}}
    <section class="relative flex items-center justify-center min-h-[80vh] overflow-hidden bg-gradient-to-br from-amber-50 via-orange-50 to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        {{-- Абстрактный декоративный фон --}}
        <div class="absolute inset-0 -z-10 opacity-20 dark:opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl animate-pulse delay-200"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center relative z-10">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight text-gray-900 dark:text-white leading-tight">
                Грузинская диаспора
                <span class="block text-amber-700 dark:text-amber-400">объединяет</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-gray-700 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Сохраняем традиции, поддерживаем друг друга и строим мосты между культурами. Добро пожаловать в наш общий дом.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                    Присоединиться к сообществу
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#about" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-gray-700 bg-white/80 backdrop-blur-sm hover:bg-gray-100 rounded-lg border border-gray-200 transition duration-300 ease-in-out">
                    Узнать больше
                </a>
            </div>
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce hidden md:block">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    {{-- Блок преимуществ (карточки) --}}
    <section class="py-16 md:py-24 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 dark:text-white">
                    Наши <span class="text-amber-700 dark:text-amber-400">ценности</span>
                </h2>
                <div class="mt-4 w-24 h-1 bg-amber-700 dark:bg-amber-400 mx-auto rounded-full"></div>
                <p class="mt-6 text-lg text-gray-600 dark:text-gray-300">
                    Мы строим сообщество на основе взаимопомощи, уважения к культуре и открытости.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                {{-- Карточка 1 --}}
                <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-8 shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                    <div class="w-16 h-16 bg-amber-100 dark:bg-amber-900/40 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-amber-700 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Сообщество</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Объединяем грузин и друзей Грузии по всему миру, создаём тёплую атмосферу взаимопомощи.</p>
                </div>

                {{-- Карточка 2 --}}
                <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-8 shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                    <div class="w-16 h-16 bg-amber-100 dark:bg-amber-900/40 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-amber-700 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Культура</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Сохраняем и популяризируем грузинскую культуру, язык, традиции и кухню через мероприятия и мастер-классы.</p>
                </div>

                {{-- Карточка 3 --}}
                <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-8 shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 text-center">
                    <div class="w-16 h-16 bg-amber-100 dark:bg-amber-900/40 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-amber-700 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Поддержка</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Помогаем новым членам адаптироваться, оказываем информационную и моральную поддержку.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Секция "О нас" с фоном --}}
    <section id="about" class="py-16 md:py-24 bg-amber-50/60 dark:bg-gray-900/50 relative overflow-hidden">
        {{-- Декоративный фон --}}
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-0 left-0 w-1/2 h-full bg-amber-200/20 dark:bg-amber-700/10 rotate-12 transform origin-top-left"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12 max-w-5xl mx-auto">
                {{-- Текстовая часть --}}
                <div class="flex-1 text-center lg:text-left">
                    <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 dark:text-white">
                        Наша цель — <span class="text-amber-700 dark:text-amber-400">сохранить и передать</span> культурное наследие
                    </h2>
                    <div class="w-24 h-1 bg-amber-700 dark:bg-amber-400 mx-auto lg:mx-0 mt-4 rounded-full"></div>
                    <p class="mt-6 text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        Мы — сообщество людей, объединённых любовью к Грузии. Здесь вы найдёте поддержку, узнаете о предстоящих событиях, сможете погрузиться в богатую культуру и историю, а также внести свой вклад в развитие диаспоры.
                    </p>
                    <p class="mt-4 text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        Наш сайт — это открытая площадка для общения, обмена опытом и сохранения традиций для будущих поколений.
                    </p>
                    <div class="mt-8">
                        <a href="#" class="inline-flex items-center text-amber-700 dark:text-amber-400 font-semibold hover:underline">
                            Узнать больше о нас
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Изображение-заглушка (замените на реальное фото) --}}
                <div class="flex-1 flex justify-center lg:justify-end">
                    <div class="w-72 h-72 md:w-96 md:h-96 rounded-full overflow-hidden shadow-2xl border-4 border-white dark:border-gray-700">
                        <img src="https://images.unsplash.com/photo-1595149817530-98f78a8c8c08?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Грузия" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Секция с призывом (Call to Action) --}}
    <section class="py-16 bg-amber-700 dark:bg-amber-800 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold">Станьте частью нашего сообщества</h2>
            <p class="mt-4 text-lg max-w-2xl mx-auto text-amber-100">
                Подпишитесь на новости, участвуйте в мероприятиях и помогайте развивать грузинскую культуру вместе с нами.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-amber-700 bg-white hover:bg-gray-100 rounded-lg shadow-lg transition duration-300">
                    Подписаться
                </a>
                <a href="#" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-white border border-white/30 hover:bg-white/10 rounded-lg transition duration-300">
                    Связаться с нами
                </a>
            </div>
        </div>
    </section>
@endsection
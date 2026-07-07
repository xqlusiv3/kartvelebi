<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Федеральная грузинская НКА в России</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header" id="top">
        <div class="container header-inner">
            <a class="brand" href="#top" aria-label="Федеральная грузинская НКА в России">
                <span class="brand-mark" aria-hidden="true">
                    <span></span><span></span><span></span><span></span>
                </span>
                <span class="brand-text">
                    <strong>ФГНКА</strong>
                    <small>грузин России</small>
                </span>
            </a>

            <button class="menu-toggle" type="button" aria-label="Открыть меню" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <nav class="main-nav" aria-label="Основная навигация">
                <a href="#about">Об автономии</a>
                <a href="#leader">Руководство</a>
                <a href="#activity">Направления работы</a>
                <a href="#contacts">Контакты</a>
            </nav>

            <a class="btn btn-red header-cta" href="#join">Присоединиться</a>
        </div>
    </header>

    <main>
        <section class="hero section-pad">
            <div class="container hero-grid">
                <div class="hero-content">
                    <div class="eyebrow eyebrow-line">
                        <span>საქართველო · კულტურა</span>
                        <span>федеральный уровень · с 2016 года</span>
                    </div>
                    <h1>Федеральная <span>грузинская</span> автономия в России</h1>
                    <p class="hero-quote">«Сохраняем культуру. Поддерживаем соотечественников. Укрепляем согласие.»</p>
                    <p class="hero-text">Федеральная национально-культурная автономия — общественная форма самоорганизации грузин России, направленная на сохранение языка, культуры, исторической памяти и развитие межнационального согласия.</p>
                    <div class="hero-actions">
                        <a class="btn btn-red" href="#about">Об автономии <span>→</span></a>
                        <a class="btn btn-outline" href="#activity">Направления работы</a>
                    </div>
                </div>

                <div class="hero-visual" aria-label="Грузия и Россия — культурная связь">
                    <div class="hero-photo hero-photo-main">
                        <img src="{{ asset('images/hero-community.jpg') }}" alt="Культурная встреча ФГНКА" onerror="this.hidden=true">
                    </div>
                    <div class="hero-photo hero-photo-small">
                        <img src="{{ asset('images/hero-georgia-russia.jpg') }}" alt="Грузинская культура в России" onerror="this.hidden=true">
                    </div>
                    <div class="hero-note">
                        <span>Культура · диалог · доверие</span>
                        <strong>Связь поколений и народов</strong>
                    </div>
                </div>
            </div>

            <div class="stats-bar" aria-label="Ключевые показатели организации">
                <div class="stat"><strong>ФНКА</strong><span>федеральный уровень организации</span></div>
                <div class="stat"><strong>2016</strong><span>год создания автономии</span></div>
                <div class="stat"><strong>культура</strong><span>язык · традиции · просвещение</span></div>
                <div class="stat"><strong>регионы</strong><span>взаимодействие с сообществами</span></div>
            </div>
        </section>

        <section class="about section-pad" id="about">
            <div class="container">
                <div class="section-title title-bordered">
                    <h2>О Федеральной грузинской<br>национально-культурной автономии</h2>
                </div>

                <div class="about-grid">
                    <div class="rich-text">
                        <p><strong>Федеральная грузинская национально-культурная автономия в России</strong> — общественная организация федерального уровня, объединяющая усилия грузинских национально-культурных объединений, активистов, молодых лидеров и партнёров в регионах России.</p>
                        <p>Автономия действует в логике Федерального закона о национально-культурной автономии: помогает сохранять национальную самобытность, родной язык, образование и культуру, а также участвует в укреплении единства российской нации и гармонизации межэтнических отношений.</p>
                        <p>Для грузин России это площадка представительства, культурной памяти и практической поддержки. Для общества в целом — открытый институт диалога, просвещения и добрососедства.</p>
                    </div>

                    <aside class="about-side">
                        <div class="image-card image-card-light">
                            <img src="{{ asset('images/about-event.jpg') }}" alt="Мероприятия автономии, культурные встречи и общественные проекты" onerror="this.hidden=true">
                        </div>
                        <div class="caption">Культурно-просветительская работа ФГНКА</div>
                        <div class="facts-list">
                            <div><span>Правовая форма</span><strong>НКА / ФНКА</strong></div>
                            <div><span>Формат работы</span><strong>субъекты РФ</strong></div>
                            <div><span>Ключевой фокус</span><strong>язык и культура</strong></div>
                            <div><span>Основа участия</span><strong>добровольность</strong></div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="leader section-pad" id="leader">
            <div class="container">
                <div class="section-title title-bordered title-light">
                    <h2>Обращение<br>руководства автономии</h2>
                </div>

                <div class="leader-grid">
                    <div>
                        <div class="portrait-card">
                            <img src="{{ asset('images/leader.jpg') }}" alt="Руководитель Федеральной грузинской национально-культурной автономии" onerror="this.hidden=true">
                            <div class="portrait-caption">
                                <strong>Давид Цецхладзе</strong>
                                <small>Президент ФГНКА</small>
                            </div>
                        </div>
                        <div class="signature"><span class="mini-logo" aria-hidden="true"></span>Федеральная грузинская НКА в России</div>
                    </div>

                    <div class="leader-text">
                        <div class="quote-mark">“</div>
                        <p><strong>Дорогие друзья, соотечественники, партнёры и гости нашего сайта!</strong></p>
                        <p>Федеральная грузинская национально-культурная автономия в России — это институт общественного представительства и культурного самоопределения грузин России. Мы объединяем людей вокруг созидательных задач: сохранения языка, поддержки образования, развития культуры и укрепления межнационального согласия.</p>
                        <p>Наша задача — не только проводить культурные мероприятия. Мы выстраиваем устойчивую систему общественного взаимодействия: поддерживаем молодёжные инициативы, развиваем просветительские проекты, помогаем региональным объединениям и укрепляем доверие между людьми разных национальностей.</p>
                        <p>Мы открыты к сотрудничеству с общественными организациями, культурными центрами, образовательными учреждениями и всеми, кто разделяет ценности уважения, добрососедства и сохранения культурного наследия.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="activity section-pad" id="activity">
            <div class="container">
                <div class="section-title title-bordered">
                    <h2>Направления<br>деятельности</h2>
                </div>
                <p class="section-intro">Работа автономии строится вокруг задач, характерных для ФНКА: сохранение языка и культуры, поддержка образования, развитие региональных связей, общественное представительство и межкультурный диалог.</p>

                <div class="activity-grid">
                    <article class="activity-card">
                        <span class="icon">⌑</span>
                        <h3>Язык и образование</h3>
                        <p>Курсы грузинского языка, воскресные школы, студенческие инициативы, лектории и проекты для молодых соотечественников.</p>
                        <small>язык · школы · молодёжь</small>
                    </article>
                    <article class="activity-card">
                        <span class="icon">♪</span>
                        <h3>Культура и наследие</h3>
                        <p>Фестивали, концерты, выставки, памятные даты, национальная кухня, музыка, танец и популяризация грузинского культурного наследия.</p>
                        <small>фестивали · выставки · традиции</small>
                    </article>
                    <article class="activity-card">
                        <span class="icon">⌁</span>
                        <h3>Общественная поддержка</h3>
                        <p>Информационная и консультационная поддержка соотечественников, помощь в навигации по общественным, культурным и социальным вопросам.</p>
                        <small>консультации · обращения</small>
                    </article>
                    <article class="activity-card">
                        <span class="icon">♡</span>
                        <h3>Региональное взаимодействие</h3>
                        <p>Координация с региональными и местными объединениями, обмен опытом, поддержка инициатив на местах и формирование общей повестки.</p>
                        <small>регионы · автономии · советы</small>
                    </article>
                    <article class="activity-card">
                        <span class="icon">◌</span>
                        <h3>Межнациональное согласие</h3>
                        <p>Участие в форумах, общественных обсуждениях, совместных культурных проектах и инициативах, направленных на добрососедство и взаимное уважение.</p>
                        <small>диалог · партнёрства · доверие</small>
                    </article>
                    <article class="activity-card">
                        <span class="icon">☷</span>
                        <h3>Партнёрства и проекты</h3>
                        <p>Сотрудничество с культурными, образовательными, общественными и экспертными площадками для реализации долгосрочных проектов.</p>
                        <small>проекты · сотрудничество</small>
                    </article>
                </div>

                <div class="community-banner" id="join">
                    <img src="{{ asset('images/join-community.jpg') }}" alt="Участники культурного проекта ФГНКА" onerror="this.hidden=true">
                    <div>
                        <h2>Присоединяйтесь к работе автономии</h2>
                        <p>Культура сильна, когда она объединяет людей</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="contacts section-pad" id="contacts">
            <div class="container contacts-grid">
                <div>
                    <div class="small-label">Контакты</div>
                    <h2>Мы всегда на связи</h2>
                    <p class="contacts-lead">Есть вопросы, предложения по сотрудничеству или инициативы для совместной работы? Напишите нам — мы открыты к диалогу с соотечественниками, региональными объединениями и партнёрами.</p>
                    <div class="contact-list">
                        <div><span>Адрес</span><strong>г. Москва, адрес уточняется</strong></div>
                        <div><span>Телефон</span><strong><a href="tel:+74951234567">телефон уточняется</a></strong></div>
                        <div><span>E-mail</span><strong><a href="mailto:info@kartvelebi.ru">info@kartvelebi.ru</a></strong></div>
                        <div><span>Режим работы</span><strong>Пн–Пт, 10:00–18:00</strong></div>
                    </div>
                </div>

                <div class="join-card">
                    <span class="large-mark" aria-hidden="true"></span>
                    <small>Стать участником работы</small>
                    <h3>Поддержите<br>инициативы ФГНКА</h3>
                    <p>Мы приглашаем к сотрудничеству соотечественников, молодёжные объединения, культурные центры, экспертов и партнёров, которым близка грузинская культура.</p>
                    <a href="mailto:info@kartvelebi.ru" class="btn btn-white">Связаться <span>→</span></a>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <a class="brand brand-footer" href="#top">
                <span class="brand-mark" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
                <span class="brand-text">Федеральная грузинская НКА в России</span>
            </a>
            <nav>
                <a href="#about">Об автономии</a>
                <a href="#leader">Руководство</a>
                <a href="#activity">Направления работы</a>
                <a href="#contacts">Контакты</a>
            </nav>
            <span>© 2026 · საქართველო</span>
        </div>
    </footer>
</body>
</html>

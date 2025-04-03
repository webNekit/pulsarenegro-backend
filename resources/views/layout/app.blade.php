<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-meta :title="$title" :description="$description" :keywords="$keywords" :ogImage="$ogImage" :ogUrl="$ogUrl" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/styles/vendors/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendors/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}">
    @livewireStyles
</head>

<body>
    <div class="app-template">
        @include('partials.header')
        <main class="main" id="main">
            <div class="main__page">
                {{ $slot }}
            </div>
        </main>
        <livewire:form.order-form />
        <footer class="footer" id="footer">
            <div class="footer__row footer__row--top">
                <div class="footer__container container">
                    <div class="footer__inner footer__inner--top">
                        <div class="footer__contacts footer-contacts">
                            <div class="footer-contacts__alt">
                                <div class="footer-contacts__alt-label">Свяжитесь с нами</div>
                                <ul class="footer-contacts__alt-list">
                                    <li class="footer-contacts__alt-item">
                                        <a href="#!" class="footer-contacts__alt-link footer-contacts__alt-phone">+7 100
                                            000-00-00</a>
                                    </li>
                                    <li class="footer-contacts__alt-item">
                                        <a href="#!"
                                            class="footer-contacts__alt-link footer-contacts__alt-email">test@gmail.com</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- список для соц.сетей -->
                            <ul class="footer-contacts__social"></ul>
                        </div>
                        <nav class="footer__navigation footer-navigation">
                            <menu class="footer-navigation__menu">
                                <li class="footer-navigation__menu-item">
                                    <div class="footer-navigation__menu-label">Интернет-магазин</div>
                                    <ul class="footer-navigation__submenu">
                                        <li class="footer-navigation__submenu-item">
                                            <a href="#!" class="footer-navigation__submenu-link">Акции</a>
                                        </li>
                                        <li class="footer-navigation__submenu-item">
                                            <a href="#!" class="footer-navigation__submenu-link">Каталог</a>
                                        </li>
                                        <li class="footer-navigation__submenu-item">
                                            <a href="#!" class="footer-navigation__submenu-link">Услуги</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer-navigation__menu-item">
                                    <div class="footer-navigation__menu-label">Компания</div>
                                    <ul class="footer-navigation__submenu">
                                        <li class="footer-navigation__submenu-item">
                                            <a href="./about.html" class="footer-navigation__submenu-link">О нас</a>
                                        </li>
                                        <li class="footer-navigation__submenu-item">
                                            <a href="./news.html" class="footer-navigation__submenu-link">Новости</a>
                                        </li>
                                        <li class="footer-navigation__submenu-item">
                                            <a href="./reviews.html" class="footer-navigation__submenu-link">Отзывы</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer-navigation__menu-item">
                                    <div class="footer-navigation__menu-label">Информация</div>
                                    <ul class="footer-navigation__submenu">
                                        <li class="footer-navigation__submenu-item">
                                            <a href="./about.html" class="footer-navigation__submenu-link">База
                                                знаний</a>
                                        </li>
                                        <li class="footer-navigation__submenu-item">
                                            <a href="./news.html"
                                                class="footer-navigation__submenu-link">Вопрос-ответ</a>
                                        </li>
                                        <li class="footer-navigation__submenu-item">
                                            <a href="./reviews.html"
                                                class="footer-navigation__submenu-link">Реквизиты</a>
                                        </li>
                                    </ul>
                                </li>
                            </menu>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="footer__row footer__row--bottom">
                <div class="footer__container container">
                    <div class="footer__inner footer__inner--bottom">
                        <div class="footer__copyright">© 2025 PulsarEnegro: все права защищены</div>
                        <a href="#!" target="_blank" class="footer__license">Политика конфиденциальности</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('assets/scripts/vendors/swiper.min.js') }}"></script>
    <script type="module" src="{{ asset('assets/scripts/app.js') }}"></script>
    @livewireScripts
</body>

</html>
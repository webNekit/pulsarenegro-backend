<?php
$settings = app(App\Services\SettingsService::class)->get();
$fuels = app(App\Services\CatalogService::class)->getCatalog();
?>
<footer class="footer" id="footer">
    <div class="footer__row footer__row--top">
        <div class="footer__container container">
            <div class="footer__inner footer__inner--top">
                <div class="footer__contacts footer-contacts">
                    <div class="footer-contacts__alt">
                        @if (isset($settings['phones']) && $settings['emails'])
                            <div class="footer-contacts__alt-label">{{ __('Свяжитесь с нами') }}</div>
                            <ul class="footer-contacts__alt-list">
                                <li class="footer-contacts__alt-item">
                                    <a href="tel:+7{{ $settings['phones'][0]['number'] }}"
                                        class="footer-contacts__alt-link footer-contacts__alt-phone">+7{{ $settings['phones'][0]['number'] }}</a>
                                </li>
                                @foreach ($settings['emails'] as $email)
                                    <li class="footer-contacts__alt-item">
                                        <a href="mailto:{{ $email['address'] }}"
                                            class="footer-contacts__alt-link footer-contacts__alt-email">{{ $email['address'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <nav class="footer__navigation footer-navigation">
                    <menu class="footer-navigation__menu">
                        @if ($fuels->isNotEmpty())
                            <li class="footer-navigation__menu-item">
                                <div class="footer-navigation__menu-label">{{ __('Каталог') }}</div>
                                <ul class="footer-navigation__submenu">
                                    <li class="footer-navigation__submenu-item">
                                        <a href="{{ route('product.index') }}"
                                            class="footer-navigation__submenu-link">{{ __('Все товары') }}</a>
                                    </li>
                                    @foreach ($fuels as $fuel)
                                        <li class="footer-navigation__submenu-item">
                                            <a href="{{ route('product.index', ['fuel' => $fuel['id']]) }}') }}"
                                                class="footer-navigation__submenu-link">{{ $fuel->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        <li class="footer-navigation__menu-item">
                            <div class="footer-navigation__menu-label">Компания</div>
                            <ul class="footer-navigation__submenu">
                                <li class="footer-navigation__submenu-item">
                                    <a href="./about.html"
                                        class="footer-navigation__submenu-link">{{ __('О компании') }}</a>
                                </li>
                                <li class="footer-navigation__submenu-item">
                                    <a href="{{ route('news.index') }}"
                                        class="footer-navigation__submenu-link">{{ __('Новости') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer-navigation__menu-item">
                            <div class="footer-navigation__menu-label">{{ __('Информация') }}</div>
                            <ul class="footer-navigation__submenu">
                                <li class="footer-navigation__submenu-item">
                                    <a href="{{ route('wiki.index') }}"
                                        class="footer-navigation__submenu-link">{{ __('База знаний') }}</a>
                                </li>
                                <li class="footer-navigation__submenu-item">
                                    <a href="{{ route('faq.index') }}"
                                        class="footer-navigation__submenu-link">{{ __('Вопрос-ответ') }}</a>
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
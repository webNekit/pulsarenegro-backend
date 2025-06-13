<?php
$settings = app(App\Services\SettingsService::class)->get();
$services = app(App\Services\ServicesService::class)->getServices();
?>
<header id="header" class="header">
    <div class="header__inner">
        <div class="header__row header__row--top">
            <div class="header__container container">
                <button class="header__menu-btn toggler-menu" data-menu-toggler>
                    <i class="ri-menu-2-line"></i>
                </button>
                <div class="header__overlay" data-menu-overlay>
                    <nav class="header__nav navbar">
                        <menu class="navbar__menu">
                            <li class="navbar__menu-item">
                                <a href="{{ route('main.index') }}" class="navbar__menu-link">{{ __('Главная') }}</a>
                            </li>
                            <li class="navbar__menu-item dropdown">
                                <a href="#!" class="navbar__menu-link dropdown__target">
                                    {{ __('Компания') }}
                                    <i class="ri-arrow-drop-down-line"></i>
                                </a>
                                <ul class="dropdown__list">
                                    <li class="dropdown__list-item">
                                        <a href="{{ route('company.index') }}"
                                            class="dropdown__list-link">{{  __('О компании')}}</a>
                                    </li>
                                    <li class="dropdown__list-item">
                                        <a href="{{ route('news.index') }}"
                                            class="dropdown__list-link">{{ __('Новости') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="navbar__menu-item">
                                <a href="{{ route('wiki.index') }}" class="navbar__menu-link">База знаний</a>
                            </li>
                            <li class="navbar__menu-item">
                                <a href="{{ route('faq.index') }}" class="navbar__menu-link">Вопрос-Ответ</a>
                            </li>
                            <li class="navbar__menu-item">
                                <a href="{{ route('calculator.index') }}" class="navbar__menu-link">Калькулятор</a>
                            </li>
                        </menu>
                    </nav>
                    <div class="header__callback callback">
                        <ul class="header__callback callback__list">
                            @if ($settings->phones)
                                @foreach ($settings->phones as $phone)
                                    <li class="callback__item">
                                        <a href="tel:+7{{ $phone['number'] }}"
                                            class="callback__link callback__link--phone">+7{{ $phone['number'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            <li class="callback__item"><a data-modal-target="modal-contact" href="#!"
                                    class="callback__link callback__link--control">Обратный звонок</a></li>
                        </ul>
                    </div>
                    <div class="header__theme theme-selector">
                        <button aria-label="Включить светлый режим" class="theme-selector__control" data-theme-light>
                            <i class="ri-sun-line"></i>
                        </button>
                        <button aria-label="Включить темный режим" class="theme-selector__control" data-theme-dark>
                            <i class="ri-moon-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__row header__row--middle">
            <div class="header__container container">
                <div class="header__logo logo">
                    <a href="{{ route('main.index') }}" class="logo__link">
                        <img src="{{ asset('assets/img/logo.svg') }}" alt="Логотип компании" class="logo__brand">
                    </a>
                </div>
                <livewire:ui.catalog />
                <div class="header__search search">
                    <form action="{{ route('product.search') }}" class="search__form">
                        <div class="search__form-item">
                            <input type="search" name="search" class="search__form-field" placeholder="Найти">
                        </div>
                        <button type="submit" class="search__form-submit">
                            <i class="ri-search-line"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @if ($services->isNotEmpty())
            <div class="header__row header__row--bottom">
                <div class="header__container container">
                    <ul class="header__services service-list">
                        @foreach ($services as $service)
                            <li class="service-list__item">
                                <a href="{{  route('service.show', ['id' => $service->id]) }}"
                                    class="service-list__link">{{ $service->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</header>

<?php
$settings = app(App\Services\SettingsService::class)->get();
?>
<x-app :title="$title" :description="$meta_description" :keywords="$meta_keywords"
    :ogImage="asset('assets/img/meta-img.jpg')" :ogUrl="url()->current()">
    <section class="company company--page">
        <div class="company__container container">
            <div class="company__inner">
                <div class="company__header">
                    <h1 class="company__header-title h2">О компании</h1>
                </div>
                <div class="company__body">
                    <div class="company__grid">
                        <div class="company__grid-item company__grid-item--left">
                            @foreach ($contents as $content)
                                <div class="company__content">
                                    <h2 class="company__content-title h4">{{ $content['title'] }}</h2>
                                    <div class="company__content-description">
                                        {!! $content['description'] !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="company__grid-item company__grid-item--right">
                            <div class="company__contacts company-contacts">
                                @if (isset($settings['phones']))
                                    <div class="company-contacts__group">
                                        <h3 class="company-contacts__title">Телефон для связи</h3>
                                        <ul class="company-contacts__list">
                                            @foreach ($settings['phones'] as $phone)
                                                <li class="company-contacts__item">
                                                    <a href="tel:+7{{ $phone['number'] }}"
                                                        class="company-contacts__link">+7{{ $phone['number'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (isset($settings['emails']))
                                    <div class="company-contacts__group">
                                        <h3 class="company-contacts__title">{{ __('E-mail') }}</h3>
                                        <ul class="company-contacts__list">
                                            @foreach ($settings['emails'] as $email)
                                                <li class="company-contacts__item">
                                                    <a href="mailto:{{ $email['address'] }}"
                                                        class="company-contacts__link">{{ $email['address'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
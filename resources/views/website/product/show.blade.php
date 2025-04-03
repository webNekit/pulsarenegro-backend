<x-app :title="$product->title" 
    :description="$product->meta_description ?? ''" 
    :keywords="$product->meta_keywords ?? []" 
    :ogImage="asset('assets/img/default-og-image.jpg')" 
    :ogUrl="url()->current()">
    <section class="product-detail product-detail--page">
        <div class="product-detail__container container">
            <div class="product-detail__inner">
                <div class="product-detail__info">
                    <div class="product-detail__info-header">
                        <h2 class="product-detail__info-name h3">{{ $product->title }}</h2>
                    </div>
                    <div class="product-detail__info-body">
                        <ul class="product-detail__info-list">
                            <li class="product-detail__info-item">
                                <span class="product-detail__info-key">{{ __('Производитель') }}</span>
                                <span class="product-detail__info-value">{{ $product->manufacturer->name }}</span>
                            </li>
                            <li class="product-detail__info-item">
                                <span class="product-detail__info-key">{{ __('Бренд') }}</span>
                                <span class="product-detail__info-value">{{ $product['brand']['name'] }}</span>
                            </li>
                            <li class="product-detail__info-item">
                                <span class="product-detail__info-key">{{ __('Топливо') }}</span>
                                <span class="product-detail__info-value">{{ $product['fuel']['name'] }}</span>
                            </li>
                            <li class="product-detail__info-item">
                                <span class="product-detail__info-key">{{ __('Исполнение') }}</span>
                                <span class="product-detail__info-value">{{ $product['execution']['name'] }}</span>
                            </li>
                            <li class="product-detail__info-item">
                                <span class="product-detail__info-key">{{ __('Автоматизация') }}</span>
                                <span class="product-detail__info-value">{{ $product['automation']['name'] }}</span>
                            </li>
                            <li class="product-detail__info-item">
                                <span class="product-detail__info-key">{{ __('Масса') }}</span>
                                <span class="product-detail__info-value">{{ $product['weight'] }} кг</span>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail__info-footer">
                        <div class="product-detail__info-prices">
                            <div class="product-detail__info-price">
                                <div class="product-detail__info-priceKey">Цена в России</div>
                                <div class="product-detail__info-priceValue">{{ $product['price_rub'] }} ₽</div>
                            </div>
                            <div class="product-detail__info-price">
                                <div class="product-detail__info-priceKey">Цена в Китае</div>
                                <div class="product-detail__info-priceValue">{{ $product['price_usd'] }} $</div>
                            </div>
                        </div>
                        <button data-modal-target="modal-callback-product"
                            class="product-detail__info-callbackButton button button--primary">Заказать</button>
                    </div>
                </div>
                <div class="product-detail__preview">
                    <div class="product-detail__slider swiper">
                        <div class="product-detail__slider-controls">
                            <button class="product-detail__slider-control product-detail__slider-control--prev"
                                data-slider-prev>
                                <i class="ri-arrow-left-line"></i>
                            </button>
                            <button class="product-detail__slider-control product-detail__slider-control--next"
                                data-slider-next>
                                <i class="ri-arrow-right-line"></i>
                            </button>
                        </div>
                        <div class="product-detail__slider-wrapper swiper-wrapper">
                            @if (is_array($product->image) && count($product->image) > 0)
                                @foreach ($product->image as $image)
                                <div class="product-detail__slider-slide swiper-slide">
                                    <img loading="lazy" src="{{ url('storage', ['image' => $image]) }}" alt="{{ $product->title }}"
                                        class="product-detail__slider-img">
                                </div>
                                @endforeach
                            @else
                            <div class="product-detail__slider-slide swiper-slide">
                                    <img loading="lazy" src="{{ asset('assets/img/defaults/no-image.jpg') }}" alt="{{ $product->title }}"
                                        class="product-detail__slider-img">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-specification product-specification--page">
        <div class="product-specification__container container">
            <div class="product-specification__inner">
                <div class="product-specification__tab product-tab" data-tabs>
                    <div class="product-tab__header">
                        <ul class="product-tab__controls">
                            <li class="product-tab__controls-item">
                                <button class="product-tab__control" data-tab-control="tab-1">{{ __('Характеристики') }}</button>
                            </li>
                            <li class="product-tab__controls-item">
                                <button class="product-tab__control" data-tab-control="tab-2">{{ __('Описание') }}</button>
                            </li>
                            <li class="product-tab__controls-item">
                                <button class="product-tab__control" data-tab-control="tab-3">{{ __('Комплектация') }}</button>
                            </li>
                        </ul>
                    </div>
                    <div class="product-tab__body">
                        <div class="product-tab__panel product-tab__panel--specific" data-tab-panel="tab-1">
                            <div class="product-tab__specific">
                                <div class="product-tab__specific-label">{{ __('Основные характеристики') }}</div>
                                <ul class="product-tab__specific-list">
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Модель электростанции') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['model'] }}</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Тип запуска') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['start_type'] }}</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Двигатель') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['engine_type'] }}</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Модель двигателя') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['engine_model'] }}</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Объем двигателя') }}</span>
                                        <span class="product-tab__specific-value">{{  $product['engine_volume'] }} л</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Обороты двигателя') }}</span>
                                        <span class="product-tab__specific-value">{{  $product['engine_rpm'] }} об/мин</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Напряжение') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['voltage']['name'] }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-tab__specific">
                                <div class="product-tab__specific-label">{{ __('Дополнительные характеристики') }}</div>
                                <ul class="product-tab__specific-list">
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Охлаждение') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['cooling_type'] }}</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Расход NG при 50% мощности') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['ng_consumption_50'] }} m3/час</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Расход NG при 100% мощности') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['ng_consumption_100'] }} m3/час</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Давление газа NG') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['ng_pressure'] }} кПа</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Тип фазности') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['phase_type'] }}</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Тип электрогенератора') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['generator_type'] }}</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Габариты') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['dimensions'] }}</span>
                                    </li>
                                    <li class="product-tab__specific-item">
                                        <span class="product-tab__specific-key">{{ __('Страна производства') }}</span>
                                        <span class="product-tab__specific-value">{{ $product['country'] }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-tab__panel" data-tab-panel="tab-2">
                            <div class="product-tab__panel-text">
                                {!! $product['description'] !!}
                            </div>
                        </div>
                        <div class="product-tab__panel" data-tab-panel="tab-3">
                            <div class="product-tab__equipment">
                                <div class="product-tab__equipment-label">{{ __('Комплектация') }}</div>
                                <ul class="product-tab__equipment-list">
                                @if (is_array($product['equipment']) && count($product['equipment']) > 0)
                                    @foreach ($product['equipment'] as $equipment)
                                        <li class="product-tab__equipment-item">
                                            <i class="ri-check-line"></i>
                                            {{ $equipment['name'] }}
                                        </li>
                                    @endforeach
                                @else
                                    {{ __('Данные отсутствуют') }}
                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
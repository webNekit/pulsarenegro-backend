@props(['data'])

@php
    // Декодируем JSON-данные, если они еще не массив
    $images = is_array($data['image']) ? $data['image'] : json_decode($data['image'], true);

    $image = !empty($images) && isset($images[0])
        ? asset('storage/' . $images[0])
        : asset('assets/img/defaults/no-image.jpg');
@endphp
<div class="generators__catalog-card product-card">
    <div class="product-card__wrapper">
        <div class="product-card__header">
            <div class="product-card__preview">
                <a href="{{ route('product.show', $data['id']) }}" class="product-card__preview-detail">
                    <img loading="lazy" src="{{ $image }}" alt="{{ $data['title'] }}" class="product-card__preview-img">
                </a>
            </div>
            <div class="product-card__stats">
                @if($data['quantity'] > 0)
                    <span class="product-card__status product-card__status--primary">{{ __('В наличии') }}</span>
                @endif
                @if($data['is_popular'])
                    <span class="product-card__status product-card__status--secondary">{{ __('Популярный товар') }}</span>
                @endif
                @if($data['is_banner'])
                    <span class="product-card__status product-card__status--danger">{{ __('Хит') }}</span>
                @endif
            </div>
        </div>
        <div class="product-card__body">
            <div class="product-card__alt">
                <a href="{{ route('product.show', $data['id']) }}" class="product-card__detail">
                    <h3 class="product-card__alt-name h5">{{ $data['title'] }}</h3>
                </a>
            </div>
        </div>
        <div class="product-card__footer">
            <div class="product-card__footer-inner">
                <div class="product-card__prices">
                    <div class="product-card__prices-item">
                        <div class="product-card__price-label">{{ __('Цена в России') }}</div>
                        <div class="product-card__price-value">{{ $data['price_rub'] }} ₽</div>
                    </div>
                    <div class="product-card__prices-item">
                        <div class="product-card__price-label">Цена в Китае</div>
                        <div class="product-card__price-value">{{ $data['price_usd'] }} $</div>
                    </div>
                </div>
                <button data-modal-target="modal-callback-product" data-product-name="{{ $data['title'] }}"
                    class="product-card__order-btn button button--primary">
                    {{ __('Заказать') }}
                </button>
            </div>
        </div>
    </div>
</div>
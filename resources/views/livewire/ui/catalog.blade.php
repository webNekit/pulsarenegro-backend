<div class="header__catalog header-catalog">
    <button class="header-catalog__control button button--primary" data-catalog-button>
        <i class="ri-menu-3-line"></i>
        <span class="header-catalog__control-text">{{ __('Каталог') }}</span>
    </button>
    <ul class="header-catalog__list" data-catalog-menu>
        @if ($fuels->isNotEmpty())
{{--            <li class="header-catalog__list-item">--}}
{{--                <a href="{{ route('product.index') }}" class="header-catalog__list-link">{{ __('Все товары') }}</a>--}}
{{--            </li>--}}
            @foreach ($fuels as $fuel)
                <li class="header-catalog__list-item">
                    <a href="{{ route('product.index', ['fuel' => $fuel['id']]) }}"
                        class="header-catalog__list-link">{{ $fuel->name }}
                        ({{ $fuel->products()->count() }})</a>
                </li>
            @endforeach
        @else
            <li class="header-catalog__list-item">
                {{ __('Каталог пуст') }}
            </li>
        @endif
    </ul>
</div>

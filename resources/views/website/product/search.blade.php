<x-app :title="$title">
    <section id="generators" class="generators generators--section">
        <div class="generators__catalog">
            <div class="generators__catalog-container container">
                <h3 class="generators__filter-title h4">{{ $title }}</h3>
                @if ($products->isNotEmpty())
                    <ul class="generators__catalog-list">
                        @foreach ($products as $product)
                            <li class="generators__catalog-item">
                                <x-product.card :data="$product" />
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('Совпадений не найдено') }}</p>
                @endif
            </div>
        </div>
    </section>
</x-app>
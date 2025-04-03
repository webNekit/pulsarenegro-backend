<section id="banner" class="banner">
    <div class="container banner__container">
        <div class="banner__slider swiper">
            <div class="banner__slider-wrapper swiper-wrapper">
                @if ($news->isNotEmpty())
                    @foreach ($news as $newItem)
                        <div class="banner__slider-slide banner-slide swiper-slide">
                            <div class="banner-slide"
                                style="background-image: url('{{ $newItem->image ? url('storage', $newItem->image) : asset('assets/img/defaults/no-image.jpg') }}')">
                                <div class="banner-slide__body">
                                    <div class="banner-slide__alt">
                                        <h2 class="banner-slide__title h2">{{  $newItem->title }}</h2>
                                        <div class="banner-slide__description">
                                            <p>{{ $newItem->description }}</p>
                                        </div>
                                        <a href="{{  route('news.show', [$newItem->id]) }}"
                                            class="banner-slide__detail button button--primary">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="banner__slider-navigation">
                <button class="banner__slider-button banner__slider-button--prev" data-slider-prev>
                    <i class="ri-arrow-left-line"></i>
                </button>
                <button class="banner__slider-button banner__slider-button--next" data-slider-next>
                    <i class="ri-arrow-right-line"></i>
                </button>
            </div>
        </div>
    </div>
</section>
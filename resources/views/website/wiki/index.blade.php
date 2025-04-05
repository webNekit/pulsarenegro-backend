<x-app :title="$title" :description="$meta_description" :keywords="$meta_keywords"
    :ogImage="asset('assets/img/meta-img.jpg')" :ogUrl="url()->current()">
    <section class="wiki-banner wiki-banner--page">
        <div class="wiki-banner__container container">
            <div class="wiki-banner__inner" style="background-image: url({{ asset('assets/img/luqid-bg.webp') }});">
                <h1 class="wiki-banner__title h2">{{ __('База знаний') }}</h1>
                <form action="{{ route('wiki.search') }}" class="wiki-banner__form">
                    <div class="wiki-banner__form-field">
                        <input type="text" name="search" class="wiki-banner__form-input" placeholder="Поиск">
                        <button aria-label="Поиск" type="submit" class="wiki-banner__form-submit">
                            <i class="ri-search-2-line"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="wiki-catalog wiki-catalog--page">
        <div class="wiki-catalog__container container">
            <div class="wiki-catalog__inner">
                @if ($wikis->isNotEmpty())
                    <ul class="wiki-catalog__grid">
                        @foreach ($wikis as $wiki)
                            <li class="wiki-catalog__item">
                                <div class="wiki-catalog__card">
                                    <h3 class="wiki-catalog__card-title h5">{{ $wiki->name }}</h3>
                                    <ul class="wiki-catalog__sublist">
                                        @foreach ($wiki->posts as $post)
                                            <li class="wiki-catalog__sublist-item">
                                                <a href="{{ route('wiki.show', ['id' => $post->id]) }}"
                                                    class="wiki-catalog__sublist-link">
                                                    <i class="ri-file-list-3-line"></i>
                                                    {{ $post->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('Этот раздел пуст, но мы его скоро заполним!') }}</p>
                @endif
            </div>
        </div>
    </section>
</x-app>
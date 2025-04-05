<x-app :title="$title">
    <section class="wiki-catalog wiki-catalog--page">
        <div class="wiki-catalog__container container">
            <div class="wiki-catalog__inner" style="display: grid; row-gap: 24px;">
                <h2 class="wiki-catalog__title h3">{{ __('Результаты поиска:') }} {{ $search }}</h2>
                @if ($posts->isNotEmpty())
                    <ul class="wiki-catalog__grid">
                        @foreach ($posts as $post)
                            <li class="wiki-catalog__item">
                                <div class="wiki-catalog__card">
                                    <ul class="wiki-catalog__sublist">
                                        <li class="wiki-catalog__sublist-item">
                                            <a href="{{ route('wiki.show', ['id' => $post->id]) }}"
                                                class="wiki-catalog__sublist-link">
                                                <i class="ri-file-list-3-line"></i>
                                                {{ $post->title }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('По Вашему запросу ничего не найдено.') }}</p>
                @endif
            </div>
        </div>
    </section>
</x-app>
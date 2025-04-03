<section class="news news--page">
    <div class="news__container container">
        <div class="news__inner">
            <div class="news__header">
                <h1 class="news__header-title h2">{{ __('Новости') }}</h1>
            </div>
            <div class="news__body">
                @if ($news->isEmpty())
                    <p>{{ __('Нет доступных новостей') }}</p>
                @else
                    <ul class="news__grid">
                        @foreach ($news as $newsItem)
                            <li class="news__grid-item">
                                <x-news.card :data="$newsItem" />
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>
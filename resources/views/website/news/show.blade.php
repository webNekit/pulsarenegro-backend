<x-app :title="$title">
    <section class="news news--single">
        <div class="news__container container">
            <div class="news__banner">
                <img loading="lazy"
                    src="{{  $post->image ? url('storage', $post->image) : asset('assets/img/defaults/no-image.jpg') }}"
                    alt="{{ $post->title }}" class="news__banner-img">
            </div>
            <h1 class="news__title h3">{{ $post->title }}</h1>
            <div class="news__info">
                <div class="news__info-category">{{ $post->category->name }}</div>
                <div class="news__info-date">{{ $post->created_at->format('d.m.Y') }}</div>
            </div>
            <div class="news__content">
                {!!  $post->content !!}
            </div>
        </div>
        <div class="news__container container">
            <h2 class="news__recommendations-title h4">{{ __('Рекомендуем') }}</h2>
            @if ($newsRecommendations->isNotEmpty())
                <ul class="news__recommendations">
                    @foreach ($newsRecommendations as $newsRecommendation)
                        <li class="news__recommendations-item">
                            <x-news.card :data="$newsRecommendation" />
                        </li>
                    @endforeach
                </ul>
            @else
                <p>{{ __('Нет доступных новостей') }}</p>
            @endif
        </div>
    </section>
</x-app>
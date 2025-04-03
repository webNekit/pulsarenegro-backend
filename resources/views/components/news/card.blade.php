@props(['data'])
<article class="news__grid-card news-card">
    <div class="news-card__body">
        <div class="news-card__preview">
            <a href="{{ route('news.show', [$data->id]) }}" class="news-card__preview-link">
                <img loading="lazy"
                    src="{{ $data->image ? url('storage', $data->image) : asset('assets/img/defaults/no-image.jpg') }}"
                    alt="{{ $data->title }}" class="news-card__preview-img">
            </a>
        </div>
        <div class="news-card__alt">
            <a href="{{ route('news.show', [$data->id]) }}" class="news-card__alt-link">
                <h3 class="news-card__alt-title h4">{{ $data->title }}</h3>
            </a>
            <div class="news-card__alt-description">
                <p>{{ Str::limit($data->description, 100) }}...</p>
            </div>
        </div>
        <div class="news-card__info">
            <div class="news-card__info-category">{{ $data->category->name }}</div>
            <div class="news-card__info-date">{{ $data->created_at->format('d.m.Y') }}</div>
        </div>
    </div>
</article>
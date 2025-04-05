<x-app :title="$title">
    <section class="news news--single">
        <div class="news__container container">
            <h1 class="news__title h3">{{ $post->title }}</h1>
            <div class="news__info">
                <div class="news__info-category">{{ $post->category->name }}</div>
                <div class="news__info-date">{{ $post->created_at->format('d.m.Y') }}</div>
            </div>
            <div class="news__content">
                {!!  $post->content !!}
            </div>
            @if ($post->document)
                <div>
                    <a download="" href="{{ url('storage', $post->document) }}" class="download">
                        <i class="ri-download-line"></i>
                        {{ __('Скачать инструкцию') }}
                    </a>
                </div>
            @endif
        </div>
    </section>
</x-app>
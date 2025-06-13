<x-app :title="$title">
    <section class="news news--single">
        <div class="news__container container">
            <h1 class="news__title h3">{{ $service->name }}</h1>
            <div class="news__content">
                {!!  $service->description !!}
            </div>
            @if ($service->id == $formPageId)
                <livewire:form.main-contact />
            @endif
        </div>
    </section>
</x-app>

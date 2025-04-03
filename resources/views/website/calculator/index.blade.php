<x-app :title="$title">
    <section class="calculator calculator--page">
        <div class="calculator__container container">
            <div class="calculator__inner">
                <div class="calculator__header">
                    <h1 class="calculator__header-title h2">{{ __('Калькулятор доходности') }}</h1>
                </div>
                <div class="calculator__body">
                    <livewire:section.calculator />
                </div>
            </div>
        </div>
    </section>
</x-app>
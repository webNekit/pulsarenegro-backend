<section class="questions questions--page">
    <div class="questions__container container">
        <div class="questions__inner">
            <div class="questions__header">
                <h1 class="questions__header-title h2">Вопрос-Ответ</h1>
            </div>
            <div class="questions__body">
                <div class="questions__filter questions-filter">
                    @if ($categories->isEmpty())
                        <p>{{ __('Нет доступных категорий') }}</p>
                    @else
                        <ul class="questions-filter__list">
                            <li class="questions-filter__item">
                                <button
                                    class="questions-filter__control {{ is_null($selectedCategory) ? 'questions-filter__control--active' : '' }}"
                                    wire:click="selectCategory(null)">
                                    Все вопросы
                                </button>
                            </li>
                            @foreach ($categories as $category)
                                <li class="questions-filter__item">
                                    <button
                                        class="questions-filter__control {{ $selectedCategory == $category->id ? 'questions-filter__control--active' : '' }}"
                                        wire:click="selectCategory({{ $category->id }})">
                                        {{ $category->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="questions-accordion accordion">
                    <div class="accordion__wrapper">
                        @if($questions->isEmpty())
                            <p>{{ __('Нет доступных вопросов') }}</p>
                        @else
                            @foreach ($questions as $question)
                                <div class="accordion__item" data-accordion>
                                    <div class="accordion__control" data-accordion-control>
                                        <div class="accordion__control-alt">{{ $question->question }}</div>
                                        <div class="accordion__control-icon">
                                            <i class="ri-add-line"></i>
                                        </div>
                                    </div>
                                    <div class="accordion__content" data-accordion-content>
                                        <div class="accordion__content-inner">
                                            <p>{{ $question->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="generators" class="generators generators--section">
    <div class="generators__filter">
        <div class="generators__filter-container container">
            <div class="generators__filter-wrapper">
                <div class="generators__filter-header">
                    <h3 class="generators__filter-title h4">{{ __('Каталог') }}</h3>
                </div>
                <div class="generators__filter-body">
                    <div class="generators__filter-fields">
                        <div class="generators__filter-field field" data-select>
                            <div class="field__label">Производитель</div>
                            <div class="field__dropdown">
                                <div class="field__dropdown-control" data-select-control>
                                    <span class="field__select-selected" data-default="Выбрать производителя">
                                        {{ __('Выбрать производителя') }}
                                    </span>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                                <div class="field__dropdown-body" data-select-target>
                                    @if ($manufacturers->isNotEmpty())
                                        <ul class="field__dropdown-list">
                                            @foreach ($manufacturers as $manufacturer)
                                                <li class="field__dropdown-item">
                                                    <label class="checkbox">
                                                        <input wire:model="selectedManufacturers"
                                                            value="{{ $manufacturer->id }}" type="checkbox"
                                                            class="checkbox__input">
                                                        <span class="checkbox__box">
                                                            <i class="ri-check-line checkbox__icon"></i>
                                                        </span>
                                                        <span class="checkbox__label">{{ $manufacturer->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="field__dropdown-list">
                                            <li class="field__dropdown-item">
                                                <label class="checkbox">
                                                    <span class="checkbox__label">{{ __('Нет данных') }}</span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="generators__filter-field field" data-select>
                            <div class="field__label">Бренд</div>
                            <div class="field__dropdown">
                                <div class="field__dropdown-control" data-select-control="бренд">
                                    <span class="field__select-selected" data-default="Выбрать бренд">{{ __('Выбрать
                                        бренд') }}</span>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                                <div class="field__dropdown-body" data-select-target="бренд">
                                    @if ($brands->isNotEmpty())
                                        <ul class="field__dropdown-list">
                                            @foreach ($brands as $brand)
                                                <li class="field__dropdown-item">
                                                    <label class="checkbox">
                                                        <input wire:model='selectedBrands' value='{{ $brand->id }}'
                                                            type="checkbox" class="checkbox__input">
                                                        <span class="checkbox__box">
                                                            <i class="ri-check-line checkbox__icon"></i>
                                                        </span>
                                                        <span class="checkbox__label">{{ $brand->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="field__dropdown-list">
                                            <li class="field__dropdown-item">
                                                <label class="checkbox">
                                                    <span class="checkbox__label">{{ __('Нет данных') }}</span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="generators__filter-group">
                            <div class="generators__filter-field field">
                                <div class="field__label">Мощность, кВт</div>
                                <input type="text" wire:model="minPower" class="field__text" placeholder="от 0,8">
                            </div>
                            <div class="generators__filter-field field">
                                <div class="field__label field__label--hidden">Мощность, кВт</div>
                                <input type="text" class="field__text" wire:model="maxPower" placeholder="до 3 300">
                            </div>
                        </div>
                        <div class="generators__filter-field field" data-select>
                            <div class="field__label">Напряжение</div>
                            <div class="field__dropdown">
                                <div class="field__dropdown-control" data-select-control="напряжение">
                                    <span class="field__select-selected" data-default="Выбрать напряжение">{{
    __('Выбрать напряжение') }}</span>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                                <div class="field__dropdown-body" data-select-target="напряжение">
                                    @if ($voltages->isNotEmpty())
                                        <ul class="field__dropdown-list">
                                            @foreach ($voltages as $voltage)
                                                <li class="field__dropdown-item">
                                                    <label class="checkbox">
                                                        <input wire:model="selectedVoltages" value="{{ $voltage->id }}"
                                                            type="checkbox" class="checkbox__input">
                                                        <span class="checkbox__box">
                                                            <i class="ri-check-line checkbox__icon"></i>
                                                        </span>
                                                        <span class="checkbox__label">{{ $voltage->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="field__dropdown-list">
                                            <li class="field__dropdown-item">
                                                <label class="checkbox">
                                                    <span class="checkbox__label">{{ __('Нет данных') }}</span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="generators__filter-field field" data-select>
                            <div class="field__label">Исполнение</div>
                            <div class="field__dropdown">
                                <div class="field__dropdown-control" data-select-control="исполнение">
                                    <span class="field__select-selected" data-default="Выбрать исполнение">{{
    __('Выбрать исполнение') }}</span>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                                <div class="field__dropdown-body" data-select-target="исполнение">
                                    @if ($executions->isNotEmpty())
                                        <ul class="field__dropdown-list">
                                            @foreach ($executions as $exucation)
                                                <li class="field__dropdown-item">
                                                    <label class="checkbox">
                                                        <input wire:model="selectedExecutions" value="{{ $exucation->id }}"
                                                            type="checkbox" class="checkbox__input">
                                                        <span class="checkbox__box">
                                                            <i class="ri-check-line checkbox__icon"></i>
                                                        </span>
                                                        <span class="checkbox__label">{{ $exucation->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="field__dropdown-list">
                                            <li class="field__dropdown-item">
                                                <label class="checkbox">
                                                    <span class="checkbox__label">{{ __('Нет данных') }}</span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="generators__filter-field field" data-select>
                            <div class="field__label">Автоматизация</div>
                            <div class="field__dropdown">
                                <div class="field__dropdown-control" data-select-control="автоматизация">
                                    <span class="field__select-selected"
                                        data-default="Выбрать тип автоматизации">Выбрать тип автоматизации</span>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                                <div class="field__dropdown-body" data-select-target="автоматизация">
                                    @if ($automations->isNotEmpty())
                                        <ul class="field__dropdown-list">
                                            @foreach ($automations as $automation)
                                                <li class="field__dropdown-item">
                                                    <label class="checkbox">
                                                        <input wire:model="selectedAutomations" value="{{ $automation->id }}"
                                                            type="checkbox" class="checkbox__input">
                                                        <span class="checkbox__box">
                                                            <i class="ri-check-line checkbox__icon"></i>
                                                        </span>
                                                        <span class="checkbox__label">{{ $automation->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="field__dropdown-list">
                                            <li class="field__dropdown-item">
                                                <label class="checkbox">
                                                    <span class="checkbox__label">{{ __('Нет данных') }}</span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="generators__filter-field field" data-select>
                            <div class="field__label">Топливо</div>
                            <div class="field__dropdown">
                                <div class="field__dropdown-control" data-select-control="топливо">
                                    <span class="field__select-selected" data-default="Выбрать топливо">Выбрать
                                        топливо</span>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                                <div class="field__dropdown-body" data-select-target="топливо">
                                    @if ($fuels->isNotEmpty())
                                        <ul class="field__dropdown-list">
                                            @foreach ($fuels as $fuel)
                                                <li class="field__dropdown-item">
                                                    <label class="checkbox">
                                                        <input wire:model="selectedFuels" value="{{ $fuel->id }}"
                                                            type="checkbox" class="checkbox__input">
                                                        <span class="checkbox__box">
                                                            <i class="ri-check-line checkbox__icon"></i>
                                                        </span>
                                                        <span class="checkbox__label">{{ $fuel->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="field__dropdown-list">
                                            <li class="field__dropdown-item">
                                                <label class="checkbox">
                                                    <span class="checkbox__label">{{ __('Нет данных') }}</span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="generators__filter-group">
                            <div class="generators__filter-field field">
                                <div class="field__label">Цена, руб</div>
                                <input wire:model="minPrice" type="text" class="field__text" placeholder="от 510">
                            </div>
                            <div class="generators__filter-field field">
                                <div class="field__label field__label--hidden">Цена, руб</div>
                                <input wire:model="maxPrice" type="text" class="field__text"
                                    placeholder="до 104 793 979">
                            </div>
                        </div>
                    </div>
                    <div class="generators__filter-buttons">
                        <button wire:click="resetFilters"
                            class="generators__filter-button button button--secondary">Сбросить</button>
                        <button wire:click="applyFilters"
                            class="generators__filter-button button button--primary">Подобрать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="generators__catalog">
        <div class="generators__catalog-container container">
            @if ($products->isNotEmpty())
                <ul class="generators__catalog-list">
                    @foreach ($products as $product)
                        <li class="generators__catalog-item">
                            <x-product.card :data="$product" />
                        </li>
                    @endforeach
                </ul>
            @else
                <p>{{ __('Нет доступных товаров') }}</p>
            @endif
        </div>
    </div>
</section>
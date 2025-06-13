<form class="calculator__body-form calculator-form">
    <div class="calculator-form__wrapper">
        <div class="calculator-form__group calculator-form__group--span-2">
            <div class="calculator-form__section">
                <div class="calculator-form__section-header">
                    <div class="calculator-form__section-label">Выбор оборудования</div>
                </div>
                <div class="calculator-form__section-body">
                    <div class="calculator-form__field field" data-select>
                        <div class="field__label">{{ __('Производитель') }}</div>
                        <div class="field__dropdown">
                            <div class="field__dropdown-control" data-select-control>
                                <span class="field__select-selected">
                                    @if($selectedManufacturer)
                                        {{ $manufacturers->firstWhere('id', $selectedManufacturer)?->name }}
                                    @else
                                        Выберите производителя
                                    @endif
                                </span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="field__dropdown-body" data-select-target>
                                @if ($manufacturers->isNotEmpty())
                                    <ul class="field__dropdown-list">
                                        @foreach ($manufacturers as $manufacturer)
                                            <li class="field__dropdown-item">
                                                <button type="button"
                                                        wire:click="selectManufacturer({{ $manufacturer->id }})"
                                                        class="field__dropdown-value">
                                                    {{ $manufacturer->name }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="field__dropdown-list">
                                        <li class="field__dropdown-item">{{ __('Данные отсутствуют') }}</li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="calculator-form__field field" data-select>
                        <div class="field__label">{{ __('Генератор') }}</div>
                        <div class="field__dropdown">
                            <div class="field__dropdown-control" data-select-control>
                                <span class="field__select-selected">
                                    @if($selectedProduct)
                                        {{ $products->firstWhere('id', $selectedProduct)?->title }}
                                    @else
                                        {{ __('Выберите генератор') }}
                                    @endif
                                </span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="field__dropdown-body" data-select-target>
                                @if($selectedManufacturer)
                                    <ul class="field__dropdown-list">
                                        @foreach($products as $product)
                                            <li class="field__dropdown-item">
                                                <button type="button"
                                                        wire:click="$set('selectedProduct', {{ $product->id }})"
                                                        class="field__dropdown-value">
                                                    <span>{{ $product->title }}</span>
                                                    <br>
                                                    <span style="opacity: .4;">{{ __('Мощность:') }}
                                                        {{ $product->nominal_power }} кВт</span>
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Поле для стоимости газа -->
                    <div class="calculator-form__section-group">
                        <div class="calculator-form__field field">
                            <div class="field__label">Стоимость газа (руб/м<sup>3</sup>)</div>
                            <input type="number" step="0.01" class="field__text" wire:model.lazy="gasPrice" placeholder="9.00">
                        </div>
                    </div>

                    <!-- Поле для стоимости 1 кВт электроэнергии -->
                    <div class="calculator-form__section-group">
                        <div class="calculator-form__field field">
                            <div class="field__label">Стоимость 1 кВт от сетей (руб)</div>
                            <input type="number" step="0.01" class="field__text" wire:model.lazy="electricityPrice"
                                   placeholder="5.54">
                        </div>
                    </div>
                </div>
                <button type="button" class="calculator-form__button button button--primary"
                        wire:click="calculatePayback" @if(!$selectedProduct) disabled @endif>
                    Рассчитать срок окупаемости
                </button>
            </div>
        </div>

        <div class="calculator-form__group calculator-form__group--span-1">
            <div class="calculator-form__section">
                <div class="calculator-form__section-header">
                    <div class="calculator-form__section-label">Результаты расчета</div>
                </div>
                <div class="calculator-form__section-body">
                    <div class="calculator-form__field field">
                        <div class="field__label">Расход модели (м<sup>3</sup>/час)</div>
                        <input type="text" class="field__text" readonly
                               value="{{ $ngConsumption ? number_format($ngConsumption, 2) : '' }}">
                        <small>{{ $ngConsumption ? 'Расход: ' . number_format($ngConsumption, 2) . ' м³/ч' : 'Выберите генератор' }}</small>
                    </div>

                    <div class="calculator-form__field field">
                        <div class="field__label">Стоимость 1 кВт (руб)</div>
                        <input type="text" class="field__text" readonly
                               value="{{ $electricityCost ? number_format($electricityCost, 2) : '' }}">
                        <small>{{ !is_null($electricityCost) ? 'Стоимость: ' . number_format($electricityCost, 2) . ' руб' : 'Заполните данные' }}</small>
                    </div>

                    <div class="calculator-form__field field">
                        <div class="field__label">Итоговая стоимость (руб/кВт)</div>
                        <input type="text" class="field__text" readonly
                               value="{{ $totalCost ? number_format($totalCost, 2) : '' }}">
                        <small>{{ !is_null($totalCost) ? 'Стоимость: ' . number_format($totalCost, 2) . ' руб' : 'Заполните данные' }}</small>
                    </div>

                    <div class="calculator-form__field field">
                        <div class="field__label">Срок окупаемости</div>
                        <input type="text" class="field__text" readonly
                               value="{{ trim(($paybackMonths > 0 ? $paybackMonths . ' ' . trans_choice('мес.|мес.|мес.', $paybackMonths) : '') . ' ' . ($paybackWeeks > 0 ? $paybackWeeks . ' ' . trans_choice('неделя|недели|недель', $paybackWeeks) : '')) }}">
                        <small>{{ $productPrice ? 'Стоимость установки: ' . number_format($productPrice, 0) . ' руб' : '' }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

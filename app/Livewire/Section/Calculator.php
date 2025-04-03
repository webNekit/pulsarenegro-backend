<?php

namespace App\Livewire\Section;

use Livewire\Component;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class Calculator extends Component
{
    // Входные параметры
    public $gasPrice = 8.00;
    public $electricityPrice = 5.54;
    public $maintenanceCost = 1.2;

    // Параметры из выбранного продукта
    public $nominalPower = null;
    public $ngConsumption = null;
    public $productPrice = null;

    // Результаты расчетов
    public $electricityCost = null;
    public $totalCost = null;
    public $paybackMonths = null;
    public $paybackWeeks = null;
    public $paybackDays = null;

    // Данные для выбора
    public $selectedManufacturer = null;
    public $selectedProduct = null;
    public $manufacturers;
    public $products;

    // Инициализация компонента
    public function mount()
    {
        $this->manufacturers = Manufacturer::all();
        $this->products = collect();
    }

    // Выбор производителя
    public function selectManufacturer($manufacturerId)
    {
        $this->selectedManufacturer = $manufacturerId;
        $this->products = Product::where('manufacturer_id', $manufacturerId)
            ->select('id', 'title', 'nominal_power', 'ng_consumption_50', 'price_rub')
            ->get();
        $this->resetProductFields();
    }

    // Обновление при выборе продукта
    public function updatedSelectedProduct($productId)
    {
        if ($productId) {
            $product = Product::find($productId);
            if ($product) {
                $this->nominalPower = (float)$product->nominal_power;
                $this->ngConsumption = (float)$product->ng_consumption_50;
                $this->productPrice = (float)$product->price_rub;
                $this->calculateElectricityCost();
            }
        } else {
            $this->resetProductFields();
        }
    }

    // Сброс полей продукта
    protected function resetProductFields()
    {
        $this->selectedProduct = null;
        $this->nominalPower = null;
        $this->ngConsumption = null;
        $this->productPrice = null;
        $this->electricityCost = null;
        $this->totalCost = null;
        $this->resetPaybackFields();
    }

    // Сброс полей окупаемости
    protected function resetPaybackFields()
    {
        $this->paybackMonths = null;
        $this->paybackWeeks = null;
        $this->paybackDays = null;
    }

    // Расчет стоимости электроэнергии
    public function calculateElectricityCost()
    {
        if ($this->ngConsumption && $this->gasPrice && $this->nominalPower) {
            $this->electricityCost = ($this->ngConsumption * $this->gasPrice) / $this->nominalPower;
            $this->totalCost = $this->electricityCost + $this->maintenanceCost;
        }
    }

    // Расчет срока окупаемости
    public function calculatePayback()
    {
        Log::debug('Starting payback calculation', [
            'inputs' => [
                'productPrice' => $this->productPrice,
                'nominalPower' => $this->nominalPower,
                'ngConsumption' => $this->ngConsumption,
                'gasPrice' => $this->gasPrice,
                'electricityPrice' => $this->electricityPrice,
                'maintenanceCost' => $this->maintenanceCost
            ]
        ]);

        $this->calculateElectricityCost();

        if ($this->productPrice && $this->electricityPrice && $this->totalCost && $this->nominalPower) {
            $priceDifference = $this->electricityPrice - $this->totalCost;

            Log::debug('Calculation steps', [
                'electricityCost' => $this->electricityCost,
                'totalCost' => $this->totalCost,
                'priceDifference' => $priceDifference
            ]);

            if ($priceDifference > 0) {
                $dailySavings = $priceDifference * $this->nominalPower * 24;
                $monthlySavings = $dailySavings * 30.5; // Среднее количество дней в месяце

                if ($monthlySavings > 0) {
                    $paybackInMonths = $this->productPrice / $monthlySavings;

                    // Точный расчет месяцев, недель и дней
                    $this->paybackMonths = floor($paybackInMonths);
                    $remainingDays = ($paybackInMonths - $this->paybackMonths) * 30.5;

                    $this->paybackWeeks = floor($remainingDays / 7);
                    $this->paybackDays = round($remainingDays % 7);

                    // Если срок менее месяца - показываем в неделях и днях
                    if ($this->paybackMonths == 0) {
                        $this->paybackDays = round($remainingDays);
                        $this->paybackWeeks = floor($this->paybackDays / 7);
                        $this->paybackDays = $this->paybackDays % 7;
                    }
                } else {
                    $this->resetPaybackFields();
                }
            } else {
                $this->resetPaybackFields();
            }

            Log::debug('Payback result', [
                'paybackMonths' => $this->paybackMonths,
                'paybackWeeks' => $this->paybackWeeks,
                'paybackDays' => $this->paybackDays
            ]);
        }
    }

    public function render()
    {
        return view('livewire.section.calculator');
    }
}

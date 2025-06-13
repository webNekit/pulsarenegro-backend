<?php

namespace App\Livewire\Section;

use Livewire\Component;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class Calculator extends Component
{
    public $gasPrice = 9.00;
    public $electricityPrice = 5.54;
    public $maintenanceCost = 1.2;

    public $nominalPower = null;
    public $ngConsumption = null;
    public $productPrice = null;

    public $electricityCost = null;
    public $totalCost = null;
    public $paybackMonths = null;
    public $paybackWeeks = null;
    public $paybackDays = null;

    public $selectedManufacturer = null;
    public $selectedProduct = null;
    public $manufacturers;
    public $products;

    protected $defaultConsumptionPerKw = 0.32;

    public function mount()
    {
        $this->manufacturers = Manufacturer::all();
        $this->products = collect();
    }

    public function selectManufacturer($manufacturerId)
    {
        $this->selectedManufacturer = $manufacturerId;
        $this->products = Product::where('manufacturer_id', $manufacturerId)
            ->select('id', 'title', 'nominal_power', 'ng_consumption_50', 'ng_consumption_100', 'price_rub')
            ->get();
        $this->resetProductFields();
    }

    public function updatedSelectedProduct($productId)
    {
        if ($productId) {
            $product = Product::find($productId);
            if ($product) {
                $this->nominalPower = (float) $product->nominal_power;
                if ($this->nominalPower <= 0) {
                    $this->nominalPower = 100;
                }

                $ngConsumption = (float) $product->ng_consumption_100;
                if ($ngConsumption <= 0) {
                    $ngConsumption = $this->nominalPower * $this->defaultConsumptionPerKw;
                }
                $this->ngConsumption = $ngConsumption;
                $this->productPrice = (float) $product->price_rub;

                // УБРАТЬ вызов calculateElectricityCost здесь!
            }
        } else {
            $this->resetProductFields();
        }
    }


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

    protected function resetPaybackFields()
    {
        $this->paybackMonths = null;
        $this->paybackWeeks = null;
        $this->paybackDays = null;
    }

    public function calculateElectricityCost()
    {
        if ((!$this->ngConsumption || $this->ngConsumption <= 0) && $this->nominalPower > 0) {
            $this->ngConsumption = $this->nominalPower * $this->defaultConsumptionPerKw;
        }

        if ($this->ngConsumption && $this->gasPrice && $this->nominalPower) {
            $this->electricityCost = ($this->ngConsumption * $this->gasPrice) / $this->nominalPower;
            $this->totalCost = $this->electricityCost + $this->maintenanceCost;
        } else {
            $this->electricityCost = null;
            $this->totalCost = null;
        }
    }

    public function calculatePayback()
    {
        // Пересчёт стоимости электроэнергии
        if ((!$this->ngConsumption || $this->ngConsumption <= 0) && $this->nominalPower > 0) {
            $this->ngConsumption = $this->nominalPower * $this->defaultConsumptionPerKw;
        }

        if ($this->ngConsumption && $this->gasPrice && $this->nominalPower) {
            $this->electricityCost = ($this->ngConsumption * $this->gasPrice) / $this->nominalPower;
            $this->totalCost = $this->electricityCost + $this->maintenanceCost;
        } else {
            $this->electricityCost = null;
            $this->totalCost = null;
        }

        // Расчёт срока окупаемости
        if ($this->productPrice && $this->electricityPrice && $this->totalCost && $this->nominalPower) {
            $priceDifference = $this->electricityPrice - $this->totalCost;

            if ($priceDifference > 0) {
                $dailySavings = $priceDifference * $this->nominalPower * 24;
                $monthlySavings = $dailySavings * 30.5;

                if ($monthlySavings > 0) {
                    $totalPaybackDays = $this->productPrice / $dailySavings;

                    $this->paybackMonths = floor($totalPaybackDays / 30.5);
                    $remainingDays = $totalPaybackDays - ($this->paybackMonths * 30.5);
                    $this->paybackWeeks = floor($remainingDays / 7);
                    $this->paybackDays = round($remainingDays % 7);
                } else {
                    $this->resetPaybackFields();
                }
            } else {
                $this->resetPaybackFields();
            }
        } else {
            $this->resetPaybackFields();
        }
    }


    public function render()
    {
        return view('livewire.section.calculator');
    }
}

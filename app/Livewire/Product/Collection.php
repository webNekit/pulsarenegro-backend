<?php

namespace App\Livewire\Product;

use App\Models\Automation;
use App\Models\Brand;
use App\Models\Execution;
use App\Models\Fuel;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Voltage;
use Livewire\Component;

class Collection extends Component
{
    public $fuel = null;
    public $selectedManufacturers = [];
    public $selectedBrands = [];
    public $selectedVoltages = [];
    public $selectedExecutions = [];
    public $selectedAutomations = [];
    public $selectedFuels = [];

    public $minPower;
    public $maxPower;
    public $minPrice;
    public $maxPrice;

    public function getBrandsProperty()
    {
        return Brand::orderByDesc('created_at')->where('is_active', true)->get();
    }

    public function getFuelsProperty()
    {
        return Fuel::orderByDesc('created_at')->where('is_active', true)->get();
    }

    public function getManufacturersProperty()
    {
        return Manufacturer::orderByDesc('created_at')->where('is_active', true)->get();
    }

    public function getExecutionsProperty()
    {
        return Execution::orderByDesc('created_at')->where('is_active', true)->get();
    }

    public function getVoltagesProperty()
    {
        return Voltage::orderByDesc('created_at')->where('is_active', true)->get();
    }


    public function getAutomationsProperty()
    {
        return Automation::orderByDesc('created_at')->where('is_active', true)->get();
    }

    public function getProductsProperty()
    {
        return Product::query()->when($this->fuel, function ($query) {
            $query->where('fuel_id', $this->fuel);
        })
            ->when($this->selectedManufacturers, function ($query) {
                $query->whereIn('manufacturer_id', $this->selectedManufacturers);
            })
            ->when($this->selectedBrands, function ($query) {
                $query->whereIn('brand_id', $this->selectedBrands);
            })
            ->when($this->selectedVoltages, function ($query) {
                $query->whereIn('voltage_id', $this->selectedVoltages);
            })
            ->when($this->selectedExecutions, function ($query) {
                $query->whereIn('execution_id', $this->selectedExecutions);
            })
            ->when($this->selectedAutomations, function ($query) {
                $query->whereIn('automation_id', $this->selectedAutomations);
            })
            ->when($this->selectedFuels, function ($query) {
                $query->whereIn('fuel_id', $this->selectedFuels);
            })
            ->when($this->minPower, function ($query) {
                $query->where('nominal_power', '>=', $this->minPower);
            })
            ->when($this->maxPower, function ($query) {
                $query->where('nominal_power', '<=', $this->maxPower);
            })
            ->when($this->minPrice, function ($query) {
                $query->where('price_rub', '>=', $this->minPrice);
            })
            ->when($this->maxPrice, function ($query) {
                $query->where('price_rub', '<=', $this->maxPrice);
            })
            ->where('is_active', true)->get();
    }
    public function applyFilters()
    {
        // Метод вызывается при нажатии кнопки "Подобрать"
        // Обновление продуктов произойдет автоматически благодаря реактивности Livewire
    }

    public function resetFilters()
    {
        $this->reset([
            'selectedManufacturers',
            'selectedBrands',
            'selectedVoltages',
            'selectedExecutions',
            'selectedAutomations',
            'selectedFuels',
            'minPower',
            'maxPower',
            'minPrice',
            'maxPrice'
        ]);
    }

    public function render()
    {
        return view('livewire.product.collection', [
            'automations' => $this->getAutomationsProperty(),
            'brands' => $this->getBrandsProperty(),
            'executions' => $this->getExecutionsProperty(),
            'fuels' => $this->getFuelsProperty(),
            'manufacturers' => $this->getManufacturersProperty(),
            'voltages' => $this->getVoltagesProperty(),
            'products' => $this->getProductsProperty()
        ]);
    }
}

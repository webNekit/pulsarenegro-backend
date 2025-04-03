<?php

namespace App\Livewire\Ui;

use App\Models\Fuel;
use Livewire\Component;

class Catalog extends Component
{
    public function getFuelsProperty()
    {
        return Fuel::where('is_active', true)->orderBydesc('created_at')->get();
    }

    public function render()
    {
        return view('livewire.ui.catalog', [
            'fuels' => $this->getFuelsProperty()
        ]);
    }
}

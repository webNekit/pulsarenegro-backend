<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class ProductCard extends Component
{
    public string $product_title;
    public string $product_url; // Новое свойство

    public function mount(string $product_title, string $product_id)
    {
        $this->product_title = $product_title;
        $this->product_url = route('product.show', $product_id); // Генерируем URL
    }

    public function openOrderModal()
    {
        $this->dispatch('product-selected', [
            'productName' => $this->product_title,
            'productUrl' => $this->product_url, // Передаем URL
        ]);
    }
    public function render()
    {
        return view('livewire.ui.product-card');
    }
}

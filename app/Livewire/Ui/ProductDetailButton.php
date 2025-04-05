<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class ProductDetailButton extends Component
{
    public string $product_title;
    public string $product_url;

    public function mount(string $product_title, string $product_id)
    {
        $this->product_title = $product_title;
        $this->product_url = route('product.show', $product_id); // Генерируем URL
    }

    public function openOrderModal()
    {
        // Отправляем данные в модальное окно
        $this->dispatch('product-selected', [
            'productName' => $this->product_title,
            'productUrl' => $this->product_url,
        ]);
    }
    public function render()
    {
        return view('livewire.ui.product-detail-button');
    }
}

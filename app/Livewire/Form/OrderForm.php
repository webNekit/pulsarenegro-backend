<?php

namespace App\Livewire\Form;

use App\Jobs\SendOrderEmail;
use Livewire\Component;

class OrderForm extends Component
{
    public $product_name;
    public string $name = '';
    public string $phone = '';
    public string $telegram = '';
    public string $email = '';

    public string $product_url = ''; // Новое поле для ссылки

    protected $listeners = [
        'product-selected' => 'setProductData', // Переименуем метод
    ];

    // Принимаем и название, и URL товара
    public function setProductData(array $payload)
    {
        $this->product_name = $payload['productName'];
        $this->product_url = $payload['productUrl']; // Добавляем URL
    }



    // Метод для отправки формы
    public function submit()
    {
        $this->validate([
            'name' => 'required|string|min:2',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'product_url' => 'required|url',
        ]);

        (new SendOrderEmail([
            'product_name' => $this->product_name,
            'name' => $this->name,
            'product_url' => $this->product_url,
            'phone' => $this->phone,
            'telegram' => $this->telegram,
            'email' => $this->email,
        ]))->handle();

        session()->flash('orderSuccess', 'Заявка успешно отправлена!');
        $this->resetExcept(['product_name', 'product_url']);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.form.order-form');
    }
}

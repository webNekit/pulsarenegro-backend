<?php

namespace App\Livewire\Form;

use App\Jobs\SendCallbackRequest;
use Livewire\Component;

class MainContact extends Component
{
    public string $name = '';
    public string $phone = '';
    public string $telegram = '';
    public string $email = '';
    public string $message = '';

    protected $rules = [
        'name' => 'required|min:2',
        'phone' => 'required',
        'email' => 'nullable|email',
        'message' => 'nullable|string',
    ];

    public function submit()
    {
        $this->validate();

        (new SendCallbackRequest([
            'name' => $this->name,
            'phone' => $this->phone,
            'telegram' => $this->telegram,
            'email' => $this->email,
            'message' => $this->message,
        ]))->handle();

        session()->flash('contactSuccess', 'Ваш запрос успешно отправлен! Мы свяжемся с вами в ближайшее время.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.form.main-contact');
    }
}

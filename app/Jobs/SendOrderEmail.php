<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class SendOrderEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        Mail::send('emails.order-form', ['data' => $this->data], function (Message $message) {
            $message->to(config('mail.to.address'))
                ->subject('Новая заявка с сайта: ' . $this->data['product_name']);
        });
    }
}

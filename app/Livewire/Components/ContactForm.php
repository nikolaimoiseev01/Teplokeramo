<?php

namespace App\Livewire\Components;

use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $text;

    public function render()
    {
        return view('livewire.components.contact-form');
    }

    public function send()
    {

        $title = 'Новая заявка на консультацию!';
        $text = "*Имя:* {$this->name} \n*Телефон:* {$this->email} \n*Вопрос:* {$this->text}";

        // Посылаем Telegram уведомление нам
        Notification::route('telegram', config('cons.telegram_chat_id'))
            ->notify(new TelegramNotification($title, $text, null, null));
        dd("OK");
    }
}

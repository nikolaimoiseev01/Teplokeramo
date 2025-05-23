<?php

namespace App\Livewire\Components;

use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $tel;
    public $text;

    public $flg_modal=null;
    public $sent=false;

    public function render()
    {
        return view('livewire.components.contact-form');
    }



    public function send()
    {

        $title = 'Новая заявка на консультацию!';
        $text = "*Имя:* {$this->name} \n*Телефон:* {$this->tel} \n*Сообщение:* {$this->text}";

        // Посылаем Telegram уведомление нам
        Notification::route('telegram', config('cons.telegram_chat_id'))
            ->notify(new TelegramNotification($title, $text, null, null));
        $this->sent = true;

        $this->dispatch('swal:modal',
            title: 'Успешно',
            type: 'success',
            text: 'Заявка отправлена. Наш менеджер свяжется с вами в ближайшее время.'
        );
    }
}

<?php

namespace App\Livewire\Components;

use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ProductFeedbackForm extends Component
{
    public $sent;
    public $name;
    public $product;
    public $tel;
    public $question_type='Задать вопрос';

    public function render()
    {
        return view('livewire.components.product-feedback-form');
    }

    public function mount($product) {
        $this->product = $product;
    }

    public function sendProductForm() {
        $title = 'Новая заявка со страниы товара!';
        $text = "*Имя:* {$this->name} \n*Телефон:* {$this->tel} \n*Тип вопроса:* {$this->question_type}\n*С товара:* {$this->product['name']}";

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

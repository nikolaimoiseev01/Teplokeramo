<?php

namespace App\Livewire\Components;

use App\Models\Subscriber;
use Livewire\Component;

class Footer extends Component
{
    public $sent=false;
    public $email;
    public function render()
    {
        return view('livewire.components.footer');
    }

    public function send() {
        Subscriber::firstOrCreate([
            'email' => $this->email
        ]);
        $this->sent = true;
    }
}

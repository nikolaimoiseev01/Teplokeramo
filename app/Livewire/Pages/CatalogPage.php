<?php

namespace App\Livewire\Pages;

use App\Models\Collection;
use Livewire\Component;

class CatalogPage extends Component
{
    public $collections;

    public function render()
    {

        return view('livewire.pages.catalog-page');
    }
    public function mount() {
    }
}

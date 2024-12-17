<?php

namespace App\Livewire\Pages;

use App\Models\Collection;
use Livewire\Component;

class CollectionPage extends Component
{
    public $collection;
    public function render()
    {
        return view('livewire.pages.collection-page');
    }

    public function mount($slug) {
        $this->collection = Collection::where('slug', $slug)->first();
    }
}

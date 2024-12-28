<?php

namespace App\Livewire\Pages;

use App\Models\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CollectionPage extends Component
{
    public $collection;
    public $product_types;
    public $product_thickness;
    public $product_colors;
    public function render()
    {
        return view('livewire.pages.collection-page');
    }

    public function mount($slug) {
        $this->collection = Collection::where('slug', $slug)->with('product')->first();
        $this->product_types = implode(', ',  json_decode($this->collection->product->pluck('type')->unique()));
        $this->product_colors = implode(', ',  json_decode($this->collection->product->pluck('color')->unique()));
        $this->product_thickness = implode(', ',  json_decode($this->collection->product->pluck('thickness')->unique()));
    }
}

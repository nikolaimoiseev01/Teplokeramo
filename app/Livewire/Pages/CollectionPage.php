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
        $this->product_types = implode(', ',  $this->collection->product->pluck('type')->unique()->toArray());
//        dd($this->collection->product->pluck('color')->unique()->toArray());
        $this->product_colors = implode(', ',  $this->collection->product->pluck('color')->unique()->toArray());
        $this->product_thickness = implode(', ',  $this->collection->product->pluck('thickness')->unique()->toArray());
    }
}

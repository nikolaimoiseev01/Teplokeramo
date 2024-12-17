<?php

namespace App\Livewire\Pages;

use App\Models\Brand;
use Livewire\Component;

class BrandPage extends Component
{
    public $brand;
    public $collections;

    public function render()
    {
        return view('livewire.pages.brand-page');
    }

    public function mount($slug) {
        $this->brand = Brand::where('slug', $slug)->first();

        $this->collections = $this->brand->collection->load('product');

    }
}

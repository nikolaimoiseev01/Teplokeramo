<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;

class ProductPage extends Component
{
    public $product;
    public function render()
    {
        return view('livewire.pages.product-page');
    }

    public function mount($slug) {
        $this->product = Product::where('slug', $slug)->first();
    }
}

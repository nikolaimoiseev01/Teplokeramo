<?php

namespace App\Livewire\Components\Portal;

use App\Models\Product;
use Livewire\Component;

class CatalogList extends Component
{
    public $orig_collections;
    public $collections;
    public $totalProducts;
    public $products;
    public $product_limit = 6;
    public $collection_limit = 6;

    protected $listeners = ['refreshCatalogList' => '$refresh'];

    public function render()
    {
        $this->products = Product::whereIn('collection_id', $this->collections->pluck('id'))->take($this->product_limit)->get();
        $this->collections = $this->orig_collections->take($this->collection_limit);
        return view('livewire.components.portal.catalog-list');
    }

    public function mount($collections) {
        $this->totalProducts = $this->collections->sum(function ($collection) {
            return $collection->product->count();
        });
        $this->orig_collections = $collections;
    }

    public function loadMoreProducts() {
        $this->product_limit += 6;
        $this->dispatch('refreshCatalogList');
    }

    public function loadMoreCollections() {
        $this->collection_limit += 6;
        $this->dispatch('refreshCatalogList');
    }
}

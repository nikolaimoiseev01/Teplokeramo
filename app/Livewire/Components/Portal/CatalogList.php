<?php

namespace App\Livewire\Components\Portal;

use App\Models\Collection;
use App\Models\Product;
use http\QueryString;
use Livewire\Attributes\Url;
use Livewire\Component;

class CatalogList extends Component
{
    public $orig_collections;
    public $collections;
    public $orig_products;
    public $products;
    public $product_limit = 6;
    public $collection_limit = 6;

    public $sort_options;
    public $sort_option;

    // Фильтры
    #[Url]
    public $f_area_of_use;
    #[Url]
    public $f_brand_id;

    protected $listeners = ['refreshCatalogList' => '$refresh'];

    public function render()
    {
        $this->products = $this->orig_products->take($this->product_limit);
        $this->collections = $this->orig_collections->take($this->collection_limit);
        return view('livewire.components.portal.catalog-list');
    }

    public function mount()
    {
        $this->orig_products = Product::
//            where('id', 1)
            when($this->f_area_of_use, function ($query) {
                $query->whereJsonContains('area_of_use', $this->f_area_of_use);
            })
//            ->when($this->f_brand_id, function ($query) {
//                $query->where('brand_id', $this->f_brand_id);
//            })
            ->get();
        dd($this->orig_products);
        $col_ids_from_products = $this->orig_products->pluck('collection_id')->unique();
        $this->orig_collections = Collection::whereIn('id', $col_ids_from_products)->get();

        $this->sort_options = [
            [
                'id' => 1,
                'name' => 'По популярности'
            ],
            [
                'id' => 2,
                'name' => 'По цене'
            ]
        ];
    }

    public function loadMoreProducts()
    {
        $this->product_limit += 6;
        $this->dispatch('refreshCatalogList');
    }

    public function loadMoreCollections()
    {
        $this->collection_limit += 6;
        $this->dispatch('refreshCatalogList');
    }
}

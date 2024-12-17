<?php

namespace App\Livewire\Pages;

use App\Models\Brand;
use App\Models\Country;
use App\Models\Product;
use Livewire\Component;

class BrandsPage extends Component
{
    public $brands;
    public $sort_options;
    public $country_filter = '999';
    public $countries;

    public function render()
    {
        return view('livewire.pages.brands-page');
    }

    public function mount() {
        $this->brands = Brand::all();
        $countries_ids = Product::distinct()->pluck('country_code');
        $this->countries = Country::whereIn('code', $countries_ids->toArray())->get();
    }

    public function updatedCountryFilter() {
//        dd($this->country_filter);
        if ($this->country_filter == '999') {
            $this->brands = Brand::all();
        } else {
            // Получаем бренды продуктов, у которых country_code совпадает
            $country_code = Country::where('id', $this->country_filter)->first();
            $this->brands = Brand::whereHas('product', function ($query) use($country_code) {
                $query->where('country_code', $country_code['code']);
            })->distinct()->get();
        }
    }
}

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
    public $sort_option;
    public $country_filter = '999';
    public $countries;

    public function render()
    {
        return view('livewire.pages.brands-page');
    }

    public function mount() {
        $this->brands = Brand::all();
        $this->countries = Product::select('country_code', 'country_name')->distinct()->get();
        $this->countries = $this->countries->map(function ($item, $index) {
            return [
                'id' => $index + 1, // Добавляем порядковый номер
                'country_code' => $item->country_code, // Оставляем код страны
                'name' => $item->country_name, // Переименовываем поле country_name в name
            ];
        });
//        dd( $this->countries );

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

    public function updatedCountryFilter() {
        if ($this->country_filter == '999') {
            $this->brands = Brand::all();
        } else {
            $country = $this->countries->firstWhere('id', $this->country_filter);
            // Получаем бренды продуктов, у которых country_code совпадает
            $this->brands = Brand::whereHas('product', function ($query) use($country) {
                $query->where('country_code', $country['country_code']);
            })->distinct()->get();
        }
    }
}

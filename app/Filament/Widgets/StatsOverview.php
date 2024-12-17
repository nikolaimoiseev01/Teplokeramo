<?php

namespace App\Filament\Widgets;

use App\Models\Brand;
use App\Models\Collection;
use App\Models\Good\Good;
use App\Models\Product;
use App\Models\Service\Service;
use App\Models\Staff;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Брендов на сайте', function() {
                $cnt = Brand::count();
                return $cnt;
            } ),
            Stat::make('Коллекций на сайте', function() {
                $cnt = Collection::count();
                return $cnt;
            } ),
            Stat::make('Товаров на сайте', function() {
                $cnt = Product::count();
                return $cnt;
            } ),
        ];
    }
}

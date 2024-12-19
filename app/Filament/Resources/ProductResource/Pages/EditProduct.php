<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Collection;
use App\Models\Product;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make("Страница на сайте")
                ->label('Страница на сайте')
                ->url(fn(Product $product) => route('product-page', $product['slug']))
                ->tooltip('Откроется в новом окне')
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return $this->record['name'];
    }
}

<?php

namespace App\Filament\Resources\CollectionResource\Pages;

use App\Filament\Resources\CollectionResource;
use App\Models\Collection;
use App\Models\Good\Good;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditCollection extends EditRecord
{
    protected static string $resource = CollectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make("Страница на сайте")
                ->label('Страница на сайте')
                ->url(fn(Collection $collection) => route('collection-page', $collection['slug']))
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

<?php

namespace App\Filament\Imports;

use App\Models\Product;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->guess(['Название'])
                ->label('Название')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('price')
                ->requiredMapping()
                ->label('Цена м2 в копейках')
                ->guess(['Цена м2 (в копейках)'])
                ->numeric()
                ->castStateUsing(function (string $state): ?float {
                    if (blank($state)) {
                        return null;
                    }
                    $floatValue = (float)str_replace(',', '.', $state);
                    return $floatValue;
                })
                ->rules(['required']),
            ImportColumn::make('brand')
                ->relationship(resolveUsing: 'name')
                ->label('Бренд')
                ->guess(['Бренд'])
                ->rules(['required']),
            ImportColumn::make('collection')
                ->requiredMapping()
                ->label('Коллекция')
                ->guess(['Коллекция'])
                ->relationship(resolveUsing: 'name')
                ->rules(['required']),
            ImportColumn::make('packaged')
                ->label('Сколько м2 в коробке')
                ->guess(['Сколько м2 в коробке'])
                ->requiredMapping()
                ->castStateUsing(function (string $state): ?float {
                    if (blank($state)) {
                        return null;
                    }
                    $floatValue = (float)str_replace(',', '.', $state);
                    return $floatValue;
                }),
            ImportColumn::make('article')
                ->requiredMapping()
                ->label('Артикул')
                ->guess(['Артикул'])
                ->numeric(),
            ImportColumn::make('type')
                ->requiredMapping()
                ->guess(['Тип'])
                ->label('Тип'),
            ImportColumn::make('area_of_use')
                ->array(',')
                ->guess(['Применимость'])
                ->label('Применимость')
                ->helperText('Можно вставить несколько значений через запятую'),
            ImportColumn::make('weight')
                ->requiredMapping()
                ->label('Вес (кг)')
                ->guess(['Вес (кг)'])
                ->numeric(),
            ImportColumn::make('thickness')
                ->requiredMapping()
                ->label('Толщина')
                ->guess(['Толщина'])
                ->castStateUsing(function (string $state): ?float {
                    if (blank($state)) {
                        return null;
                    }
                    $floatValue = (float)str_replace(',', '.', $state);
                    return $floatValue;
                })
                ->rules(['required']),
            ImportColumn::make('color')
                ->label('Цвет')
                ->guess(['Цвет'])
                ->helperText('Например #FFFFFF')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('country_code')
                ->label('Страна (код)')
                ->guess(['Страна (код)'])
                ->helperText('Например ES')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('country_name')
                ->label('Страна (название)')
                ->guess(['Страна (название)'])
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('style')
                ->guess(['Стиль'])
                ->label('Стиль')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Product
    {
        return Product::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            'name' => $this->data['name'],
        ]);

        return new Product();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Загрузка завершена! Успешно загрузили товаров: ' . number_format($import->successful_rows);

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    public static function getOptionsFormComponents(): array
    {
        return [
            Checkbox::make('updateExisting')
                ->label('Обновлять существующие записи'),
            Placeholder::make('test')
                ->label('')
                ->content(new HtmlString('<a href="/fixed/Test Import.csv">Скачать пример файла</a>')),
        ];
    }

    protected function afterSave(): void
    {
        $this->record->update([
            'slug' => Str::slug($this->data['name'])
        ]);
        if ($this->record->getMedia('cover')->isEmpty()) {
            // Если обложки нет, добавляем новую
            $this->record->addMediaFromUrl($this->data['Обложка'])->toMediaCollection('cover');
        } else {
            // Если обложка уже есть, очищаем коллекцию и добавляем новую
            $this->record->clearMediaCollection('cover');
            $this->record->addMediaFromUrl($this->data['Обложка'])->toMediaCollection('cover');
        }
    }
}

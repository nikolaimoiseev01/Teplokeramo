<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

use App\Filament\Resources\CollectionResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CollectionRelationManager extends RelationManager
{
    protected static string $relationship = 'collection';
    protected static ?string $title = 'Коллекции у бренда';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Название'),
                Tables\Columns\TextColumn::make('product')
                    ->label('Товаров в коллекции')
                    ->getStateUsing(function (Model $record) {
                        return $record->product->count();
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions(actions: [
                Action::make('edit')
                    ->url(fn (Model $record): string => CollectionResource::getUrl('edit', ['record' => $record->id]))
                    ->openUrlInNewTab()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

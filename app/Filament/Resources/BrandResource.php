<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Бренды';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->label('Название')
                                ->columnSpanFull()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('slug')
                                ->label('Slug')
                                ->columnSpanFull()
                                ->maxLength(255),
                        ])->columnSpan(1),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover')
                            ->image()
                            ->reorderable()
                            ->label('')
                            ->imageEditor()
                            ->panelLayout('grid')
                            ->imageEditorMode(2)
                            ->imageResizeMode('cover')
                            ->label('Обложка')
                            ->imageCropAspectRatio('460:280')
                            ->columnSpan(1),
                    ])->columns(2),

                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('collections')
                    ->label('Коллекций')
                    ->getStateUsing(function (Model $record) {
                        return $record->collection->count();
                    }),
                Tables\Columns\TextColumn::make('products')
                    ->label('Товаров')
                    ->getStateUsing(function (Model $record) {
                        return $record->product->count();
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CollectionRelationManager::make(),
            RelationManagers\ProductRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}

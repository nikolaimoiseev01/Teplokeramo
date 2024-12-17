<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollectionResource\Pages;
use App\Filament\Resources\CollectionResource\RelationManagers;
use App\Models\Collection;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $navigationLabel = 'Коллекции';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Общее')
                            ->schema([
                                Forms\Components\Grid::make()->schema([
                                    Forms\Components\Grid::make()->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Название')
                                            ->columnSpanFull()
                                            ->maxLength(255),
                                        Forms\Components\Select::make('brand_id')
                                            ->relationship('brand', 'name')
                                            ->columnSpanFull()
                                            ->required(),
                                        Forms\Components\TextInput::make('slug')
                                            ->columnSpanFull()
                                            ->required()
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
                            ]),
                        Tabs\Tab::make('Подробная информация')
                            ->schema([
                                Forms\Components\Textarea::make('desc')
                                    ->maxLength(255),
                            ]),
                        Tabs\Tab::make('Примеры')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('examples')
                                    ->collection('examples')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->label('')
                                    ->imageEditor()
                                    ->panelLayout('grid')
                                    ->imageEditorMode(2)
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('460:280')
                                    ->columnSpan(1),
                            ])
                    ])->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Бренд')
                    ->numeric(),
                Tables\Columns\TextColumn::make('products')
                    ->label('Товаров в коллекции')
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
            RelationManagers\ProductRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollections::route('/'),
            'create' => Pages\CreateCollection::route('/create'),
            'edit' => Pages\EditCollection::route('/{record}/edit'),
        ];
    }
}

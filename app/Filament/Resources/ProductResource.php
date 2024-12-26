<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Товары';

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
                                        Forms\Components\TextInput::make('slug')
                                            ->required()
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
                                Forms\Components\Grid::make()->schema([
                                    Forms\Components\TextInput::make('price')
                                        ->label('Цена за м2 (копеек)')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\Select::make('brand_id')
                                        ->relationship('brand', 'name')
                                        ->label('Бренд')
                                        ->required(),
                                    Forms\Components\Select::make('collection_id')
                                        ->relationship('collection', 'name')
                                        ->label('Коллекция')
                                        ->required(),
                                ])->columns(3)

                            ]),
                        Tabs\Tab::make('Подробная информация')
                            ->schema([
                                Forms\Components\Textarea::make('desc')
                                    ->label('Описание')
                                    ->maxLength(255),
                                Forms\Components\Grid::make()->schema([
                                    Forms\Components\TextInput::make('packaged')
                                        ->numeric()
                                        ->label('М2 в коробке'),
                                    Forms\Components\TextInput::make('weight')
                                        ->numeric()
                                        ->label('Вес (кг)'),
                                    Forms\Components\ColorPicker::make('color')
                                        ->label('Цвет'),
                                ])->columns(3),
                                Forms\Components\Grid::make()->schema([
                                    Forms\Components\TextInput::make('article')
                                        ->numeric()
                                        ->label('Артикул')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('type')
                                        ->label('Тип')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('thickness')
                                        ->numeric()
                                        ->label('Толщина')
                                        ->maxLength(255),

                                ])->columns(3),
                                Forms\Components\Section::make('Применение')->schema([
                                    Repeater::make('area_of_use')
                                        ->label('')
                                        ->grid(2)
                                        ->addActionLabel('Добавить свойство')
                                        ->simple(
                                            TextInput::make('area_of_use')
                                                ->label('')
                                                ->required(),
                                        )
                                ])

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
                    ->sortable(),
                Tables\Columns\TextColumn::make('collection.name')
                    ->label('Коллекция')
                    ->sortable(),
                Tables\Columns\TextColumn::make('country_code')
                    ->label('Страна')
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

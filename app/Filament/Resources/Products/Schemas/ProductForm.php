<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('sku')->label('SKU')->required()->unique(ignoreRecord: true)->maxLength(255),
                Textarea::make('description')->columnSpanFull(),
                FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->imageEditor()
                    ->reorderable()
                    ->appendFiles()
                    ->maxFiles(10)
                    ->maxSize(5120)
                    ->directory('products')
                    ->columnSpanFull(),
                TextInput::make('price')->required()->numeric()->minValue(0)->default(0)->prefix(config('products.default_currency')),
                TextInput::make('stock')->required()->integer()->minValue(0)->default(0),
                Toggle::make('is_active')->label('Active')->default(true),
            ]);
    }
}

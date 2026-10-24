<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('sku')->label('SKU'),
                TextEntry::make('description')->columnSpanFull()->placeholder('-'),
                ImageEntry::make('images')->columnSpanFull(),
                TextEntry::make('price')->money(config('products.default_currency')),
                TextEntry::make('stock')->numeric(),
                IconEntry::make('is_active')->label('Active')->boolean(),
            ]);
    }
}

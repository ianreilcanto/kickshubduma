<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->default(fn () => 'NS-MKT-'.(1000 + (Order::max('id') ?? 0) + 1)),
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->options(OrderStatus::class)
                    ->default(OrderStatus::New)
                    ->required(),
                Select::make('currency')
                    ->options(config('products.currencies'))
                    ->default(config('products.default_currency'))
                    ->required(),
                DatePicker::make('order_date')
                    ->default(now())
                    ->required(),
                TextInput::make('shipping_cost')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotal($get, $set)),
                Repeater::make('items')
                    ->relationship()
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set) {
                                $set('unit_price', Product::find($state)?->price ?? 0);
                            }),
                        TextInput::make('quantity')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->default(1)
                            ->required()
                            ->live(onBlur: true),
                        TextInput::make('unit_price')
                            ->numeric()
                            ->minValue(0)
                            ->required()
                            ->live(onBlur: true),
                    ])
                    ->columns(3)
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotal($get, $set))
                    ->deleteAction(fn ($action) => $action->after(fn (Get $get, Set $set) => self::updateTotal($get, $set)))
                    ->columnSpanFull(),
                TextInput::make('total_price')
                    ->numeric()
                    ->readOnly()
                    ->default(0),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    protected static function updateTotal(Get $get, Set $set): void
    {
        $subtotal = collect($get('items') ?? [])
            ->sum(fn ($item) => (float) ($item['quantity'] ?? 0) * (float) ($item['unit_price'] ?? 0));

        $set('total_price', round($subtotal + (float) ($get('shipping_cost') ?? 0), 2));
    }
}

<?php

namespace App\Filament\Resources\Athletes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AthleteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('sport')
                    ->options([
                        'Basketball' => 'Basketball',
                        'Running' => 'Running',
                        'Paddle' => 'Paddle',
                    ])
                    ->searchable()
                    ->createOptionForm([TextInput::make('sport')->required()])
                    ->createOptionUsing(fn (array $data) => $data['sport'])
                    ->required(),
                TextInput::make('tagline')
                    ->placeholder('The Court Regular'),
                TextInput::make('quote')
                    ->columnSpanFull(),
                Textarea::make('bio')
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('photo')
                    ->image()
                    ->imageEditor()
                    ->directory('athletes')
                    ->maxSize(5120),
                TextInput::make('home_court')
                    ->default('Dumaguete'),
                Select::make('go_to_product_id')
                    ->label('Go-to product')
                    ->relationship('goToProduct', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('mindset'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->integer()
                    ->default(0),
                Toggle::make('is_featured')
                    ->label('Featured (in focus)')
                    ->helperText('The first active featured athlete is shown in focus on the Athletes page.'),
                Toggle::make('is_active')
                    ->label('Visible on website')
                    ->default(true),
            ]);
    }
}

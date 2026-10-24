<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageProductsPage extends ManagePageContent
{
    protected static string $pageKey = 'products';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Products Page';

    protected static ?int $navigationSort = 3;

    protected static ?string $title = 'Products Page';

    protected static ?string $slug = 'content/products';

    protected function fields(): array
    {
        return [
            Section::make('Announcement bar')->columns(2)->collapsible()->schema([
                TextInput::make('announcement_title')->label('Bold text'),
                TextInput::make('announcement_text')->label('Text'),
            ]),
            Section::make('Intro')->columns(2)->collapsible()->schema([
                TextInput::make('intro_eyebrow')->label('Eyebrow')->columnSpanFull(),
                Textarea::make('intro_title')->label('Headline')->rows(2)->helperText('One line per row.'),
                Textarea::make('intro_subtitle')->label('Subtitle')->rows(2),
                TextInput::make('art_stamp_main')->label('Art stamp word'),
                TextInput::make('art_note')->label('Art note'),
                static::imageUpload('intro_image', 'Intro photo')->columnSpanFull(),
            ]),
            Section::make('Default product image')->collapsible()->schema([
                static::imageUpload('default_product_image', 'Default product image', 'Shown on the storefront for any product without an uploaded image. Leave empty to use the built-in placeholder.'),
            ]),
            Section::make('Catalogue')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('filter_note_title')->label('Filter note title'),
                Textarea::make('filter_note_text')->label('Filter note text')->rows(2),
                TextInput::make('catalogue_footer')->label('Footer line')->columnSpanFull(),
                TextInput::make('empty_title')->label('No results title'),
                TextInput::make('empty_text')->label('No results text'),
            ]),
            Section::make('Help banner')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('help_eyebrow')->label('Eyebrow'),
                TextInput::make('help_button')->label('Button'),
                Textarea::make('help_title')->label('Title')->rows(2),
                Textarea::make('help_text')->label('Text')->rows(2),
                TextInput::make('contact_email')->label('Contact email')->email()->columnSpanFull(),
            ]),
            Section::make('Footer')->collapsible()->collapsed()->schema([
                TextInput::make('footer_copyright')->label('Copyright'),
            ]),
        ];
    }
}

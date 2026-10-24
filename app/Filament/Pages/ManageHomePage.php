<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageHomePage extends ManagePageContent
{
    protected static string $pageKey = 'home';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Home Page';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Home Page';

    protected static ?string $slug = 'content/home';

    protected function fields(): array
    {
        return [
            Section::make('Announcement bar')->columns(2)->collapsible()->schema([
                TextInput::make('announcement_title')->label('Bold text'),
                TextInput::make('announcement_text')->label('Text'),
            ]),
            Section::make('Hero')->columns(2)->collapsible()->schema([
                TextInput::make('hero_eyebrow')->label('Eyebrow')->columnSpanFull(),
                Textarea::make('hero_title')->label('Headline')->rows(2)->helperText('One line per row.'),
                TextInput::make('hero_highlight')->label('Highlighted line (red)'),
                Textarea::make('hero_text')->label('Intro text')->rows(3)->columnSpanFull(),
                TextInput::make('hero_primary_button')->label('Primary button'),
                TextInput::make('hero_secondary_button')->label('Secondary button'),
                TextInput::make('hero_note')->label('Note under hero'),
                TextInput::make('hero_caption')->label('Photo caption'),
                TextInput::make('hero_seal_top')->label('Seal: top'),
                TextInput::make('hero_seal_main')->label('Seal: main'),
                TextInput::make('hero_seal_bottom')->label('Seal: bottom'),
                TextInput::make('feature_title')->label('Featured shoe title'),
                TextInput::make('feature_text')->label('Featured shoe text'),
            ]),
            Section::make('Ribbon')->collapsible()->collapsed()->schema([
                Repeater::make('ribbon')->label('Ribbon items')->schema([
                    TextInput::make('text')->required(),
                ])->reorderable()->addActionLabel('Add item'),
            ]),
            Section::make('Assurances')->collapsible()->collapsed()->schema([
                Repeater::make('assurances')->columns(3)->schema([
                    TextInput::make('icon')->maxLength(2)->required(),
                    TextInput::make('title')->required(),
                    TextInput::make('text')->required(),
                ])->reorderable()->addActionLabel('Add assurance'),
            ]),
            Section::make('Categories')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('categories_eyebrow')->label('Eyebrow'),
                TextInput::make('categories_link')->label('View all link text'),
                TextInput::make('categories_title')->label('Title'),
                TextInput::make('categories_highlight')->label('Highlighted title (red)'),
                Repeater::make('category_cards')->label('Category cards')->columns(3)->columnSpanFull()->schema([
                    TextInput::make('tag')->required(),
                    Textarea::make('title')->rows(2)->required(),
                    TextInput::make('cta')->label('Button text')->required(),
                ])->reorderable()->addActionLabel('Add card'),
            ]),
            Section::make('Products')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('products_eyebrow')->label('Eyebrow'),
                TextInput::make('products_limit')->label('Products to show')->numeric()->minValue(1)->maxValue(24)->helperText('Latest active products from Shop → Products.'),
                TextInput::make('products_title')->label('Title'),
                TextInput::make('products_highlight')->label('Highlighted title (red)'),
            ]),
            Section::make('Athletes teaser')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('athletes_eyebrow')->label('Eyebrow'),
                TextInput::make('athletes_label')->label('Vertical label'),
                Textarea::make('athletes_title')->label('Title')->rows(2),
                TextInput::make('athletes_highlight')->label('Highlighted title (red)'),
                Textarea::make('athletes_text')->label('Text')->rows(3)->columnSpanFull(),
                TextInput::make('athletes_button')->label('Button'),
                TextInput::make('athletes_index')->label('Index label'),
            ]),
            Section::make('Story')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('story_eyebrow')->label('Eyebrow'),
                TextInput::make('story_link')->label('Link text'),
                TextInput::make('story_title')->label('Title'),
                TextInput::make('story_highlight')->label('Highlighted title (red)'),
                Textarea::make('story_text')->label('Text')->rows(3)->columnSpanFull(),
                TextInput::make('story_location')->label('Art caption'),
            ]),
            Section::make('Newsletter')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('newsletter_eyebrow')->label('Eyebrow'),
                TextInput::make('newsletter_text')->label('Text'),
                TextInput::make('newsletter_title')->label('Title'),
                TextInput::make('newsletter_highlight')->label('Highlighted title (red)'),
            ]),
            Section::make('Footer')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('footer_tagline')->label('Tagline'),
                TextInput::make('footer_copyright')->label('Copyright'),
            ]),
        ];
    }
}

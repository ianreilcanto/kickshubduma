<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageAthletesPage extends ManagePageContent
{
    protected static string $pageKey = 'athletes';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTrophy;

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Athletes Page';

    protected static ?int $navigationSort = 4;

    protected static ?string $title = 'Athletes Page';

    protected static ?string $slug = 'content/athletes';

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
                Textarea::make('intro_text')->label('Text')->rows(3),
                TextInput::make('intro_link')->label('Link text'),
                Toggle::make('show_disclosure')->label('Show disclosure banner')->live(),
                Textarea::make('disclosure')->label('Disclosure banner')->rows(2)->columnSpanFull(),
            ]),
            Section::make('Athlete roster')->columns(2)->collapsible()->collapsed()->description('Athletes themselves are managed in Community → Athletes.')->schema([
                TextInput::make('crew_eyebrow')->label('Eyebrow'),
                TextInput::make('crew_note')->label('Side note'),
                TextInput::make('crew_title')->label('Title')->columnSpanFull(),
            ]),
            Section::make('Routine')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('routine_eyebrow')->label('Eyebrow'),
                Textarea::make('routine_title')->label('Title')->rows(3),
                Textarea::make('routine_text')->label('Text')->rows(2)->columnSpanFull(),
                Repeater::make('rituals')->columns(3)->columnSpanFull()->schema([
                    TextInput::make('time')->required(),
                    TextInput::make('title')->required(),
                    TextInput::make('text')->required(),
                ])->reorderable()->addActionLabel('Add ritual'),
            ]),
            Section::make('Gear picks')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('gear_eyebrow')->label('Eyebrow'),
                TextInput::make('gear_button')->label('Button'),
                TextInput::make('gear_title')->label('Title'),
                TextInput::make('gear_limit')->label('Products to show')->numeric()->minValue(1)->maxValue(12)->helperText('Latest active products from Shop → Products.'),
            ]),
            Section::make('Categories')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('categories_eyebrow')->label('Eyebrow'),
                TextInput::make('categories_note')->label('Side note'),
                TextInput::make('categories_title')->label('Title')->columnSpanFull(),
                Repeater::make('category_cards')->label('Category cards')->columns(2)->columnSpanFull()->schema([
                    TextInput::make('tag')->required(),
                    Textarea::make('title')->rows(2)->required(),
                ])->reorderable()->addActionLabel('Add card'),
            ]),
            Section::make('Spotlight')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('spotlight_eyebrow')->label('Eyebrow'),
                TextInput::make('spotlight_button')->label('Button'),
                Textarea::make('spotlight_title')->label('Title')->rows(2),
                Textarea::make('spotlight_text')->label('Text')->rows(2),
                TextInput::make('spotlight_identity')->label('Identity'),
                TextInput::make('spotlight_identity_sub')->label('Identity subtitle'),
            ]),
            Section::make('Everyday kit')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('kit_eyebrow')->label('Eyebrow'),
                TextInput::make('kit_button')->label('Button'),
                Textarea::make('kit_title')->label('Title')->rows(2),
                Textarea::make('kit_text')->label('Text')->rows(2),
                TextInput::make('kit_art')->label('Art label')->columnSpanFull(),
            ]),
            Section::make('Local story')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('local_mark')->label('Mark caption'),
                TextInput::make('local_eyebrow')->label('Eyebrow'),
                Textarea::make('local_title')->label('Title')->rows(2),
                Textarea::make('local_text')->label('Text')->rows(3),
                TextInput::make('local_button')->label('Button'),
            ]),
            Section::make('Fit guide')->columns(3)->collapsible()->collapsed()->schema([
                TextInput::make('fit_title')->label('Title'),
                TextInput::make('fit_text')->label('Text'),
                TextInput::make('fit_button')->label('Button'),
            ]),
            Section::make('Journal')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('journal_eyebrow')->label('Eyebrow'),
                TextInput::make('journal_link')->label('Link text'),
                TextInput::make('journal_title')->label('Title')->columnSpanFull(),
                Repeater::make('journal')->label('Stories')->columns(3)->columnSpanFull()->schema([
                    TextInput::make('tag')->required(),
                    TextInput::make('title')->required(),
                    TextInput::make('text')->required(),
                ])->reorderable()->addActionLabel('Add story'),
            ]),
            Section::make('Newsletter')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('newsletter_eyebrow')->label('Eyebrow'),
                TextInput::make('newsletter_title')->label('Title'),
                TextInput::make('newsletter_text')->label('Text'),
                TextInput::make('newsletter_fine_print')->label('Fine print'),
            ]),
            Section::make('Footer')->collapsible()->collapsed()->schema([
                TextInput::make('footer_copyright')->label('Copyright'),
            ]),
        ];
    }
}

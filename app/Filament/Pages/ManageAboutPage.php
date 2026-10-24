<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageAboutPage extends ManagePageContent
{
    protected static string $pageKey = 'about';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'About Page';

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'About Page';

    protected static ?string $slug = 'content/about';

    protected function fields(): array
    {
        return [
            Section::make('Announcement bar')->columns(2)->collapsible()->schema([
                TextInput::make('announcement_title')->label('Bold text'),
                TextInput::make('announcement_text')->label('Text'),
            ]),
            Section::make('Intro')->columns(2)->collapsible()->schema([
                TextInput::make('intro_eyebrow')->label('Eyebrow')->columnSpanFull(),
                Textarea::make('intro_title')->label('Headline')->rows(3)->helperText('One line per row.'),
                Textarea::make('intro_lead')->label('Lead text')->rows(3),
                TextInput::make('emblem_caption')->label('Emblem caption'),
            ]),
            Section::make('Community banner')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('court_tag'),
                TextInput::make('court_small')->label('Small label'),
                Textarea::make('court_title')->label('Title')->rows(2),
                TextInput::make('court_location')->label('Location'),
                static::imageUpload('court_image', 'Banner photo')->columnSpanFull(),
            ]),
            Section::make('Story')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('story_eyebrow')->label('Eyebrow'),
                Textarea::make('story_title')->label('Title')->rows(3),
                Textarea::make('story_heading')->label('Heading')->rows(3)->columnSpanFull(),
                Repeater::make('story_paragraphs')->label('Paragraphs')->columnSpanFull()->schema([
                    Textarea::make('text')->rows(3)->required(),
                ])->reorderable()->addActionLabel('Add paragraph'),
                TextInput::make('story_signature')->label('Signature')->columnSpanFull(),
            ]),
            Section::make('Values')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('values_eyebrow')->label('Eyebrow'),
                TextInput::make('values_tag')->label('Side tag'),
                TextInput::make('values_title')->label('Title')->columnSpanFull(),
                Repeater::make('values')->label('Values')->columns(2)->columnSpanFull()->schema([
                    Textarea::make('title')->rows(2)->required(),
                    Textarea::make('text')->rows(3)->required(),
                ])->reorderable()->addActionLabel('Add value'),
            ]),
            Section::make('Collection')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('collection_eyebrow')->label('Eyebrow'),
                TextInput::make('collection_button')->label('Button'),
                static::imageUpload('collection_image', 'Collection photo')->columnSpanFull(),
                Textarea::make('collection_title')->label('Title')->rows(2)->columnSpanFull(),
                Repeater::make('collection_paragraphs')->label('Paragraphs')->columnSpanFull()->schema([
                    Textarea::make('text')->rows(3)->required(),
                ])->reorderable()->addActionLabel('Add paragraph'),
            ]),
            Section::make('Closing')->columns(2)->collapsible()->collapsed()->schema([
                TextInput::make('closing_eyebrow')->label('Eyebrow'),
                TextInput::make('closing_title')->label('Title'),
                Textarea::make('closing_text')->label('Text')->rows(2),
                TextInput::make('closing_button')->label('Button'),
            ]),
        ];
    }
}

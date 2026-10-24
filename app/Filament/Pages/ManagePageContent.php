<?php

namespace App\Filament\Pages;

use App\Support\SiteContent;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;

abstract class ManagePageContent extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected string $view = 'filament.pages.manage-page-content';

    protected static string $pageKey;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteContent::get(static::$pageKey));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components($this->fields())
            ->statePath('data');
    }

    /** @return array<int, mixed> */
    abstract protected function fields(): array;

    public function save(): void
    {
        SiteContent::save(static::$pageKey, $this->form->getState());

        Notification::make()->title('Page content saved')->success()->send();
    }

    public function resetToDefaults(): void
    {
        SiteContent::save(static::$pageKey, []);
        $this->form->fill(SiteContent::defaults(static::$pageKey));

        Notification::make()->title('Restored default content')->success()->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reset')
                ->label('Restore defaults')
                ->color('gray')
                ->requiresConfirmation()
                ->action(fn () => $this->resetToDefaults()),
            Action::make('view')
                ->label('View page')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(fn () => route(static::$pageKey), shouldOpenInNewTab: true),
        ];
    }
}

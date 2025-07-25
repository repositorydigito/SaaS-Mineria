<?php

namespace App\Filament\Resources\DailyProductionTonResource\Pages;

use App\Filament\Resources\DailyProductionTonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyProductionTon extends EditRecord
{
    protected static string $resource = DailyProductionTonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

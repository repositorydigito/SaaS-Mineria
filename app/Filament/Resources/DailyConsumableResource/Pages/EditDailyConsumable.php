<?php

namespace App\Filament\Resources\DailyConsumableResource\Pages;

use App\Filament\Resources\DailyConsumableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyConsumable extends EditRecord
{
    protected static string $resource = DailyConsumableResource::class;

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

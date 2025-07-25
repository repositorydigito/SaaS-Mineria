<?php

namespace App\Filament\Resources\DailyFuelConsumptionResource\Pages;

use App\Filament\Resources\DailyFuelConsumptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyFuelConsumption extends EditRecord
{
    protected static string $resource = DailyFuelConsumptionResource::class;

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

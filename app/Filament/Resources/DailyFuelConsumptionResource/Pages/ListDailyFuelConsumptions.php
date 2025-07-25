<?php

namespace App\Filament\Resources\DailyFuelConsumptionResource\Pages;

use App\Filament\Resources\DailyFuelConsumptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyFuelConsumptions extends ListRecords
{
    protected static string $resource = DailyFuelConsumptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

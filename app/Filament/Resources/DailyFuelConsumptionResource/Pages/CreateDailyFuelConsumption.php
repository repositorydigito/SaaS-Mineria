<?php

namespace App\Filament\Resources\DailyFuelConsumptionResource\Pages;

use App\Filament\Resources\DailyFuelConsumptionResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDailyFuelConsumption extends CreateRecord
{
    protected static string $resource = DailyFuelConsumptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

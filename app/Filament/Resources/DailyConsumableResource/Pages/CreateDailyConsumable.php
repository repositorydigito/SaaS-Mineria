<?php

namespace App\Filament\Resources\DailyConsumableResource\Pages;

use App\Filament\Resources\DailyConsumableResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDailyConsumable extends CreateRecord
{
    protected static string $resource = DailyConsumableResource::class;

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

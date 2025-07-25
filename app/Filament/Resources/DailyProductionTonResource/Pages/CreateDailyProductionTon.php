<?php

namespace App\Filament\Resources\DailyProductionTonResource\Pages;

use App\Filament\Resources\DailyProductionTonResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDailyProductionTon extends CreateRecord
{
    protected static string $resource = DailyProductionTonResource::class;

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

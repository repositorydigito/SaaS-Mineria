<?php

namespace App\Filament\Resources\DailyDrillingProgressResource\Pages;

use App\Filament\Resources\DailyDrillingProgressResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDailyDrillingProgress extends CreateRecord
{
    protected static string $resource = DailyDrillingProgressResource::class;

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

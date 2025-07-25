<?php

namespace App\Filament\Resources\DailyDrillingProgressResource\Pages;

use App\Filament\Resources\DailyDrillingProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyDrillingProgress extends EditRecord
{
    protected static string $resource = DailyDrillingProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['total_meters'] = $data['drills_count'] * $data['meters_per_drill'];
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Resources\DailyConsumableResource\Pages;

use App\Filament\Resources\DailyConsumableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyConsumables extends ListRecords
{
    protected static string $resource = DailyConsumableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

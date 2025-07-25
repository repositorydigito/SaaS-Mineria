<?php

namespace App\Filament\Resources\DailyProductionTonResource\Pages;

use App\Filament\Resources\DailyProductionTonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyProductionTons extends ListRecords
{
    protected static string $resource = DailyProductionTonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

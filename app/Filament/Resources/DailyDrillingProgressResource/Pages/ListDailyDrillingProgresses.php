<?php

namespace App\Filament\Resources\DailyDrillingProgressResource\Pages;

use App\Filament\Resources\DailyDrillingProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyDrillingProgresses extends ListRecords
{
    protected static string $resource = DailyDrillingProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

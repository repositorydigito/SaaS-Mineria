<?php

namespace App\Filament\Resources\PortMineralResource\Pages;

use App\Filament\Resources\PortMineralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortMinerals extends ListRecords
{
    protected static string $resource = PortMineralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

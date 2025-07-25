<?php

namespace App\Filament\Resources\CrusherMineralResource\Pages;

use App\Filament\Resources\CrusherMineralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCrusherMinerals extends ListRecords
{
    protected static string $resource = CrusherMineralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

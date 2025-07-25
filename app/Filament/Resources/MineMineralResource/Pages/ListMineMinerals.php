<?php

namespace App\Filament\Resources\MineMineralResource\Pages;

use App\Filament\Resources\MineMineralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMineMinerals extends ListRecords
{
    protected static string $resource = MineMineralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ConsumableTypeResource\Pages;

use App\Filament\Resources\ConsumableTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsumableTypes extends ListRecords
{
    protected static string $resource = ConsumableTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

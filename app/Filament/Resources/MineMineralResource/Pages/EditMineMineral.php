<?php

namespace App\Filament\Resources\MineMineralResource\Pages;

use App\Filament\Resources\MineMineralResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMineMineral extends EditRecord
{
    protected static string $resource = MineMineralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

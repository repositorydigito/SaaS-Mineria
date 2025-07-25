<?php

namespace App\Filament\Resources\CrusherMineralResource\Pages;

use App\Filament\Resources\CrusherMineralResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCrusherMineral extends EditRecord
{
    protected static string $resource = CrusherMineralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

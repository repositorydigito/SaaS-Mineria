<?php

namespace App\Filament\Resources\MineralSummaryResource\Pages;

use App\Filament\Resources\MineralSummaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMineralSummary extends EditRecord
{
    protected static string $resource = MineralSummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

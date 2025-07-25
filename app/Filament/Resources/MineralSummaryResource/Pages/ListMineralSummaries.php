<?php

namespace App\Filament\Resources\MineralSummaryResource\Pages;

use App\Filament\Resources\MineralSummaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMineralSummaries extends ListRecords
{
    protected static string $resource = MineralSummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    /**
     * Obtiene la clave del registro para la tabla.
     * Implementamos este método para garantizar que se use la clave correcta para cada registro.
     *
     * @param mixed $record
     * @return string
     */
    public function getTableRecordKey($record): string
    {
        // Usamos la fecha y el código del proyecto como clave compuesta
        return md5($record->fecha . '_' . ($record->proyecto_codigo ?? 'unknown'));
    }
}

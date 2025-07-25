<?php

namespace App\Filament\Resources\PortMineralResource\Pages;

use App\Filament\Resources\PortMineralResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortMineral extends EditRecord
{
    protected static string $resource = PortMineralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Conservamos el created_by original al editar
        unset($data['created_by']);
        
        return $data;
    }
}

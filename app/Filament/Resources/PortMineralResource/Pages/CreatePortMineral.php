<?php

namespace App\Filament\Resources\PortMineralResource\Pages;

use App\Filament\Resources\PortMineralResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePortMineral extends CreateRecord
{
    protected static string $resource = PortMineralResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        
        return $data;
    }
}

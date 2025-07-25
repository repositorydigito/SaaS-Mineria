<?php

namespace App\Filament\Resources\MineMineralResource\Pages;

use App\Filament\Resources\MineMineralResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMineMineral extends CreateRecord
{
    protected static string $resource = MineMineralResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();
        $userProject = $user->projects()->first();

        $data['project_id'] = $userProject->id;
        $data['created_by'] = auth()->id();

        return $data;
    }
}

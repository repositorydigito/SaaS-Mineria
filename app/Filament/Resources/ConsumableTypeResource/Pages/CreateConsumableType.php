<?php

namespace App\Filament\Resources\ConsumableTypeResource\Pages;

use App\Filament\Resources\ConsumableTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateConsumableType extends CreateRecord
{
    protected static string $resource = ConsumableTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

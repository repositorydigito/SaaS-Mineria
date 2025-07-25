<?php

namespace App\Filament\Resources\ConsumableTypeResource\Pages;

use App\Filament\Resources\ConsumableTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsumableType extends EditRecord
{
    protected static string $resource = ConsumableTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

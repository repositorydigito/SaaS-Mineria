<?php

namespace App\Filament\Resources\DailyExpenseResource\Pages;

use App\Filament\Resources\DailyExpenseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDailyExpense extends CreateRecord
{
    protected static string $resource = DailyExpenseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

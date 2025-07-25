<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return trans('filament-users::user.resource.title.create');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $projects = $data['projects'] ?? [];
        unset($data['projects']);

        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->data;

        // Sync projects
        if (isset($data['projects'])) {
            $this->record->projects()->sync($data['projects']);
        }

        // Sync roles
        if (isset($data['roles'])) {
            $this->record->roles()->sync($data['roles']);
        }
    }
}

<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return trans('filament-users::user.resource.title.edit');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $projects = $data['projects'] ?? [];
        unset($data['projects']);

        if (!empty($projects)) {
            $this->record->projects()->sync($projects);
        }

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $projects = $this->record->projects()
            ->select('projects.id')
            ->pluck('projects.id')
            ->toArray();

        if (!empty($projects)) {
            $data['projects'] = $projects;
        }

        return $data;
    }
}

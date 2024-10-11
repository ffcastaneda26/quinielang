<?php

namespace App\Filament\Resources\UserSurvivorResource\Pages;

use App\Filament\Resources\UserSurvivorResource;
use App\Models\Survivor;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserSurvivor extends CreateRecord
{
    protected static string $resource = UserSurvivorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $survivor = Survivor::active()->first();

        $data['survivor_id'] = $survivor->id;
        return $data;
    }
}

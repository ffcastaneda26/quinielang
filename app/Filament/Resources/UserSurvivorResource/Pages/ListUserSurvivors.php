<?php

namespace App\Filament\Resources\UserSurvivorResource\Pages;

use App\Filament\Resources\UserSurvivorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserSurvivors extends ListRecords
{
    protected static string $resource = UserSurvivorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

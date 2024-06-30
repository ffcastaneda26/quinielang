<?php

namespace App\Filament\Resources\SurvivorResource\Pages;

use App\Filament\Resources\SurvivorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSurvivors extends ListRecords
{
    protected static string $resource = SurvivorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}

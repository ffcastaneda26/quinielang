<?php

namespace App\Filament\Resources\SurvivorResource\Pages;

use App\Filament\Resources\SurvivorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateSurvivor extends CreateRecord
{
    protected static string $resource = SurvivorResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


}

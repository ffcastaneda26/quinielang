<?php

namespace App\Filament\Resources\RoundResource\Pages;

use App\Filament\Resources\RoundResource;
use App\Models\Season;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRound extends CreateRecord
{
    protected static string $resource = RoundResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['season_id'] = Season::where('active',1)->first()->id;
        return $data;
    }
}

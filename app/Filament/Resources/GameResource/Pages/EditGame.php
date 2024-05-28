<?php

namespace App\Filament\Resources\GameResource\Pages;

use App\Filament\Resources\GameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGame extends EditRecord
{
    protected static string $resource = GameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if($data['game_day'] && $data['game_time']){
            $data['game_date'] = $data['game_day'] . ' ' . $data['game_time'];
        }

        if($data['local_points'] && $data['visit_points']){
            $data['winner'] = $data['local_points'] > $data['visit_points'] ? 1 : 2;
        }
        return $data;
    }


}

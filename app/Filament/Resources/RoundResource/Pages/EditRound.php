<?php

namespace App\Filament\Resources\RoundResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\DB;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\RoundResource;

class EditRound extends EditRecord
{
    protected static string $resource = RoundResource::class;

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
        if($data['active']){
            DB::table('rounds')
              ->update(['active' => 0]);
        }
        return $data;
    }
}

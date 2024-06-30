<?php

namespace App\Filament\Resources\SurvivorResource\Pages;

use App\Filament\Resources\SurvivorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditSurvivor extends EditRecord
{
    protected static string $resource = SurvivorResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['active']) {
            try {
                DB::beginTransaction();
                $sql = "Update survivors set active=0";
                DB::update($sql);
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }
        return $data;
    }
}

<?php

namespace App\Filament\Resources\GameResource\Pages;

use Filament\Actions;
use App\Filament\Resources\GameResource;
use App\Models\Round;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Contracts\Pagination\Paginator;

class ListGames extends ListRecords
{
    protected static string $resource = GameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        $this->tableRecordsPerPage = 'all';
        return $query->simplePaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count()
            : $query->count());
    }

    public function getTabs(): array
    {
        return [
            '1' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 1)),
            '2' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 2)),
            '3' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 3)),
            '4' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 4)),
            '5' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 5)),
            '6' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 6)),
            '7' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 7)),
            '8' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 8)),
            '9' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 9)),
            '10' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 10)),
            '11' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 11)),
            '12' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 12)),
            '13' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 13)),
            '14' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 14)),
            '15' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 15)),
            '16' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 16)),
            '17' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 17)),
            '18' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 18)),
            '19' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('round_id', 19)),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        $search_round = new Round();
        return $search_round->read_current_round()->id;
    }


}

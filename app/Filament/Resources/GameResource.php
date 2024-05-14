<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Game;
use Filament\Tables;
use App\Models\Round;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
// use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GameResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GameResource\RelationManagers;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shield-check';
    protected static ?int $navigationSort = 12;

    public static function getNavigationLabel(): string
    {
        return __('Games');
    }
    public static function getPluralLabel(): ?string
    {
        return __('Games');
    }

    public static function getModelLabel(): string
    {
        return __('Game');
    }

    public static function getNavigationGroup(): string
    {
        return __('Catalogs');
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     $round = Round::where('active', 1)->first();
    //     if ($round) {
    //         return parent::getEloquentQuery()
    //             ->where('round_id', $round->id)
    //             ->orderBy('game_date', 'ASC');
    //     }
    //     return parent::getEloquentQuery()
    //         ->where('round_id', Round::first()->id)
    //         ->orderBy('game_date', 'ASC');
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('round_id')
                    ->translateLabel()
                    ->relationship('round', 'id')
                    ->required(),
                Forms\Components\Select::make('local_team_id')
                    ->relationship('local_team', 'name'),
                Forms\Components\TextInput::make('local_points')
                    ->numeric(),
                Forms\Components\Select::make('visit_team_id')
                    ->relationship('visit_team', 'name'),
                Forms\Components\TextInput::make('visit_points')
                    ->numeric(),
                Forms\Components\DatePicker::make('game_day')
                    ->required(),
                Forms\Components\TextInput::make('game_time')
                    ->required(),
                Forms\Components\DateTimePicker::make('game_date')
                    ->required(),
                Forms\Components\TextInput::make('winner')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('round.id')
                    ->numeric()
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('local_team.name')
                    ->label(__('Local'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('local_points')
                    ->label(__('Points'))
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_team.name')
                    ->label(__('Visit'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_points')
                    ->numeric()
                    ->label(__('Points'))
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('game_date')
                    ->date('D d M y H:i')
                    ->translateLabel(),

                Tables\Columns\TextColumn::make('winner')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        '1' => 'success',
                        '2' => 'danger'
                    })
                    ->description(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if ($state == 1) {
                            return 'Local';
                        }
                        return __('Visit');
                    }, 'above')
                    ->translateLabel()
            ])
            ->defaultPaginationPageOption(16)
            ->filters([
                Tables\Filters\SelectFilter::make('round_id')
                ->label(__('Round'))
                ->relationship('round', 'id')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }


}

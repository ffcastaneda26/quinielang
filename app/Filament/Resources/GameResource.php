<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Game;
use Filament\Tables;
use App\Models\Round;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Resources\GameResource\Pages;

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
                Group::make()
                    ->schema([
                        Section::make([
                            Forms\Components\Select::make('round_id')
                                ->translateLabel()
                                ->relationship('round', 'id')
                                ->required(),
                            Forms\Components\DatePicker::make('game_day')
                                ->required()
                                ->translateLabel()
                                ->live(onBlur: true),
                            Forms\Components\TextInput::make('game_time')
                                ->required()
                                ->translateLabel()
                                ->live(onBlur: true),
                        ])->columns(3),
                        Section::make()
                            ->schema([
                                Forms\Components\Select::make('visit_team_id')
                                    ->translateLabel()
                                    ->relationship('visit_team', 'name'),
                                Forms\Components\TextInput::make('visit_points')
                                    ->translateLabel()
                                    ->live(onBlur: true)
                                    ->numeric()
                                    ->required(fn(Get $get): bool => filled($get('local_points')))
                                    ->minValue(2)
                                    ->maxValue(999)
                                    ->different('local_points')
                                    ->translateLabel(),

                            ])->columns(2),
                        Section::make()
                            ->schema([
                                Forms\Components\Select::make('local_team_id')
                                    ->translateLabel()
                                    ->relationship('local_team', 'name'),
                                Forms\Components\TextInput::make('local_points')
                                    ->translateLabel()
                                    ->live(onBlur: true)
                                    ->numeric()
                                    ->required(fn(Get $get): bool => filled($get('visit_points')))
                                    ->minValue(2)
                                    ->maxValue(999)
                                    ->different('visit_points')
                                    ->translateLabel(),
                            ])->columns(2),

                    ]),
                // Radio::make('winner')
                // ->options([
                //     '1' => 'Local',
                //     '2' => 'Visit'
                // ])
                // ->translateLabel()
                // ->disabled()
                // ->inline()
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
                Tables\Columns\ImageColumn::make('visit_team.logo')->alignCenter()->circular(),
                Tables\Columns\TextColumn::make('visit_points')
                    ->numeric()
                    ->label(__('Points'))
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('local_team.logo')
                    ->alignCenter()
                    ->circular(),
                Tables\Columns\TextColumn::make('local_points')
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
                        return $state == 1 ? 'Local' : __('Visit');
                    }, 'above')
                    ->translateLabel()
            ])
            ->defaultPaginationPageOption(16)
            ->filters([
                Tables\Filters\SelectFilter::make('round_id')
                    ->label(__('Round'))
                    ->relationship('round', 'id')
            ], layout: FiltersLayout::AboveContent)
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

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
use Filament\Tables\Columns\TextColumn;

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
                            Forms\Components\DateTimePicker::make('game_date')
                                ->required()
                                // ->format('d/m/Y')
                                ->seconds(false)
                                ->timezone(env('APP_TIMEZONE','America/Chihuahua'))
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
                                    ->minValue(0)
                                    ->maxValue(999)
                                    ->notIn([1])
                                    ->different('local_points')
                                    ->translateLabel()
                                    ->validationAttribute('Puntos de Visita')
                                    ->validationMessages([
                                        'different' => 'No se permiten empates',
                                    ]),

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
                                    ->minValue(0)
                                    ->maxValue(999)
                                    ->different('visit_points')
                                    ->notIn([1])
                                    ->translateLabel()
                                    ->validationAttribute('Puntos de Local')
                                    ->validationMessages([
                                        'different' => 'No se permiten empates'
                                    ]),
                            ])->columns(2),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('visit_team.logo')
                    ->alignCenter()
                    ->circular()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('visit_points')
                    ->numeric()
                    ->label(__('Points'))
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('local_team.logo')
                    ->alignCenter()
                    ->circular()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('local_points')
                    ->label(__('Points'))
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('game_date')
                    ->date('D d M y H:i')
                    ->label(__('Game date')),
                Tables\Columns\TextColumn::make('winner')
                    ->label('Ganador')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        '1' => 'success',
                        '2' => 'danger'
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '1' => 'Local',
                        '2' => 'Visita'
                    }),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->paginated(false);
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

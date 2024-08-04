<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Team;
use Filament\Tables;
use App\Models\Division;
use Filament\Forms\Form;
use App\Models\Conference;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeamResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeamResource\RelationManagers;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;


    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shield-check';
    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('Teams');
    }
    public static function getPluralLabel(): ?string
    {
        return __('Teams');
    }

    public static function getModelLabel(): string
    {
        return __('Team');
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
                        TextInput::make('name')
                            ->translateLabel()
                            ->required()
                            ->maxLength(50),
                        TextInput::make('alias')
                            ->translateLabel()
                            ->required()
                            ->maxLength(50),
                        TextInput::make('short')
                            ->translateLabel()
                            ->required()
                            ->maxLength(3),
                    ]),
                // TODO:: Agregar la liga para que seleccione las divisiones
                Group::make()
                    ->schema(
                        [
                            Section::make()
                                ->schema(
                                    [
                                        Select::make('conference_id')
                                            ->label('Conference')
                                            ->reactive()
                                            ->required()
                                            ->options(Conference::all()->pluck('name', 'id')->toArray())
                                            ->afterStateUpdated(fn(callable $set) => $set('division_id', null))
                                            ->searchable(),
                                        Select::make('division_id')
                                            ->translateLabel()
                                            ->required()
                                            ->options(function (callable $get) {
                                                $conference = Conference::find($get('conference_id'));
                                                if (!$conference) {
                                                    return;
                                                }
                                                return $conference->divisions->pluck('name', 'id');
                                            }),
                                        FileUpload::make('logo')
                                            ->translateLabel()
                                            ->directory('teams')
                                            ->preserveFilenames()
                                            ->columnSpanFull()
                                    ]
                                )->columns(2),


                        ]
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('division.conference.name')
                //     ->sortable(),
                // TextColumn::make('division.name')
                //     ->sortable(),
                TextColumn::make('name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('alias')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('short')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('logo'),
                ImageColumn::make('logo_gris'),

            ])
            ->filters([
                //
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}

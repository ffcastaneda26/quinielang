<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Team;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeamResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Conference;
use App\Models\Division;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;

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
                Section::make()
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
                    ])->columns(3),

                // TODO:: Agregar la liga para que seleccione las divisiones
                // Select::make('conference_id')
                //     ->label('Conference')
                //     ->reactive()
                //     ->required()
                //     ->options(Conference::all()->pluck('name', 'id')->toArray())
                //     ->afterStateUpdated(fn(callable $set) => $set('division_id', null))
                //     ->searchable(),
                // Select::make('division_id')
                //     ->translateLabel()
                //     ->required()
                //     ->options(function (callable $get) {
                //         $conference = Conference::find($get('conference_id'));
                //         if (!$conference) {
                //             return;
                //         }
                //         return $conference->divisions->pluck('name', 'id');
                //     }),

                // Select::make('division_id')
                //     ->relationship('division', 'name')
                //     ->required(),
                FileUpload::make('logo')
                    ->translateLabel()
                    ->directory('teams')
                    ->preserveFilenames(),
                FileUpload::make('logo_gris')
                    ->translateLabel()
                    ->directory('teams')
                    ->preserveFilenames()
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

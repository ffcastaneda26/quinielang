<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\UserSurvivor;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserSurvivorResource\Pages;
use App\Filament\Resources\UserSurvivorResource\RelationManagers;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class UserSurvivorResource extends Resource
{
    protected static ?string $model = UserSurvivor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';


    protected static ?string $activeNavigationIcon = 'heroicon-s-shield-check';
    protected static ?int $navigationSort = 11;

    public static function getNavigationLabel(): string
    {
        return __('User Survivors');
    }
    public static function getPluralLabel(): ?string
    {
        return __('User Survivors');
    }

    public static function getModelLabel(): string
    {
        return __('User Survivor');
    }

    public static function getNavigationGroup(): string
    {
        return __('Catalogs');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
                ->orderby('round_id','asc');

    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user','name')
                    ->translateLabel(),
                Select::make('round_id')
                    ->relationship('round','id')
                    ->translateLabel(),
                Select::make('team_id')
                    ->relationship('team','alias')
                    ->translateLabel(),
                Toggle::make('survive')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('round_id')
                    ->label(__('Round'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Nombre Completo')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.alias')
                    ->label('Alias')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('team.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('team.logo')
                    ->rounded()
                    ->label('Logo'),
                TextColumn::make('team.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                IconColumn::make('survive')
                ->label('¿Sobrevivió?')
                ->boolean()
                ->alignCenter(),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->relationship('user', 'alias')
                    ->searchable()
                    ->preload()
                    ->label('Usuario'),
                SelectFilter::make('round_id')->relationship('round', 'id')->label('Jornada')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUserSurvivors::route('/'),
            'create' => Pages\CreateUserSurvivor::route('/create'),
            'edit' => Pages\EditUserSurvivor::route('/{record}/edit'),
        ];
    }
}

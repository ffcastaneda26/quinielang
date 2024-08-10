<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurvivorResource\Pages;
use App\Filament\Resources\SurvivorResource\RelationManagers;
use App\Models\Survivor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SurvivorResource extends Resource
{
    protected static ?string $model = Survivor::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shield-check';
    protected static ?int $navigationSort = 9;

    public static function getNavigationGroup(): string
    {
        return __('Catalogs');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(20)
                    ->translateLabel(),
                Forms\Components\Toggle::make('active')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('name'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->translateLabel()
                    ->boolean(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListSurvivors::route('/'),
            'create' => Pages\CreateSurvivor::route('/create'),
            'edit' => Pages\EditSurvivor::route('/{record}/edit'),
        ];
    }
}

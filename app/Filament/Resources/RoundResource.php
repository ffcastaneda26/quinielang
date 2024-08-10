<?php

namespace App\Filament\Resources;

use App\Enums\RoundTypeEnum;
use App\Filament\Resources\RoundResource\Pages;
use App\Filament\Resources\RoundResource\RelationManagers;
use App\Models\Round;
use App\Models\Season;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoundResource extends Resource
{
    protected static ?string $model = Round::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shield-check';
    protected static ?int $navigationSort = 11;

    public static function getNavigationLabel(): string
    {
        return __('Rounds');
    }
    public static function getPluralLabel(): ?string
    {
        return __('Rounds');
    }

    public static function getModelLabel(): string
    {
        return __('Round');
    }

    public static function getNavigationGroup(): string
    {
        return __('Catalogs');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('season_id', Season::where('active', 1)->first()->id)
            ->orderBy('active', 'DESC');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('start')
                    ->translateLabel()
                    ->required(),
                Forms\Components\DatePicker::make('finish')
                    ->translateLabel()
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->translateLabel()
                    ->inline(false)
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger'),
                Forms\Components\Select::make('type')
                    ->options(RoundTypeEnum::class)
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('start')
                    ->date()
                    ->searchable()
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('finish')
                    ->date()
                    ->searchable()
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->translateLabel()
                    ->searchable()
                    ->sortable()
                    ->badge(),

                // Tables\Columns\TextColumn::make('season.name')
                //     ->translateLabel()
                //     ->sortable(),
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
            'index' => Pages\ListRounds::route('/'),
            'create' => Pages\CreateRound::route('/create'),
            'edit' => Pages\EditRound::route('/{record}/edit'),
        ];
    }
}

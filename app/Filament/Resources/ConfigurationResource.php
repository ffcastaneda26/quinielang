<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Configuration;
use Filament\Resources\Resource;
use Filament\Forms\FormsComponent;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ConfigurationResource\Pages;
use App\Filament\Resources\ConfigurationResource\RelationManagers;

class ConfigurationResource extends Resource
{
    protected static ?string $model = Configuration::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shield-check';
    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('Configuration');
    }
    public static function getPluralLabel(): ?string
    {
        return __('Configuration');
    }

    public static function getModelLabel(): string
    {
        return __('Configuration');
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
                        TextInput::make('website_name')
                            ->required()
                            ->translateLabel()
                            ->maxLength(100),
                        TextInput::make('website_url')
                            ->translateLabel()
                            ->maxLength(100),
                        TextInput::make('email')
                            ->translateLabel()
                            ->email()
                            ->maxLength(255),
                        TextInput::make('minuts_before_picks')
                            ->required()
                            ->translateLabel()
                            ->numeric()
                            ->default(5),


                    ])->columns(2),
                Group::make()
                    ->schema([
                        Toggle::make('assig_role_to_user')
                            ->translateLabel()
                            ->inline(false)
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->onColor('success')
                            ->offColor('danger'),
                        Toggle::make('require_points_in_picks')
                            ->translateLabel()
                            ->inline(false)
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->onColor('success')
                            ->offColor('danger'),
                        Toggle::make('allow_ties')
                            ->translateLabel()
                            ->inline(false)
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->onColor('success')
                            ->offColor('danger'),
                        Toggle::make('create_mssing_picks')
                            ->translateLabel()
                            ->inline(false)
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->onColor('success')
                            ->offColor('danger'),
                        Radio::make('language')
                            ->options([
                                'es' => __('Spanish'),
                                'en' => __('English')
                            ])
                            ->inline()
                            ->translateLabel()
                            ->default('es'),
                        Toggle::make('active')
                            ->translateLabel()
                            ->inline()
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(2),
                FileUpload::make('image')
                    ->translateLabel()
                    ->directory('configuration')
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('website_name')
                    ->translateLabel(),
                TextColumn::make('website_url')
                    ->translateLabel(),
                TextColumn::make('email')
                    ->translateLabel(),
                TextColumn::make('minuts_before_picks')
                    ->translateLabel()
                    ->alignCenter()
                    ->numeric(),
                IconColumn::make('allow_ties')
                    ->translateLabel()
                    ->alignCenter()

                    ->boolean(),
                IconColumn::make('require_points_in_picks')
                    ->translateLabel()
                    ->alignCenter()
                    ->boolean()
            ])
            ->filters([
                //
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
            'index' => Pages\ListConfigurations::route('/'),
            'create' => Pages\CreateConfiguration::route('/create'),
            'edit' => Pages\EditConfiguration::route('/{record}/edit'),
        ];
    }
}

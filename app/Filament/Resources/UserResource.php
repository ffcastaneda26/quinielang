<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Security;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    // protected static ?string $cluster = Security::class;
    public static function getNavigationLabel(): string
    {
        return __('Users');
    }


    public static function getModelLabel(): string
    {
        return __('User');
    }


    public static function getPluralLabel(): ?string
    {
        return __('Users');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationGroup(): string
    {
        return __('Security');
    }

    public static function getEloquentQuery(): Builder
    {

        return parent::getEloquentQuery()
                ->orderby(env('FIELD_TO_ORDER_USERS','name'),env('ORDER_TO_SHOW_USERS','asc'))
                ->orderby('name','asc');

    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Generales')->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('username')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('alias')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('email')->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create'),
                        Section::make('')->schema([
                            Toggle::make('active')
                                ->translateLabel()
                                ->inline(false)
                                ->onIcon('heroicon-m-check-circle')
                                ->offIcon('heroicon-m-x-circle')
                                ->onColor('success')
                                ->offColor('danger'),
                        ])->columns(2),

                    ])->columnSpanFull(),

                ])->columns(2),

                Group::make()->schema([

                    CheckboxList::make('roles')
                        ->relationship(titleAttribute: 'name')
                        ->searchable(),

                    Select::make('permissions')
                        ->label('Permisos')
                        ->multiple()
                        ->preload()
                        ->relationship('permissions', 'name'),

                ]),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->translateLabel()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->translateLabel()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('username')->translateLabel()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('alias')->translateLabel()->searchable()->sortable(),
                Tables\columns\TextColumn::make('last_login')->translateLabel()->date('d/M/Y h:i a'),
            ])
            ->filters([])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

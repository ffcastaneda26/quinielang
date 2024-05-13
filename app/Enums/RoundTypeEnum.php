<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Facades\App;

enum RoundTypeEnum: string implements HasLabel,HasColor,HasIcon
{
    case Regular = 'Regular';
    case Divisional = 'Divisional';
    case Conference = 'Conference';


    public function getLabel(): ?string
    {
        if(App::isLocale('en')){
            return match ($this) {
                self::Regular => 'Regular',
                self::Divisional => 'Divisional',
                self::Conference => 'Conference',
           };
        }
        return match ($this) {
            self::Regular => 'Regular',
            self::Divisional => 'Divisional',
            self::Conference => 'Conferencia',

        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::Regular => 'warning',
            self::Divisional => 'secundary',
            self::Conference => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Regular => 'heroicon-m-shield-exclamation',
            self::Divisional => 'heroicon-m-clock',
            self::Conference => 'heroicon-m-trophy',
        };
    }
}

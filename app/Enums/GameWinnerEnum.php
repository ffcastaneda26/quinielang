<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Illuminate\Support\Facades\App;

enum GameWinnerEnum: string implements HasLabel,HasColor,HasIcon
{
    const LOCAL = 1;
    const VISIT = 2;

    public function getLabel(): ?string
    {
        if(App::isLocale('en')){
            return match ($this) {
                self::LOCAL => 'Local',
                self::VISIT => 'Visit',
           };
        }
        return match ($this) {
            self::LOCAL => 'Local',
            self::VISIT => 'Visita',
        };
    }


    public function getColor(): array|string|null
    {
        return match ($this) {
            self::LOCAL => 'success',
            self::VISIT => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::LOCAL => 'heroicon-m-shield-exclamation',
            self::VISIT => 'heroicon-m-clock',
        };
    }
}

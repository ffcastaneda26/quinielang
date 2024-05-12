<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Security extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function getNavigationLabel(): string
    {
        return __('Security');
    }
}

<?php

namespace App\Providers;

use App\Classes\Configuration;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['es','en'])
                ->visible(outsidePanels: true)
                ->flags([
                    'es' => asset('flags/spanish.png'),
                    'en' => asset('flags/english.png'),
                ])
                ->circular();
                // ->outsidePanelPlacement(Placement::TopRight);
        });

        Toggle::configureUsing(function (Toggle $toggle): void {
            $toggle
            ->translateLabel()
            ->inline(false)
            ->onIcon('heroicon-m-check-circle')
            ->offIcon('heroicon-m-x-circle')
            ->onColor('success')
            ->offColor('danger');
        });

        // App::singleton(Configuration::class, function () {
        //     return Configuration::getInstance();
        // });

    }
}

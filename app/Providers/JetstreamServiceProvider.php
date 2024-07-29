<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->login)
                ->orwhere('username', $request->login)
                ->first();
             if ($user && $user->active && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}

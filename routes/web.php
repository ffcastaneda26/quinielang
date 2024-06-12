<?php

use App\Models\Pick;
use App\Models\User;
use App\Models\Round;
use App\Livewire\Picks;
use App\Models\Position;
use App\Livewire\SelectRound;
use App\Classes\Configuration;
use App\Traits\FuncionesGenerales;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\Picks\TablePicks\TablePicks;
use App\Models\Configuration as ModelsConfiguration;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $configuration = ModelsConfiguration::first();
        return view('dashboard', compact('configuration'));
    })->name('dashboard');
    Route::get('picks', Picks::class)->name('picks');
    Route::get('table-picks',TablePicks::class)->name('table-picks');

});

Route::get('current_round', SelectRound::class);

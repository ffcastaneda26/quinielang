<?php

use App\Livewire\Picks;
use App\Livewire\SelectRound;
use App\Classes\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        $configuration = app(Configuration::class);
        return view('dashboard',compact('configuration'));
    })->name('dashboard');
    Route::get('pics',Picks::class)->name('picks');

});

Route::get('current_round',SelectRound::class);

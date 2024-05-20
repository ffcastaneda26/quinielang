<?php

use App\Classes\Configuration;
use App\Livewire\SelectRound;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
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


});

Route::get('current_round',SelectRound::class);

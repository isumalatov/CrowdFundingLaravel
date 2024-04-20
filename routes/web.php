<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountSettingsController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/accountsettings', [AccountSettingsController::class, 'index'])->name('accountsettings.index');


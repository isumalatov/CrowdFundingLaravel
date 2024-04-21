<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Montamos rutas para Projectos
Route::resource('projects', ProjectController::class);
//contribuciones
Route::resource('/contributions', ContributionController::class);
Route::post('/contributions/search', [ContributionController::class, 'search'])->name('contributions.search');
//Route::get('/contributions', 'ContributionController@index')->name('contributions.index');
//Route::post('/contributions/search', 'ContributionController@search')->name('contributions.search');
//Route::post('/contributions/search', ContributionController::class)->name('contributions.search');;
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::view('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
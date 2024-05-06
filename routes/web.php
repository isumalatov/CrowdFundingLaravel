<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContributionController;

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
Route::get('/projects/{project_id}/contribute', [ContributionController::class, 'create'])->name('contributions.create');
Route::post('/contributions', [ContributionController::class, 'store'])->name('contributions.store');

//Route::get('/contributions', 'ContributionController@index')->name('contributions.index');
//Route::post('/contributions/search', 'ContributionController@search')->name('contributions.search');
//Route::post('/contributions/search', ContributionController::class)->name('contributions.search');;
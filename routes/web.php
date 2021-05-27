<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');

Route::group([
    'middleware' => ['auth:sentinel', 'verified'],
], function (): void {
    Route::get('/home', fn () => Inertia::render('Business/Home'))->name('home');
    Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
});

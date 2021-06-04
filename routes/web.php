<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');

Route::group([
    'middleware' => ['auth:scorch', 'verified'],
], function (): void {
    Route::get('/home', fn () => Inertia::render('Dashboard/Home'))->name('home');

    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
});

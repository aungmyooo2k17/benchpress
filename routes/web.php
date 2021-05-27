<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\InvitationController;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');

Route::group([
    'middleware' => ['auth:sentinel', 'verified'],
], function (): void {
    Route::get('/home', fn () => Inertia::render('Business/Home'))->name('home');
    Route::get('/teams/{team}/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::delete('/teams/{team}/staff/{user}', [StaffController::class, 'destroy'])->name('staff.destroy');
    Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
    Route::delete('/teams/{team}/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');
});

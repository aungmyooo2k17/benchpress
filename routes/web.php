<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvitationController;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');

Route::group([
    'middleware' => ['auth:sentinel', 'verified'],
], function (): void {
    Route::get('/home', fn () => Inertia::render('Business/Home'))->name('home');
    Route::get('/teams/{team}/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::delete('/teams/{team}/staff/{user}', [StaffController::class, 'destroy'])->name('staff.destroy');
    Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::post('/teams/{team}/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    Route::delete('/teams/{team}/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');
    Route::resource('products', ProductController::class);
});

Route::middleware(['signed'])->get('/teams/{team}/invitations/{invitation}', [InvitationController::class, 'update'])->name('invitations.update');

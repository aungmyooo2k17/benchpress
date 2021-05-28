<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvitationController;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');

Route::group([
    'middleware' => ['auth:sentinel', 'verified'],
], function (): void {
    Route::get('/home', fn () => Inertia::render('Business/Home'))->name('home');

    Route::group([
        'prefix' => 'teams',
    ], function () {
        Route::get('/{team}/members', [MemberController::class, 'index'])->name('members.index');
        Route::post('/{team}/members', [MemberController::class, 'store'])->name('members.store');

        Route::get('/{team}/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::delete('/{team}/staff/{user}', [StaffController::class, 'destroy'])->name('staff.destroy');

        Route::get('/{team}', [TeamController::class, 'show'])->name('teams.show');
        Route::put('/{team}', [TeamController::class, 'update'])->name('teams.update');

        Route::post('/{team}/invitations', [InvitationController::class, 'store'])->name('invitations.store');
        Route::delete('/{team}/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');

        Route::resource('/{team}/products', ProductController::class);
    });
});

Route::middleware(['signed'])->get('/teams/{team}/invitations/{invitation}', [InvitationController::class, 'update'])->name('invitations.update');

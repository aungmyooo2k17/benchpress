<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::group([
    'middleware' => ['auth:sentinel'],
], function () {
    Route::group([
        'prefix' => 'teams',
    ], function () {
        Route::get('/{team}/products', [ProductController::class, 'index']);
    });
});

<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:scorch'],
], function () {
    Route::get('/teams/{team}/products', fn () => 'API-OK');
});

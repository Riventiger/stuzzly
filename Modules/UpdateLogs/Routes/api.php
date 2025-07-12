<?php

use Illuminate\Support\Facades\Route;
use Modules\UpdateLogs\Http\Controllers\Api\UpdateLogApiController;

Route::prefix('api/update-logs')
    ->middleware(['api', 'auth:sanctum'])
    ->name('api.update-logs.')
    ->group(function () {
        Route::get('/', [UpdateLogApiController::class, 'index'])->name('index');
        Route::post('/', [UpdateLogApiController::class, 'store'])->name('store');
    });

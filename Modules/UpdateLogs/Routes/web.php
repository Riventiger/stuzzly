<?php

use Illuminate\Support\Facades\Route;
use Modules\UpdateLogs\Http\Controllers\UpdateLogController;

Route::prefix('admin/update-logs')
    ->middleware(['web', 'auth', 'verified'])
    ->name('update-logs.')
    ->group(function () {
        Route::get('/', [UpdateLogController::class, 'index'])->name('index');
        Route::get('/{log}', [UpdateLogController::class, 'show'])->name('show');
    });

<?php

use Illuminate\Support\Facades\Route;

// Group your API routes under a version prefix if needed
Route::prefix('v1')
    ->middleware(['api'])
    ->group(function () {
        // Define your API endpoints for the Blog module here
        Route::get('blogs', fn () => response()->json(['message' => 'List of blogs']));
        // Example:
        // Route::get('blogs/{id}', [ApiBlogController::class, 'show']);
    });

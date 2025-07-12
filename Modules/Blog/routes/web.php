<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

Route::middleware(['web', 'auth', 'verified'])->prefix('blog')->name('blog.')->group(function () {
    Route::resource('/', BlogController::class)->parameters(['' => 'blog']);
});

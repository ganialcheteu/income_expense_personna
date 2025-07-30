<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

// view offline for service worker
Route::get('/offline', function () {
    return view('offline');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

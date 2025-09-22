<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/owner/edit', [AdminController::class, 'editOwner'])->name('admin.owner.edit');
    Route::post('/admin/owner/update', [AdminController::class, 'updateOwner'])->name('admin.owner.update');
});

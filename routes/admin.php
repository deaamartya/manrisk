<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\{
  HomeController,
  UserController
};


Route::middleware(['auth', 'cekAdmin'])->prefix('admin')->name('admin.')->group(function () {
//   Route::get('/notifications/mark-as-read', [NotificationsController::class, 'notifAdminMark'])->name('notifications.mark-as-read');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/get-user/{id}', [UserController::class, 'get_user'])->name('user-get-user');
    Route::post('/user/store/{id?}', [UserController::class, 'store'])->name('user-store');
    Route::put('/user/update-status/{id}', [UserController::class, 'update_status'])->name('user-update-status');
});

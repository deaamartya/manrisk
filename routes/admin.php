<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\{
  HomeController,
};


Route::middleware(['auth', 'cekAdmin'])->prefix('admin')->name('admin.')->group(function () {
//   Route::get('/notifications/mark-as-read', [NotificationsController::class, 'notifAdminMark'])->name('notifications.mark-as-read');
});

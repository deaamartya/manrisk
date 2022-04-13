<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Divisi\{
  HomeController,
};


Route::middleware(['auth', 'cekDivisi'])->prefix('divisi')->name('divisi.')->group(function () {
//   Route::get('/notifications/mark-as-read', [NotificationsController::class, 'notifAdminMark'])->name('notifications.mark-as-read');
});

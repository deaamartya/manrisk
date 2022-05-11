<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\{
    HomeController,
    UserController,
    CompaniesController,
    KonteksController,
    ResikoController
};


Route::middleware(['auth', 'cekAdmin'])->name('admin.')->group(function () {
//   Route::get('/notifications/mark-as-read', [NotificationsController::class, 'notifAdminMark'])->name('notifications.mark-as-read');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/get-user/{id}', [UserController::class, 'get_user'])->name('user-get-user');
    Route::post('/user/store/{id?}', [UserController::class, 'store'])->name('user-store');
    Route::put('/user/update-status/{id}', [UserController::class, 'update_status'])->name('user-update-status');

    Route::get('/perusahaan', [CompaniesController::class, 'index'])->name('perusahaan');
    Route::get('/perusahaan/get-perusahaan/{id}', [CompaniesController::class, 'get_perusahaan'])->name('perusahaan-get-perusahaan');
    Route::post('/perusahaan/store/{id?}', [CompaniesController::class, 'store'])->name('perusahaan-store');
    Route::post('/perusahaan/delete-perusahaan', [CompaniesController::class, 'delete'])->name('perusahaan-delete');

    Route::get('/resiko', [ResikoController::class, 'index'])->name('resiko');
    Route::get('/resiko/get-resiko/{id?}', [ResikoController::class, 'get_resiko'])->name('resiko-get-resiko');
    Route::post('/resiko/store/{id?}', [ResikoController::class, 'store'])->name('resiko-store');
    Route::put('/resiko/delete-resiko', [ResikoController::class, 'delete'])->name('resiko-delete');

    Route::get('/konteks', [KonteksController::class, 'index'])->name('konteks');
    Route::get('/konteks/get-konteks/{id}', [KonteksController::class, 'get_konteks'])->name('konteks-get-konteks');
    Route::post('/konteks/store/{id?}', [KonteksController::class, 'store'])->name('konteks-store');
    Route::put('/konteks/delete-konteks', [KonteksController::class, 'delete'])->name('konteks-delete');
});

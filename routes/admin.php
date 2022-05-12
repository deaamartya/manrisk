<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\{
    HomeController,
    UserController,
    CompaniesController,
    KonteksController,
    RisikoController
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

  Route::get('/risiko', [RisikoController::class, 'index'])->name('risiko');
  Route::get('/risiko/get-risiko/{id?}', [RisikoController::class, 'get_risiko'])->name('risiko-get-risiko');
  Route::post('/risiko/store/{id?}', [RisikoController::class, 'store'])->name('risiko-store');
  Route::put('/risiko/delete-risiko', [RisikoController::class, 'delete'])->name('risiko-delete');

  Route::get('/konteks', [KonteksController::class, 'index'])->name('konteks');
  Route::get('/konteks/get-konteks/{id}', [KonteksController::class, 'get_konteks'])->name('konteks-get-konteks');
  Route::post('/konteks/store/{id?}', [KonteksController::class, 'store'])->name('konteks-store');
  Route::put('/konteks/delete-konteks', [KonteksController::class, 'delete'])->name('konteks-delete');
  Route::get('sumber-risiko-indhan', [SumberRisikoIndhanController::class, 'index'])->name('sumber-risiko-indhan');
  Route::post('sumber-risiko-indhan/search', [SumberRisikoIndhanController::class, 'searchRisiko'])->name('search-risiko');
  Route::post('sumber-risiko-indhan/approval/{id}', [SumberRisikoIndhanController::class, 'approvalRisiko'])->name('approval-risiko');
});

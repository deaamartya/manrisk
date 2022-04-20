<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RiskOfficer\{
  HomeController,
  SumberRisikoController,
  UserController,
  RisikoController,
};

Route::name('risk-officer.')->group(function () {
  Route::get('user', [UserController::class, 'index'])->name('user');
  Route::get('user/get-user/{id}', [UserController::class, 'get_user'])->name('user-get-user');
  Route::post('user/store/{id?}', [UserController::class, 'store'])->name('user-store');
  Route::put('user/update-status/{id}', [UserController::class, 'update_status'])->name('user-update-status');
  Route::get('sumber-resiko', [HomeController::class, 'index'])->name('sumber-resiko');
  Route::get('pengukuran-resiko', [HomeController::class, 'index'])->name('pengukuran-resiko');
  Route::get('pengukuran-korporasi', [HomeController::class, 'index'])->name('pengukuran-korporasi');
  Route::resource('risiko', RisikoController::class);
  Route::get('mitigasi-plan', [HomeController::class, 'index'])->name('mitigasi-plan');
  Route::get('kuesioner', [HomeController::class, 'index'])->name('kuesioner');
  Route::get('table', [HomeController::class, 'table'])->name('table');
  Route::get('form', [HomeController::class, 'form'])->name('form');
});

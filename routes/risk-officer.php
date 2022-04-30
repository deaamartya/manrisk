<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RiskOfficer\{
  HomeController,
  SumberRisikoController,
  UserController,
  RisikoController,
  PengukuranRisikoController,
};

Route::middleware(['auth', 'cekRiskOfficer'])->name('risk-officer.')->group(function () {
  Route::get('user', [UserController::class, 'index'])->name('user');
  Route::get('user/get-user/{id}', [UserController::class, 'get_user'])->name('user-get-user');
  Route::post('user/store/{id?}', [UserController::class, 'store'])->name('user-store');
  Route::put('user/update-status/{id}', [UserController::class, 'update_status'])->name('user-update-status');
  Route::resource('sumber-risiko',SumberRisikoController::class);
  Route::get('pengukuran-risiko', [PengukuranRisikoController::class, 'index'])->name('pengukuran-risiko');
  Route::get('pengukuran-risiko-indhan', [PengukuranRisikoIndhanController::class, 'index'])->name('pengukuran-risiko-indhan');
  Route::resource('risiko', RisikoController::class);
  Route::get('risiko/print/{id}', [RisikoController::class, 'print'])->name('risiko.print');
  Route::get('mitigasi-plan', [HomeController::class, 'index'])->name('mitigasi-plan');
  Route::get('kuesioner', [HomeController::class, 'index'])->name('kuesioner');
  Route::get('table', [HomeController::class, 'table'])->name('table');
  Route::get('form', [HomeController::class, 'form'])->name('form');
});

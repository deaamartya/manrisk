<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RiskOfficer\{
  HomeController,
  SumberRisikoController
};

Route::name('risk-officer.')->group(function () {
  Route::resource('sumber-risiko',SumberRisikoController::class);
  Route::get('pengukuran-risiko', [PengukuranRisikoController::class, 'index'])->name('pengukuran-risiko');
  Route::get('pengukuran-risiko-indhan', [PengukuranRisikoIndhanController::class, 'index'])->name('pengukuran-risiko-indhan');
  Route::resource('risiko', HomeController::class);
  Route::get('mitigasi-plan', [HomeController::class, 'index'])->name('mitigasi-plan');
  Route::get('kuesioner', [HomeController::class, 'index'])->name('kuesioner');
  Route::get('table', [HomeController::class, 'table'])->name('table');
  Route::get('form', [HomeController::class, 'form'])->name('form');
});

<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RiskOfficer\{
  HomeController,
  SumberRisikoController,
  PengukuranRisikoController
};

Route::name('risk-officer.')->group(function () {
  Route::resource('sumber-risiko',SumberRisikoController::class);
  Route::get('pengukuran-risiko', [PengukuranRisikoController::class, 'index'])->name('pengukuran-risiko');
  Route::get('generate-pdf', [PengukuranRisikoController::class, 'generatePDF'])->name('pengukuran-generatePDF');
  Route::post('penilaian-risiko', [PengukuranRisikoController::class, 'penilaianRisiko'])->name('penilaian-risiko');
  Route::post('penilaian-risiko-store', [PengukuranRisikoController::class, 'penilaianRisikoStore'])->name('penilaian-risiko-store');
  
  Route::get('pengukuran-risiko-indhan', [PengukuranRisikoIndhanController::class, 'index'])->name('pengukuran-risiko-indhan');
  Route::resource('risiko', HomeController::class);
  Route::get('mitigasi-plan', [HomeController::class, 'index'])->name('mitigasi-plan');
  Route::get('kuesioner', [HomeController::class, 'index'])->name('kuesioner');
  Route::get('table', [HomeController::class, 'table'])->name('table');
  Route::get('form', [HomeController::class, 'form'])->name('form');
});

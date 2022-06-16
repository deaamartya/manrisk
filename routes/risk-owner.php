<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RiskOwner\{
  PengukuranRisikoController,
  RiskController,
  RiskRegisterIndhanController,
};

use \App\Http\Controllers\{
  HomeController
};

Route::middleware(['auth', 'cekRiskOwner'])->name('risk-owner.')->group(function () {
  Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
  Route::get('pengukuran-risiko', [PengukuranRisikoController::class, 'index'])->name('pengukuran-risiko');
  Route::get('generate-pdf', [PengukuranRisikoController::class, 'generatePDF'])->name('pengukuran-generatePDF');
  Route::post('penilaian-risiko', [PengukuranRisikoController::class, 'penilaianRisiko'])->name('penilaian-risiko');
  Route::post('penilaian-risiko-store', [PengukuranRisikoController::class, 'penilaianRisikoStore'])->name('penilaian-risiko-store');
  Route::resource('risiko', RiskController::class);
  Route::get('risiko/toggle-indhan/{id}', [RiskController::class, 'toggleIndhan'])->name('toggleIndhan');
  Route::get('risiko/approve/{id}', [RiskController::class, 'approve'])->name('risiko.approve');
  Route::get('risiko/print/{id}', [RiskController::class, 'print'])->name('risiko.print');
  
  Route::resource('risk-register-indhan', RiskRegisterIndhanController::class);
  Route::post('risk-register-indhan/import', [RiskRegisterIndhanController::class, 'import'])->name('risk-detail.import');
  Route::post('upload-lampiran-risk-register-indhan', [RiskRegisterIndhanController::class, 'uploadLampiran'])->name('upload-lampiran-risk-register-indhan');
  Route::get('print-risk-register-indhan/{id}', [RiskRegisterIndhanController::class, 'print'])->name('print-risk-register-indhan');
});

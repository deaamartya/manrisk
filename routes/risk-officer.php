<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RiskOfficer\{
  HomeController,
  SumberRisikoController,
  UserController,
  PengukuranRisikoController,
  RisikoController,
  PengajuanMitigasiController,
  RiskDetailController,
  MitigasiPlanController
};

Route::middleware(['auth', 'cekRiskOfficer'])->name('risk-officer.')->group(function () {
  Route::get('user', [UserController::class, 'index'])->name('user');
  Route::get('user/get-user/{id}', [UserController::class, 'get_user'])->name('user-get-user');
  Route::post('user/store/{id?}', [UserController::class, 'store'])->name('user-store');
  Route::put('user/update-status/{id}', [UserController::class, 'update_status'])->name('user-update-status');
  Route::resource('sumber-risiko',SumberRisikoController::class);
  Route::get('pengukuran-risiko', [PengukuranRisikoController::class, 'index'])->name('pengukuran-risiko');
  Route::get('generate-pdf', [PengukuranRisikoController::class, 'generatePDF'])->name('pengukuran-generatePDF');
  Route::post('penilaian-risiko', [PengukuranRisikoController::class, 'penilaianRisiko'])->name('penilaian-risiko');
  Route::post('penilaian-risiko-store', [PengukuranRisikoController::class, 'penilaianRisikoStore'])->name('penilaian-risiko-store');
  Route::resource('risiko', RisikoController::class);
  Route::get('risiko/print/{id}', [RisikoController::class, 'print'])->name('risiko.print');
  Route::post('risiko/upload-lampiran', [RisikoController::class, 'uploadLampiran'])->name('risiko.upload-lampiran');
  Route::resource('pengajuan-mitigasi', PengajuanMitigasiController::class);
  Route::post('risk-detail/import', [RiskDetailController::class, 'import'])->name('risk-detail.import');
  Route::resource('risk-detail', RiskDetailController::class);
  Route::resource('mitigasi-plan', MitigasiPlanController::class);
  Route::get('kuesioner', [HomeController::class, 'index'])->name('kuesioner');
  Route::get('table', [HomeController::class, 'table'])->name('table');
  Route::get('form', [HomeController::class, 'form'])->name('form');

  Route::post('fetchNilaiRisiko', [RisikoController::class, 'getNilai']);
  Route::post('getProgress', [MitigasiPlanController::class, 'getProgressData']);
  Route::post('storeProgress', [MitigasiPlanController::class, 'insertProgress'])->name('storeProgress');
});

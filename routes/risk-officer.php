<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RiskOfficer\{
  // HomeController,
  SumberRisikoController,
  UserController,
  PengukuranRisikoController,
  RisikoController,
  PengajuanMitigasiController,
  RiskDetailController,
  MitigasiPlanController,
  RiskRegisterIndhanController,
  PetaRisikoController,
};

use \App\Http\Controllers\{
  HomeController
};

Route::middleware(['auth', 'cekRiskOfficer'])->name('risk-officer.')->group(function () {
  Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
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
  Route::post('risiko/upload-lampiran', [RisikoController::class, 'uploadLampiran'])->name('risiko.upload-lampiran');
  Route::resource('risiko-indhan', RiskRegisterIndhanController::class);
  Route::resource('pengajuan-mitigasi', PengajuanMitigasiController::class);
  Route::resource('risk-detail', RiskDetailController::class);
  Route::resource('mitigasi-plan', MitigasiPlanController::class);
  Route::get('kuesioner', [HomeController::class, 'index'])->name('kuesioner');
  Route::get('table', [HomeController::class, 'table'])->name('table');
  Route::get('form', [HomeController::class, 'form'])->name('form');

  Route::post('fetchNilaiRisiko', [RisikoController::class, 'getNilai']);
  Route::post('getProgress', [MitigasiPlanController::class, 'getProgressData']);
  Route::post('storeProgress', [MitigasiPlanController::class, 'insertProgress'])->name('storeProgress');
  Route::get('peta-risiko/{id}', [PetaRisikoController::class, 'show'])->name('peta-risiko');
  Route::post('getRisikoSelected', [RisikoController::class, 'getRisikoSelected']);

  Route::resource('risk-register-indhan', RiskRegisterIndhanController::class);
  Route::post('risk-register-indhan/import', [RiskRegisterIndhanController::class, 'import'])->name('risk-detail.import');
  Route::post('upload-lampiran-risk-register-indhan', [RiskRegisterIndhanController::class, 'uploadLampiran'])->name('upload-lampiran-risk-register-indhan');
  Route::get('print-risk-register-indhan/{id}', [RiskRegisterIndhanController::class, 'print'])->name('print-risk-register-indhan');
});

Route::middleware(['cekRiskOfficer'])->name('risk-officer.')->group(function () {
  Route::get('risiko/print/{id}', [RisikoController::class, 'print'])->name('risiko.print');
  Route::get('mitigasi-plan/print/{id}', [MitigasiPlanController::class, 'print'])->name('mitigasi-plan.print');
});

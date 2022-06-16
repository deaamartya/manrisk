<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PenilaiIndhan\{
  PengukuranRisikoIndhanController,
  RiskRegisterKorporasiController,
  RiskRegisterIndhanController,
};

use \App\Http\Controllers\{
  HomeController
};

Route::name('penilai-indhan.')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('pengukuran-risiko-indhan', [PengukuranRisikoIndhanController::class, 'index'])->name('pengukuran-risiko-indhan');
    Route::post('penilaian-risiko-indhan', [PengukuranRisikoindhanController::class, 'penilaianRisiko'])->name('penilaian-risiko-indhan');
    Route::post('penilaian-risiko-indhan-store', [PengukuranRisikoIndhanController::class, 'penilaianRisikoStore'])->name('penilaian-risiko-indhan-store');

    Route::get('risk-register-korporasi', [RiskRegisterKorporasiController::class, 'index'])->name('risk-register-korporasi');
    Route::get('search-risk-header', [RiskRegisterKorporasiController::class, 'searchRiskHeader'])->name('search-risk-header');
    Route::get('all-risk-header', [RiskRegisterKorporasiController::class, 'allRiskHeader'])->name('all-risk-header');
    Route::get('detail-risk-register-korporasi/{id}', [RiskRegisterKorporasiController::class, 'show'])->name('detail-risk-register');
    Route::get('print-risk-register-korporasi/{id}', [RiskRegisterKorporasiController::class, 'print'])->name('print-risk-register');
    Route::post('approval-risk-register-korporasi/{id}', [RiskRegisterKorporasiController::class, 'approval'])->name('approval-risk-register');
    Route::post('risk-detail-korporate/{id}', [RiskRegisterKorporasiController::class, 'korporate'])->name('korporate');
    Route::post('risk-detail-unkorporate/{id}', [RiskRegisterKorporasiController::class, 'unKorporate'])->name('unkorporate');
    Route::post('risk-detail-mitigation/{id}', [RiskRegisterKorporasiController::class, 'mitigation'])->name('mitigation');
    Route::post('risk-detail-not-mitigation/{id}', [RiskRegisterKorporasiController::class, 'notMitigation'])->name('not-mitigation');
    Route::delete('risk-detail-delete/{id}', [RiskRegisterKorporasiController::class, 'deleteRiskDetail'])->name('risk-detail-delete');

    Route::resource('risk-register-indhan', RiskRegisterIndhanController::class);
    Route::post('risk-register-indhan/import', [RiskRegisterIndhanController::class, 'import'])->name('risk-detail.import');
    Route::post('upload-lampiran-risk-register-indhan', [RiskRegisterIndhanController::class, 'uploadLampiran'])->name('upload-lampiran-risk-register-indhan');
    Route::get('print-risk-register-indhan/{id}', [RiskRegisterIndhanController::class, 'print'])->name('print-risk-register-indhan');
});

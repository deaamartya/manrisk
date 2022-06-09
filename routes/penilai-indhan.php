<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PenilaiIndhan\{
  PengukuranRisikoIndhanController
};

Route::name('penilai-indhan.')->group(function () {
    Route::get('pengukuran-risiko-indhan', [PengukuranRisikoIndhanController::class, 'index'])->name('pengukuran-risiko-indhan');
    Route::post('penilaian-risiko-indhan', [PengukuranRisikoindhanController::class, 'penilaianRisiko'])->name('penilaian-risiko-indhan');
    Route::post('penilaian-risiko-indhan-store', [PengukuranRisikoIndhanController::class, 'penilaianRisikoStore'])->name('penilaian-risiko-indhan-store');
});

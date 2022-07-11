<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Penilai\{
  PengukuranRisikoController,
  PetaRisikoController,
};

use \App\Http\Controllers\{
  HomeController
};

Route::name('penilai.')->group(function () {
  Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
  Route::get('pengukuran-risiko', [PengukuranRisikoController::class, 'index'])->name('pengukuran-risiko');
  Route::get('generate-pdf', [PengukuranRisikoController::class, 'generatePDF'])->name('pengukuran-generatePDF');
  Route::post('penilaian-risiko', [PengukuranRisikoController::class, 'penilaianRisiko'])->name('penilaian-risiko');
  Route::post('penilaian-risiko-store', [PengukuranRisikoController::class, 'penilaianRisikoStore'])->name('penilaian-risiko-store');
  Route::get('peta-risiko/{id}', [PetaRisikoController::class, 'show'])->name('peta-risiko');
});

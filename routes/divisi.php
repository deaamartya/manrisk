<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\User\{
  HomeController,
};


Route::prefix('user')->name('user.')->group(function () {
  Route::get('sumber-resiko', [HomeController::class, 'index'])->name('sumber-resiko');
  Route::get('pengukuran-resiko', [HomeController::class, 'index'])->name('pengukuran-resiko');
  Route::get('pengukuran-korporasi', [HomeController::class, 'index'])->name('pengukuran-korporasi');
  Route::get('resiko', [HomeController::class, 'index'])->name('resiko');
  Route::get('mitigasi-plan', [HomeController::class, 'index'])->name('mitigasi-plan');
  Route::get('kuesioner', [HomeController::class, 'index'])->name('kuesioner');
  Route::get('table', [HomeController::class, 'table'])->name('table');
  Route::get('form', [HomeController::class, 'form'])->name('form');
});

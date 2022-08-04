<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\{
    UserController,
    CompaniesController,
    HasilKompilasiRisikoController,
    KonteksController,
    RisikoController,
    SumberRisikoIndhanController,
    RiskRegisterKorporasiController,
    RiskRegisterIndhanController,
    ApprovalHasilMitigasiController,
    MitigasiPlanController,
    MitigasiPlanIndhanController,
    PetaRisikoController,
};

use \App\Http\Controllers\{
  HomeController
};

Route::middleware(['auth', 'cekAdmin'])->name('admin.')->group(function () {
  Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
//   Route::get('/notifications/mark-as-read', [NotificationsController::class, 'notifAdminMark'])->name('notifications.mark-as-read');
  Route::get('/user', [UserController::class, 'index'])->name('user');
  Route::get('/user/get-user/{id}', [UserController::class, 'get_user'])->name('user-get-user');
  Route::post('/user/store/{id?}', [UserController::class, 'store'])->name('user-store');
  Route::put('/user/update-status/{id}', [UserController::class, 'update_status'])->name('user-update-status');

  Route::get('/perusahaan', [CompaniesController::class, 'index'])->name('perusahaan');
  Route::get('/perusahaan/get-perusahaan/{id}', [CompaniesController::class, 'get_perusahaan'])->name('perusahaan-get-perusahaan');
  Route::post('/perusahaan/store/{id?}', [CompaniesController::class, 'store'])->name('perusahaan-store');
  Route::post('/perusahaan/delete-perusahaan', [CompaniesController::class, 'delete'])->name('perusahaan-delete');

  Route::get('/risiko', [RisikoController::class, 'index'])->name('risiko');
  Route::get('/risiko/get-risiko/{id?}', [RisikoController::class, 'get_risiko'])->name('risiko-get-risiko');
  Route::post('/risiko/store/{id?}', [RisikoController::class, 'store'])->name('risiko-store');
  Route::post('/risiko/delete-risiko', [RisikoController::class, 'delete'])->name('risiko-delete');

  Route::get('/hasil-kompilasi-risiko', [HasilKompilasiRisikoController::class, 'index'])->name('hasil-kompilasi-risiko');
  Route::post('/delete-responden/{id}', [HasilKompilasiRisikoController::class, 'delete_responden'])->name('delete-responden');
  Route::get('/responden_datatable', [HasilKompilasiRisikoController::class, 'responden_datatable']);
  Route::get('/sumber_risiko_datatable', [HasilKompilasiRisikoController::class, 'sumber_risiko_datatable']);
  Route::get('/print-kompilasi-hasil-mitigasi/{instansi?}/{tahun?}', [HasilKompilasiRisikoController::class, 'print_kompilasi_hasil_mitigasi']);

  Route::get('/konteks', [KonteksController::class, 'index'])->name('konteks');
  Route::get('/konteks/get-konteks/{id}', [KonteksController::class, 'get_konteks'])->name('konteks-get-konteks');
  Route::post('/konteks/store/{id?}', [KonteksController::class, 'store'])->name('konteks-store');
  Route::post('/konteks/delete-konteks', [KonteksController::class, 'delete'])->name('konteks-delete');
  Route::get('sumber-risiko-indhan', [SumberRisikoIndhanController::class, 'index'])->name('sumber-risiko-indhan');
  Route::post('sumber-risiko-indhan/store', [SumberRisikoIndhanController::class, 'store'])->name('sumber-risiko-indhan.store');
  Route::put('sumber-risiko-indhan/update/{id}', [SumberRisikoIndhanController::class, 'update'])->name('sumber-risiko-indhan.update');
  Route::delete('sumber-risiko-indhan/destroy/{id}', [SumberRisikoIndhanController::class, 'destroy'])->name('sumber-risiko-indhan.destroy');
  Route::get('sumber-risiko-indhan/search', [SumberRisikoIndhanController::class, 'searchRisiko'])->name('search-risiko');
  Route::post('sumber-risiko-indhan/approval/{id}', [SumberRisikoIndhanController::class, 'approvalRisiko'])->name('approval-risiko');

  Route::get('risk-register-korporasi', [RiskRegisterKorporasiController::class, 'index'])->name('risk-register-korporasi');
  Route::get('search-risk-header', [RiskRegisterKorporasiController::class, 'searchRiskHeader'])->name('search-risk-header');
  Route::get('all-risk-header', [RiskRegisterKorporasiController::class, 'allRiskHeader'])->name('all-risk-header');
  Route::get('detail-risk-register-korporasi/{id}', [RiskRegisterKorporasiController::class, 'show'])->name('detail-risk-register');
  Route::get('print-risk-register-korporasi/{id}', [RiskRegisterKorporasiController::class, 'print'])->name('print-risk-register');
  Route::post('approval-risk-register-korporasi/{id}', [RiskRegisterKorporasiController::class, 'approval'])->name('approval-risk-register');
  Route::get('risk-detail-indhan/{id}', [RiskRegisterKorporasiController::class, 'indhan'])->name('risk-register-korporasi.indhan');
  Route::get('risk-detail-non-indhan/{id}', [RiskRegisterKorporasiController::class, 'nonIndhan'])->name('risk-register-korporasi.non-indhan');
  Route::post('risk-detail-mitigation/{id}', [RiskRegisterKorporasiController::class, 'mitigation'])->name('mitigation');
  Route::post('risk-detail-not-mitigation/{id}', [RiskRegisterKorporasiController::class, 'notMitigation'])->name('not-mitigation');
  Route::delete('risk-detail-delete/{id}', [RiskRegisterKorporasiController::class, 'deleteRiskDetail'])->name('risk-detail-delete');
  Route::get('risk-register-korporasi/approve/{id}', [RiskRegisterKorporasiController::class, 'approve'])->name('risk-register-korporasi.approve');

  Route::resource('risk-register-indhan', RiskRegisterIndhanController::class);
  Route::post('risk-register-indhan/import', [RiskRegisterIndhanController::class, 'import'])->name('risk-detail.import');
  Route::post('detail-risk-register-indhan/store', [RiskRegisterIndhanController::class, 'storeDetail'])->name('risk-detail.store');
  Route::post('upload-lampiran-risk-register-indhan', [RiskRegisterIndhanController::class, 'uploadLampiran'])->name('upload-lampiran-risk-register-indhan');
  Route::get('print-risk-register-indhan/{id}', [RiskRegisterIndhanController::class, 'print'])->name('print-risk-register-indhan');
  Route::post('approval-risk-register-indhan/{id}', [RiskRegisterIndhanController::class, 'approval'])->name('approval-risk-register-indhan');

  Route::put('updateDetail/{id}', [RiskRegisterIndhanController::class, 'updateDetail'])->name('risk-detail.update');
  Route::delete('destroyDetail/{id}', [RiskRegisterIndhanController::class, 'destroyDetail'])->name('risk-detail.destroy');

  Route::post('fetchNilaiRisiko', [RiskRegisterIndhanController::class, 'getNilai']);
  Route::post('getRisikoSelected', [RiskRegisterIndhanController::class, 'getRisikoSelected']);

  Route::get('approval-mitigasi/{id}', [ApprovalHasilMitigasiController::class, 'progressMitigasi']);
  Route::put('approval-hasil-mitigasi/persetujuan-mitigasi/{id}', [ApprovalHasilMitigasiController::class, 'approvalHasilMitigasi']);
  Route::put('approval-hasil-mitigasi/approve/{id}', [ApprovalHasilMitigasiController::class, 'approvedHasilMitigasi']);
  Route::put('approval-hasil-mitigasi/not-approve/{id}', [ApprovalHasilMitigasiController::class, 'notApprovedHasilMitigasi']);
  Route::resource('approval-hasil-mitigasi', ApprovalHasilMitigasiController::class);
  Route::resource('mitigasi-plan', MitigasiPlanController::class);
  Route::resource('mitigasi-plan-indhan', MitigasiPlanIndhanController::class);
  Route::post('getProgressIndhan', [MitigasiPlanIndhanController::class, 'getProgressData']);
  Route::post('storeProgressIndhan', [MitigasiPlanIndhanController::class, 'insertProgress'])->name('storeProgress');
  Route::post('getProgress', [MitigasiPlanController::class, 'getProgressData']);
  Route::post('storeProgress', [MitigasiPlanController::class, 'insertProgress'])->name('storeProgress');
  Route::get('peta-risiko/{id}', [PetaRisikoController::class, 'show'])->name('peta-risiko');
});

Route::middleware(['cekAdmin'])->name('admin.')->group(function () {
  Route::get('mitigasi-plan/print/{id}', [MitigasiPlanController::class, 'print'])->name('mitigasi-plan.print');
});


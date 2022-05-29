<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\{
    HomeController,
    UserController,
    CompaniesController,
    HasilKompilasiRisikoController,
    KonteksController,
    RisikoController,
    SumberRisikoIndhanController,
    RiskRegisterIndhanController,
    ApprovalHasilMitigasiController,
    MitigasiPlanController,
};

Route::middleware(['auth', 'cekAdmin'])->name('admin.')->group(function () {
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
  Route::put('/risiko/delete-risiko', [RisikoController::class, 'delete'])->name('risiko-delete');

  Route::get('/hasil-kompilasi-risiko', [HasilKompilasiRisikoController::class, 'index'])->name('hasil-kompilasi-risiko');
  Route::post('/delete-responden/{id}', [HasilKompilasiRisikoController::class, 'delete_responden'])->name('delete-responden');
  Route::get('/responden_datatable', [HasilKompilasiRisikoController::class, 'responden_datatable']);
  Route::get('/sumber_risiko_datatable', [HasilKompilasiRisikoController::class, 'sumber_risiko_datatable']);
  Route::get('/print-kompilasi-hasil-mitigasi/{instansi?}/{tahun?}', [HasilKompilasiRisikoController::class, 'print_kompilasi_hasil_mitigasi']);

  Route::get('/konteks', [KonteksController::class, 'index'])->name('konteks');
  Route::get('/konteks/get-konteks/{id}', [KonteksController::class, 'get_konteks'])->name('konteks-get-konteks');
  Route::post('/konteks/store/{id?}', [KonteksController::class, 'store'])->name('konteks-store');
  Route::put('/konteks/delete-konteks', [KonteksController::class, 'delete'])->name('konteks-delete');
  Route::get('sumber-risiko-indhan', [SumberRisikoIndhanController::class, 'index'])->name('sumber-risiko-indhan');
  Route::post('sumber-risiko-indhan/search', [SumberRisikoIndhanController::class, 'searchRisiko'])->name('search-risiko');
  Route::post('sumber-risiko-indhan/approval/{id}', [SumberRisikoIndhanController::class, 'approvalRisiko'])->name('approval-risiko');
  Route::get('risk-register-indhan', [RiskRegisterIndhanController::class, 'index'])->name('risk-register-indhan');
  Route::get('search-risk-header', [RiskRegisterIndhanController::class, 'searchRiskHeader'])->name('search-risk-header');
  Route::get('all-risk-header', [RiskRegisterIndhanController::class, 'allRiskHeader'])->name('all-risk-header');
  Route::get('detail-risk-register-indhan/{id}', [RiskRegisterIndhanController::class, 'show'])->name('detail-risk-register');
  Route::get('print-risk-register-indhan/{id}', [RiskRegisterIndhanController::class, 'print'])->name('print-risk-register');
  Route::post('approval-risk-register-indhan/{id}', [RiskRegisterIndhanController::class, 'approval'])->name('approval-risk-register');
  Route::post('risk-detail-korporate/{id}', [RiskRegisterIndhanController::class, 'korporate'])->name('korporate');
  Route::post('risk-detail-unkorporate/{id}', [RiskRegisterIndhanController::class, 'unKorporate'])->name('unkorporate');
  Route::post('risk-detail-mitigation/{id}', [RiskRegisterIndhanController::class, 'mitigation'])->name('mitigation');
  Route::post('risk-detail-not-mitigation/{id}', [RiskRegisterIndhanController::class, 'notMitigation'])->name('not-mitigation');
  Route::delete('risk-detail-delete/{id}', [RiskRegisterIndhanController::class, 'deleteRiskDetail'])->name('risk-detail-delete');

  Route::get('approval-mitigasi/{id}', [ApprovalHasilMitigasiController::class, 'progressMitigasi']);
  Route::put('approval-hasil-mitigasi/persetujuan-mitigasi/{id}', [ApprovalHasilMitigasiController::class, 'approvalHasilMitigasi']);
  Route::resource('approval-hasil-mitigasi', ApprovalHasilMitigasiController::class);
  Route::resource('mitigasi-plan', MitigasiPlanController::class);
});


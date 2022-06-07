<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMitigasi;
use Redirect;

class MitigasiPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuan = PengajuanMitigasi::get();
        return view('admin.pengajuan-mitigasi', compact("pengajuan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanMitigasi::where('id', '=', $id)->first();
        $pengajuan->update($request->except('_token'));
        $pengajuan->update([
            'updated_at' => now(),
        ]);
        return Redirect::back()->with(['success-swal' => 'Pengajuan Mitigasi berhasil dikonfirmasi!']);
    }
}

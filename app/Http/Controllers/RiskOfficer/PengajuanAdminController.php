<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMitigasi;
use App\Models\RiskDetail;
use Auth;
use Redirect;

class PengajuanAdminController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanMitigasi::where('company_id', '=', Auth::user()->company_id)
            ->orderBy('status', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->get();
        return view('risk-officer.pengajuan-admin', compact("pengajuan"));
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
        $risk_detail = RiskDetail::where('id_riskd', '=', $pengajuan->id_riskd)->first();
        $pengajuan->update($request->except('_token'));
        $pengajuan->update([
            'updated_at' => now(),
        ]);
        if ($request->is_approved == 1) {
            $risk_detail->update([
                'status_mitigasi' => $pengajuan->tipe_pengajuan,
            ]);
        }
        return Redirect::back()->with(['success-swal' => 'Pengajuan Mitigasi berhasil dikonfirmasi!']);
    }
}

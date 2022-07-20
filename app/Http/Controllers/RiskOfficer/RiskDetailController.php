<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskDetail;
use Redirect;
use App\Imports\RiskDetailImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Models\PengajuanMitigasi;
use App\Models\MitigasiLogs;

class RiskDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['status_mitigasi'] = ($request->r_awal >= 12) ? 1 : 0;
        RiskDetail::insert($data);
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil dibuat!']);
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
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $risk_detail->update($request->except('_token'));
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = PengajuanMitigasi::where('id_riskd', '=', $id)->count('id_riskd');
        $count += MitigasiLogs::where('id_riskd', '=', $id)->count('id_riskd');
        if ($count > 0) {
            return back()->with(["error-swal" => 'Data ini masih digunakan pada pengajuan mitigasi atau log mitigasi. Mohon hapus data yang menggunakan  risiko ini terlebih dahulu.']);
        }
        RiskDetail::destroy($id);
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil dihapus!']);
    }
}

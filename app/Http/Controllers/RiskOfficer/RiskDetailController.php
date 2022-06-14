<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskDetail;
use Redirect;
use App\Imports\RiskDetailImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

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
        RiskDetail::insert($request->except('_token'));
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
        RiskDetail::destroy($id);
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil dihapus!']);
    }

    public function import(Request $request)
    {
        $params = [];
        $risk_detail = Excel::toArray(new RiskDetailImport, $request->file('file'));
        for ($i=0; $i < count($risk_detail[0]); $i++) {
            $params[] = [
                'id_riskh' => $request->id_header,
                'id_s_risiko' => $risk_detail[0][$i]['id_s_risiko'],
                'ppkh' => $risk_detail[0][$i]['ppkh'],
                'indikator' => $risk_detail[0][$i]['indikator'],
                'sebab' => $risk_detail[0][$i]['sebab'],
                'dampak' => $risk_detail[0][$i]['dampak'],
                'uc' => $risk_detail[0][$i]['uc'],
                'pengendalian' => $risk_detail[0][$i]['pengendalian'],
                'l_awal' => $risk_detail[0][$i]['l_awal'],
                'c_awal' => $risk_detail[0][$i]['c_awal'],
                'r_awal' => $risk_detail[0][$i]['r_awal'],
                'peluang' => $risk_detail[0][$i]['peluang'],
                'tindak_lanjut' => $risk_detail[0][$i]['tindak_lanjut'],
                'jadwal' => $risk_detail[0][$i]['jadwal'],
                'pic' => $risk_detail[0][$i]['pic'],
                'mitigasi' => $risk_detail[0][$i]['mitigasi'],
                'jadwal_mitigasi' => $risk_detail[0][$i]['jadwal_mitigasi'],
                'realisasi' => $risk_detail[0][$i]['realisasi'],
                'keterangan' => $risk_detail[0][$i]['keterangan'],
                'l_akhir' => $risk_detail[0][$i]['l_akhir'],
                'c_akhir' => $risk_detail[0][$i]['c_akhir'],
                'r_akhir' => $risk_detail[0][$i]['r_akhir'],
                'status' => $risk_detail[0][$i]['status'],
                'status_mitigasi' => $risk_detail[0][$i]['status_mitigasi'],
                'status_indhan' => $risk_detail[0][$i]['status_indhan'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        DB::beginTransaction();
        RiskDetail::insert($params);
        DB::commit();

        return back()->with(['success-swal' => 'Risk Detail berhasil diimport!']);
    }
}

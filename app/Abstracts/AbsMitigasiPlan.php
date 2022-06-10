<?php

namespace App\Abstracts;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RiskHeader;
use App\Models\RiskDetail;
use Illuminate\Support\Arr;

class AbsMitigasiPlan
{
    public static function getAllData()
    {
        $wr = '1=1';
        if(!Auth::user()->is_admin){
            $wr .= ' AND company_id = '.Auth::user()->company_id;
        }
        $headers = RiskHeader::whereRaw($wr)->get();

        return $headers;
    }

    public static function getDataByIdRiskh($id)
    {
        $headers = RiskHeader::where('id_riskh', '=', $id)->first();

        return $headers;
    }

    public static function updateRiskDetail($request, $id)
    {
        $detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $id_header = $detail->id_riskh;
        $data = Arr::except($request->toArray(), ['_token', 'u_file']);
        $detail->update($data);
        if ($request->u_file) {
            $filename = $request->file('u_file')->getClientOriginalName();
            $folder = '/document/lampiran-mitigasi/';
            $request->file('u_file')->storeAs($folder, $filename, 'public');
            $detail->update([
                'u_file' => $filename,
            ]);
        }

        $results = [
            'detail' => $detail,
            'id_header' => $id_header
        ];

        return $results;
    }

    public static function showApprovalHasilMitigasi($id)
    {
        $logs = DB::table('mitigasi_logs')->where('id_riskd', $id)->get();

        return $logs;
    }

    public static function updateRealisasiApprovalHasilMitigasi($request, $id)
    {
        $query = DB::table('mitigasi_logs')->where('id', $id)->update([
            'realisasi' => $request->realisasi,
            'updated_at' => Carbon::now()
        ]);

        return $query;
    }

    public static function approveHasilMitigasi($request, $id)
    {
        $query = DB::table('mitigasi_logs')->where('id', $id)->update([
            'is_approved' => 1,
            'updated_at' => Carbon::now()
        ]);

        return $query;
    }
}

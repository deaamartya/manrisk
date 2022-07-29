<?php

namespace App\Abstracts;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RiskHeader;
use App\Models\RiskDetail;
use App\Models\MitigasiLogs;
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
        $risk_detail = RiskDetail::where('id_riskd', $id)->first();
        $headers = RiskHeader::where('id_riskh', '=', $risk_detail->id_riskh)->first();

        $results['logs'] = $logs;
        $results['headers'] = $headers;
        $results['risk_detail'] = $risk_detail;

        return $results;
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
        // $query = MitigasiLogs::where('id', $id)->with('risk_detail:id_riskd')->first();
        // $rdetail = RiskDetail::where('id_riskd', $query->risk_detail->id_riskd)->with('risk_header:id_riskh')->first();

        DB::beginTransaction();
        // RiskHeader::where('id_riskh', $rdetail->risk_header->id_riskh)->update([
        //     'status_h_indhan' => 1,
        //     'updated_at' => Carbon::now()
        // ]);
        // $query->is_approved = 1;
        // $query->updated_at = Carbon::now();
        // $query->save();
        DB::table('mitigasi_logs')->where('id', $id)->update([
            'is_approved' => 1,
            'realisasi' => $request->realisasi,
            'updated_at' => Carbon::now()
        ]);
        DB::commit();

        return response()->json(['message' => 'Data berhasil disetujui.'], 200);
    }

    public static function notApproveHasilMitigasi($request, $id)
    {
        DB::beginTransaction();
        DB::table('mitigasi_logs')->where('id', $id)->update([
            'is_approved' => 2,
            'realisasi' => $request->realisasi,
            'updated_at' => Carbon::now()
        ]);
        DB::commit();

        return response()->json(['message' => 'Data berhasil tidak disetujui.'], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\SRisiko;
use DB;

class PetaRisikoController extends Controller
{
    public function show($id, Request $req) {
        $s_risiko = SRisiko::
            select('s_risiko.*', DB::raw('COALESCE(AVG(p.nilai_L), 0) as l_awal'), DB::raw('COALESCE(AVG(p.nilai_C), 0) as c_awal'), DB::raw('COALESCE(AVG(p.nilai_C), 0) * COALESCE(AVG(p.nilai_L), 0) as r_awal'), DB::raw("(CONCAT(k.id_risk, '-', k.no_k)) AS title"))
            ->join('risk_detail as rd', 's_risiko.id_s_risiko', '=', 'rd.id_s_risiko')
            ->join('pengukuran as p', 's_risiko.id_s_risiko', '=', 'p.id_s_risiko')
            ->join('konteks as k', 'k.id_konteks', 's_risiko.id_konteks')
            ->where('s_risiko.company_id', '=', $id)
            ->where('s_risiko.tahun', '=', $req->tahun_risk)
            ->whereNull('s_risiko.deleted_at')
            ->whereNull('rd.deleted_at')
            ->groupBy('s_risiko.id_s_risiko')
            ->get();
        $data_low = [];
        $data_med = [];
        $data_high = [];
        $data_extreme = [];
        $val_r = [];
        $r_total = 0;
        $r_tertinggi = 0;
        foreach($s_risiko as $s) {
            if ($s->r_awal > 0 && $s->c_awal > 0) {
                if ($s->r_awal < 6) {
                    $data_low[] = [ floatval($s->l_awal), floatval($s->c_awal), $s->title ];
                } else if ($s->r_awal < 12) {
                    $data_med[] = [ floatval($s->l_awal), floatval($s->c_awal), $s->title ];
                } else if ($s->r_awal < 16) {
                    $data_high[] = [ floatval($s->l_awal), floatval($s->c_awal), $s->title ];
                } else {
                    $data_extreme[] = [ floatval($s->l_awal), floatval($s->c_awal), $s->title ];
                }
            }
            $r_total += $s->r_awal;
            $val_r[] = $s->r_awal;
        }
        if (count($val_r) > 1) $r_tertinggi = floatval(max($val_r));
        $tahun_req = $req->tahun_risk;
        $company = Perusahaan::where('company_id', $id)->first();
        return view('admin.peta-risiko', compact("s_risiko", "data_low", "data_med", "data_high", "data_extreme", 'r_total', 'r_tertinggi', 'tahun_req', 'company'));
    }
}

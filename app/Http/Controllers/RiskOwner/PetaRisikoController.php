<?php

namespace App\Http\Controllers\RiskOwner;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\SRisiko;
use DB;

class PetaRisikoController extends Controller
{
    public function show($id, Request $req) {
        $s_risiko = SRisiko::
            select('s_risiko.*', 'rd.l_akhir', 'rd.c_akhir', 'rd.r_akhir', DB::raw('COALESCE(AVG(p.nilai_L), 0) as l_awal'), DB::raw('COALESCE(AVG(p.nilai_C), 0) as c_awal'), DB::raw('COALESCE(AVG(p.nilai_C), 0) * COALESCE(AVG(p.nilai_L), 0) as r_awal'), DB::raw("(CONCAT(k.id_risk, '-', k.no_k)) AS title"))
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
        $data_low_mitigasi = [];
        $data_med_mitigasi = [];
        $data_high_mitigasi = [];
        $data_extreme_mitigasi = [];
        $val_r_mitigasi = [];
        $r_total_mitigasi = 0;
        $r_tertinggi = 0;
        foreach($s_risiko as $s) {
            if ($s->r_awal < 6) {
                $data_low[] = [ floatval(number_format($s->l_awal, 2)), floatval(number_format($s->c_awal, 2)), $s->title ];
            } else if ($s->r_awal < 12) {
                $data_med[] = [ floatval(number_format($s->l_awal, 2)), floatval(number_format($s->c_awal, 2)), $s->title ];
            } else if ($s->r_awal < 16) {
                $data_high[] = [ floatval(number_format($s->l_awal, 2)), floatval(number_format($s->c_awal, 2)), $s->title ];
            } else {
                $data_extreme[] = [ floatval(number_format($s->l_awal, 2)), floatval(number_format($s->c_awal, 2)), $s->title ];
            }

            $r_total += $s->r_awal;
            $val_r[] = $s->r_awal;

            if ($s->r_akhir < 6) {
                $data_low_mitigasi[] = [ floatval(number_format($s->l_akhir, 2)), floatval(number_format($s->c_akhir, 2)), $s->title ];
            } else if ($s->r_akhir < 12) {
                $data_med_mitigasi[] = [ floatval(number_format($s->l_akhir, 2)), floatval(number_format($s->c_akhir, 2)), $s->title ];
            } else if ($s->r_akhir < 16) {
                $data_high_mitigasi[] = [ floatval(number_format($s->l_akhir, 2)), floatval(number_format($s->c_akhir, 2)), $s->title ];
            } else {
                $data_extreme_mitigasi[] = [ floatval(number_format($s->l_akhir, 2)), floatval(number_format($s->c_akhir, 2)), $s->title ];
            }
        }
        if (count($val_r) > 1) $r_tertinggi = floatval(max($val_r));
        $tahun_req = $req->tahun_risk;
        $company = Perusahaan::where('company_id', $id)->first();
        return view('risk-owner.peta-risiko',  compact("s_risiko", "data_low", "data_med", "data_high", "data_extreme", 'r_total', 'r_tertinggi', 'tahun_req', 'company', "data_low_mitigasi", "data_med_mitigasi", "data_high_mitigasi", "data_extreme_mitigasi"));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\RiskHeader;
use App\Models\Perusahaan;
use App\Models\SRisiko;
use DB;
use App\Models\RiskDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->is_risk_officer || Auth::user()->is_risk_owner || Auth::user()->is_penilai) {
                $counts_risiko = SRisiko::where('company_id', '=', Auth::user()->company_id)->where('status_s_risiko', 1)->whereNull('deleted_at')->count('id_s_risiko');
                $count_risiko = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                    ->where('rd.company_id', Auth::user()->company_id)
                    ->whereNull('rd.deleted_at')
                    ->count('rd.id_riskd');
                $count_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                    ->where('d.company_id', Auth::user()->company_id)
                    ->where('status_mitigasi', '=', 1)
                    ->whereNull('d.deleted_at')
                    ->count('d.id_riskd');
                $count_done_mitigasi = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                    ->join('mitigasi_logs as m', 'm.id_riskd', 'rd.id_riskd')
                    ->where('rd.company_id', Auth::user()->company_id)
                    ->where('m.realisasi', '=', 100)
                    ->where('m.is_approved', '=', 1)
                    ->whereNull('rd.deleted_at')
                    ->count('rd.id_riskd');
                $company = Perusahaan::where('company_id', Auth::user()->company_id)->get();
                return view('risk-officer.index', compact("counts_risiko", "count_risiko", "count_mitigasi", "count_done_mitigasi", "company"));
            }
            if (Auth::user()->is_penilai_indhan) {
                $counts_risiko = SRisiko::where('status_s_risiko', 1)->whereNull('deleted_at')->count('id_s_risiko');
                $count_risiko = RiskDetail::where('status_indhan', 1) ->whereNull('deleted_at') ->count('id_riskd');
                $count_mitigasi = RiskDetail::where('status_indhan', 1)
                    ->where('tahun', date('Y'))
                    ->where('status_mitigasi', '=', 1)
                    ->whereNull('deleted_at')
                    ->count('id_riskd');
                $count_done_mitigasi = RiskDetail::where('status_indhan', 1)
                    ->join('mitigasi_logs as m', 'm.id_riskd', 'risk_detail.id_riskd')
                    ->where('m.realisasi', '=', 100)
                    ->where('m.is_approved', '=', 1)
                    ->where('tahun', date('Y'))
                    ->where('status_mitigasi', '=', 1)
                    ->whereNull('risk_detail.deleted_at')
                    ->count('risk_detail.id_riskd');
                $company = Perusahaan::where('company_code', '!=', 'INHAN')->get();
                return view('penilai-indhan.index', compact("counts_risiko", "count_risiko", "count_mitigasi", "count_done_mitigasi", "company"));
            }
            if (Auth::user()->is_admin) {
                $counts_risiko = SRisiko::where('status_s_risiko', 1)->whereNull('deleted_at')->count('id_s_risiko');
                $count_risiko = RiskDetail::where('status_indhan', 1) ->whereNull('deleted_at') ->count('id_riskd');
                $count_mitigasi = RiskDetail::where('status_indhan', 1)
                    ->where('tahun', date('Y'))
                    ->where('status_mitigasi', '=', 1)
                    ->whereNull('deleted_at')
                    ->count('id_riskd');
                $count_done_mitigasi = RiskDetail::where('status_indhan', 1)
                    ->join('mitigasi_logs as m', 'm.id_riskd', 'risk_detail.id_riskd')
                    ->where('m.realisasi', '=', 100)
                    ->where('m.is_approved', '=', 1)
                    ->where('tahun', date('Y'))
                    ->where('status_mitigasi', '=', 1)
                    ->whereNull('risk_detail.deleted_at')
                    ->count('risk_detail.id_riskd');
                $company = Perusahaan::where('company_code', '!=', 'INHAN')->get();
                return view('admin.index', compact("counts_risiko", "count_risiko", "count_mitigasi", "count_done_mitigasi", "company"));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function dataRisiko(Request $req) {
        $companies = Perusahaan::limit(5)->get();
        $labels = [];
        $total_risk = [];
        $mitigasi = [];
        $selesai_mitigasi = [];
        foreach ($companies as $c) {
            array_push($labels, $c->instansi);
            $count_risk = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                ->where('rd.company_id', $c->company_id)
                ->where('rd.tahun', '=', $req->tahun)
                ->whereNull('rd.deleted_at')
                ->count('rd.id_riskd');
            array_push($total_risk, $count_risk);

            $count_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                ->where('d.company_id', $c->company_id)
                ->where('status_mitigasi', '=', 1)
                ->where('d.tahun', '=', $req->tahun)
                ->whereNull('d.deleted_at')
                ->count('d.id_riskd');
            array_push($mitigasi, $count_mitigasi);

            $done_mitigasi = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                ->join('mitigasi_logs as m', 'm.id_riskd', 'rd.id_riskd')
                ->where('rd.company_id', $c->company_id)
                ->where('m.realisasi', '=', 100)
                ->where('m.is_approved', '=', 1)
                ->where('rd.tahun', '=', $req->tahun)
                ->whereNull('rd.deleted_at')
                ->count('rd.id_riskd');
            array_push($selesai_mitigasi, $done_mitigasi);
        }
        return response()->json([ "success" => true, "labels" => $labels, "total_risk" => $total_risk, "mitigasi" => $mitigasi, "selesai_mitigasi" => $selesai_mitigasi, ]);
    }

    public function dataKategoriRisiko(Request $req) {
        $labels = [];
        $count = [];
        $kelompok_risk = RiskDetail::select('kr.id_risk', 'kr.risk', DB::raw('COUNT(risk_detail.id_riskd) AS count_risk'))
            ->join('s_risiko as s','s.id_s_risiko','=','risk_detail.id_s_risiko')
            ->join('konteks as k','k.id_konteks','=','s.id_konteks')
            ->join('risk as kr', 'kr.id_risk', '=', 'k.id_risk')
            ->where('risk_detail.company_id', Auth::user()->company_id)
            ->where('risk_detail.tahun', '=', $req->tahun)
            ->whereNull('risk_detail.deleted_at')
            ->groupBy('kr.id_risk')
            ->get();
        $total_risk = RiskDetail::where('risk_detail.company_id', Auth::user()->company_id)
        ->where('risk_detail.tahun', '=', $req->tahun)
        ->whereNull('risk_detail.deleted_at')
        ->count('id_riskd');
        foreach ($kelompok_risk as $c) {
            array_push($labels, $c->risk);
            $count_risk = $c->count_risk / $total_risk * 100;
            array_push($count, $count_risk);
        }
        return response()->json([ "success" => true, "labels" => $labels, "count" => $count ]);
    }

    public function dataKategoriRisikoIndhan(Request $req) {
        $labels = [];
        $count = [];
        $kelompok_risk = RiskDetail::select('kr.id_risk', 'kr.risk', DB::raw('COUNT(risk_detail.id_riskd) AS count_risk'))
            ->join('s_risiko as s','s.id_s_risiko','=','risk_detail.id_s_risiko')
            ->join('konteks as k','k.id_konteks','=','s.id_konteks')
            ->join('risk as kr', 'kr.id_risk', '=', 'k.id_risk')
            ->where('risk_detail.tahun', '=', $req->tahun)
            ->whereNull('risk_detail.deleted_at')
            ->groupBy('kr.id_risk')
            ->get();
        $total_risk = RiskDetail::where('tahun', '=', $req->tahun)
        ->whereNull('deleted_at')
        ->count('id_riskd');
        foreach ($kelompok_risk as $c) {
            array_push($labels, $c->risk);
            $count_risk = $c->count_risk / $total_risk * 100;
            array_push($count, $count_risk);
        }
        return response()->json([ "success" => true, "labels" => $labels, "count" => $count ]);
    }

    public function dataLevelRisiko(Request $req) {
        $labels = ['Risk Level'];
        $countExtreme = 0;
        $countHigh = 0;
        $countMed = 0;
        $countLow = 0;
        $risk_detail = RiskDetail::where('company_id', Auth::user()->company_id)
            ->whereNull('deleted_at')
            ->where('risk_detail.tahun', '=', $req->tahun)
            ->get();
        foreach ($risk_detail as $r) {
            if ($r->r_awal < 6)  $countLow++;
            elseif ($r->r_awal < 12)  $countMed++;
            elseif ($r->r_awal < 16)  $countHigh++;
            else $countExtreme++;
        }
        return response()->json([ "success" => true, "labels" => $labels,"countExtreme" => $countExtreme, "countHigh" => $countHigh, "countMed" => $countMed, "countLow" => $countLow, "risk_detail" => $risk_detail ]);
    }

    public function dataLevelRisikoIndhan(Request $req) {
        $labels = ['Risk Level'];
        $countExtreme = 0;
        $countHigh = 0;
        $countMed = 0;
        $countLow = 0;
        $risk_detail = RiskDetail::whereNull('deleted_at')
            ->where('tahun', '=', $req->tahun)
            ->get();
        foreach ($risk_detail as $r) {
            if ($r->r_awal < 6)  $countLow++;
            elseif ($r->r_awal < 12)  $countMed++;
            elseif ($r->r_awal < 16)  $countHigh++;
            else $countExtreme++;
        }
        return response()->json([ "success" => true, "labels" => $labels,"countExtreme" => $countExtreme, "countHigh" => $countHigh, "countMed" => $countMed, "countLow" => $countLow, "risk_detail" => $risk_detail ]);
    }
}

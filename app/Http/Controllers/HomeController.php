<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\RiskHeader;
use App\Models\Perusahaan;
use App\Models\SRisiko;
use DB;
use App\Models\RiskDetail;
use App\Models\StatusProses;
use App\Models\ProsesManrisk;

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
                    ->whereNull('risk_header.deleted_at')
                    ->count('rd.id_riskd');
                $count_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                    ->where('d.tahun', date('Y'))
                    ->where('d.company_id', Auth::user()->company_id)
                    ->where('status_mitigasi', '=', 1)
                    ->whereNull('d.deleted_at')
                    ->whereNull('risk_header.deleted_at')
                    ->count('d.id_riskd');
                $count_done_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                    ->join('mitigasi_logs as m', 'm.id_riskd', 'd.id_riskd')
                    ->where('d.tahun', date('Y'))
                    ->where('d.company_id', Auth::user()->company_id)
                    ->where('status_mitigasi', '=', 1)
                    ->where('m.realisasi', '=', 100)
                    ->where('m.is_approved', '=', 1)
                    ->whereNull('d.deleted_at')
                    ->whereNull('risk_header.deleted_at')
                    ->count('d.id_riskd');
                $company = Perusahaan::where('company_id', Auth::user()->company_id)->get();
                return view('risk-officer.index', compact("counts_risiko", "count_risiko", "count_mitigasi", "count_done_mitigasi", "company"));
            }
            if (Auth::user()->is_penilai_indhan) {
                $counts_risiko = SRisiko::where('status_s_risiko', 1)->whereNull('deleted_at')->count('id_s_risiko');
                $count_risiko = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                    ->whereNull('rd.deleted_at')
                    ->whereNull('risk_header.deleted_at')
                    ->count('rd.id_riskd');
                $count_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                    ->where('d.tahun', date('Y'))
                    ->where('d.status_mitigasi', '=', 1)
                    ->where('d.status_indhan', 1)
                    ->whereNull('d.deleted_at')
                    ->whereNull('risk_header.deleted_at')
                    ->count('d.id_riskd');
                $count_done_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                    ->join('mitigasi_logs as m', 'm.id_riskd', 'd.id_riskd')
                    ->where('d.tahun', date('Y'))
                    ->where('d.status_indhan', 1)
                    ->where('d.status_mitigasi', '=', 1)
                    ->where('m.realisasi', '=', 100)
                    ->where('m.is_approved', '=', 1)
                    ->whereNull('d.deleted_at')
                    ->whereNull('risk_header.deleted_at')
                    ->count('d.id_riskd');
                $company = Perusahaan::where('company_code', '!=', 'INHAN')->get();
                return view('penilai-indhan.index', compact("counts_risiko", "count_risiko", "count_mitigasi", "count_done_mitigasi", "company"));
            }
            if (Auth::user()->is_admin) {
                $counts_risiko = SRisiko::where('status_s_risiko', 1)->whereNull('deleted_at')->count('id_s_risiko');
                $count_risiko = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                    ->whereNull('rd.deleted_at')
                    ->whereNull('risk_header.deleted_at')
                    ->count('rd.id_riskd');
                $count_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                    ->where('d.tahun', date('Y'))
                    ->where('d.status_mitigasi', '=', 1)
                    ->where('d.status_indhan', 1)
                    ->whereNull('d.deleted_at')
                    ->whereNull('risk_header.deleted_at')
                    ->count('d.id_riskd');
                $count_done_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                    ->join('mitigasi_logs as m', 'm.id_riskd', 'd.id_riskd')
                    ->where('d.tahun', date('Y'))
                    ->where('d.status_indhan', 1)
                    ->where('d.status_mitigasi', '=', 1)
                    ->where('m.realisasi', '=', 100)
                    ->where('m.is_approved', '=', 1)
                    ->whereNull('d.deleted_at')
                    ->whereNull('risk_header.deleted_at')
                    ->count('d.id_riskd');
                $company = Perusahaan::where('company_code', '!=', 'INHAN')->get();
                return view('admin.index', compact("counts_risiko", "count_risiko", "count_mitigasi", "count_done_mitigasi", "company"));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function dataRisiko(Request $req) {
        $companies = Perusahaan::where('company_code', '!=', 'INHAN')->get();
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

    public function dataRisikoKorporasi(Request $req) {
        $companies = Perusahaan::where('company_id', Auth::user()->company_id)->limit(1)->get();
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

    public function dataPetaRisikoKorporasi(Request $req) {
        $company = Perusahaan::where('company_id', Auth::user()->company_id)->pluck('company_id');
        $risiko_rendah = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.company_id', $company)
			->where('r_awal', '>=', 1)
			->where('r_awal', '<', 6)
			->where('d.tahun', $req->tahun)
			->whereNull('risk_header.deleted_at')
			->whereNull('d.deleted_at')
			->count('d.id_riskd');

        $risiko_sedang = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.company_id', $company)
			->where('r_awal', '>=', 6)
			->where('r_awal', '<', 12)
            ->where('d.tahun', $req->tahun)
			->whereNull('risk_header.deleted_at')
			->whereNull('d.deleted_at')
			->count('d.id_riskd');

        $risiko_tinggi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
            ->where('d.company_id', $company)
            ->where('r_awal', '>=', 12)
            ->where('r_awal', '<', 16)
            ->where('d.tahun', $req->tahun)
            ->whereNull('risk_header.deleted_at')
            ->whereNull('d.deleted_at')
            ->count('d.id_riskd');

        $risiko_ekstrem = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
            ->where('d.company_id', $company)
            ->where('r_awal', '>=', 16)
            ->where('d.tahun', $req->tahun)
            ->whereNull('risk_header.deleted_at')
            ->whereNull('d.deleted_at')
            ->count('d.id_riskd');

        $mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
            ->where('d.company_id', $company)
            ->where('status_mitigasi', '=', 1)
            ->where('d.tahun', $req->tahun)
            ->whereNull('d.deleted_at')
            ->count('d.id_riskd');

        $selesai_mitigasi = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
            ->join('mitigasi_logs as m', 'm.id_riskd', 'rd.id_riskd')
            ->where('rd.company_id', $company)
            ->where('m.realisasi', '=', 100)
            ->where('m.is_approved', '=', 1)
            ->where('rd.tahun', $req->tahun)
            ->whereNull('rd.deleted_at')
            ->count('rd.id_riskd');

		if ($mitigasi < 1) {
			$progress_mitigasi = 100;
		}
		else{
            $progress_mitigasi = intval($selesai_mitigasi / $mitigasi * 100);
        }

        return response()->json([ "success" => true, "risiko_rendah" => $risiko_rendah, "risiko_sedang" => $risiko_sedang, "risiko_tinggi" => $risiko_tinggi, "risiko_ekstrem" => $risiko_ekstrem, "mitigasi" => $mitigasi, "selesai_mitigasi" => $selesai_mitigasi, "progress_mitigasi" => $progress_mitigasi]);
    }

    public function dataPetaRisikoIndhan(Request $req) {
        $companies = Perusahaan::where('company_code', '!=', 'INHAN')->get();
        $risiko_rendah = [];
        $risiko_sedang = [];
        $risiko_tinggi = [];
        $risiko_ekstrem = [];
        $mitigasi = [];
        $selesai_mitigasi = [];
        $progress_mitigasi = [];
        foreach ($companies as $c) {
            $count_risiko_rendah = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                ->where('d.company_id', $c->company_id)
                ->where('r_awal', '>=', 1)
                ->where('r_awal', '<', 6)
                ->where('d.tahun', $req->tahun)
                ->whereNull('risk_header.deleted_at')
                ->whereNull('d.deleted_at')
                ->count('d.id_riskd');
            array_push($risiko_rendah, $count_risiko_rendah);

            $count_risiko_sedang = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                ->where('d.company_id', $c->company_id)
                ->where('r_awal', '>=', 6)
                ->where('r_awal', '<', 12)
                ->where('d.tahun', $req->tahun)
                ->whereNull('risk_header.deleted_at')
                ->whereNull('d.deleted_at')
                ->count('d.id_riskd');
            array_push($risiko_sedang, $count_risiko_sedang);

            $count_risiko_tinggi= RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                ->where('d.company_id', $c->company_id)
                ->where('r_awal', '>=', 12)
                ->where('r_awal', '<', 16)
                ->where('d.tahun', $req->tahun)
                ->whereNull('risk_header.deleted_at')
                ->whereNull('d.deleted_at')
                ->count('d.id_riskd');
            array_push($risiko_tinggi, $count_risiko_tinggi);

            $count_risiko_ekstrem = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                ->where('d.company_id', $c->company_id)
                ->where('r_awal', '>=', 16)
                ->where('d.tahun', $req->tahun)
                ->whereNull('risk_header.deleted_at')
                ->whereNull('d.deleted_at')
                ->count('d.id_riskd');
            array_push($risiko_ekstrem, $count_risiko_ekstrem);

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

            if ($count_mitigasi < 1) {
                $count_progress_mitigasi = 100;
            }
            else{
                $count_progress_mitigasi = intval($done_mitigasi / $count_mitigasi * 100);
            }
            array_push($progress_mitigasi, $count_progress_mitigasi);
        }

        return response()->json([ "success" => true, "companies" => $companies, "risiko_rendah" => $risiko_rendah, "risiko_sedang" => $risiko_sedang, "risiko_tinggi" => $risiko_tinggi, "risiko_ekstrem" => $risiko_ekstrem, "mitigasi" => $mitigasi, "selesai_mitigasi" => $selesai_mitigasi, "progress_mitigasi" => $progress_mitigasi]);
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
        $risk_detail = RiskHeader::where('risk_header.company_id', Auth::user()->company_id)
            ->join('risk_detail as rd', 'rd.id_riskh', '=', 'risk_header.id_riskh')
            ->whereNull('risk_header.deleted_at')
            ->whereNull('rd.deleted_at')
            ->where('rd.tahun', '=', $req->tahun)
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
        $companies = Perusahaan::where('company_code', '!=', 'INHAN')->get();
        $labels = [];
        $dataExtreme = [];
        $dataHigh = [];
        $dataMed = [];
        $dataLow = [];
        foreach ($companies as $c) {
            $risk_detail = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', '=', 'risk_header.id_riskh')
                ->whereNull('risk_header.deleted_at')
                ->whereNull('rd.deleted_at')
                ->where('rd.tahun', '=', $req->tahun)
                ->where('risk_header.company_id', $c->company_id)
                ->get();
            array_push($labels, $c->instansi);
            $countExtreme = 0;
            $countHigh = 0;
            $countMed = 0;
            $countLow = 0;
            foreach ($risk_detail as $r) {
                if ($r->r_awal < 6)  $countLow++;
                elseif ($r->r_awal < 12)  $countMed++;
                elseif ($r->r_awal < 16)  $countHigh++;
                else $countExtreme++;
            }
            array_push($dataExtreme, $countExtreme);
            array_push($dataHigh, $countHigh);
            array_push($dataMed, $countMed);
            array_push($dataLow, $countLow);
        }
        return response()->json([ "success" => true, "labels" => $labels,"countExtreme" => $dataExtreme, "countHigh" => $dataHigh, "countMed" => $dataMed, "countLow" => $dataLow ]);
    }

    public function dataStatusProses(Request $request) {
        $proses_list = ProsesManrisk::all();
        $data = StatusProses::join('proses_manrisks as pm', 'status_proses.id_proses', '=', 'pm.id_proses')
            ->where('company_id', '=', Auth::user()->company_id)
            ->where('tahun', '=', $request->tahun)
            ->first();
        return response()->json([ "success" => true, "data" => $data, "list" => $proses_list ]);
    }

    public function dataStatusProsesIndhan(Request $request) {
        $companies = Perusahaan::where('company_code', '!=', 'INHAN')->get();
        $proses_list = ProsesManrisk::all();
        $i = 0;
        $data = [];
        foreach ($companies as $c) {
            $data[$i] = StatusProses::join('proses_manrisks as pm', 'status_proses.id_proses', '=', 'pm.id_proses')
                ->where('company_id', '=', $c->company_id)
                ->where('tahun', '=', $request->tahun)
                ->first();
            $i++;
        }
        return response()->json([ "success" => true, "list" => $proses_list, "data" => $data, 'company' => $companies ]);
    }
}

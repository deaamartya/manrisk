<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\RiskHeader;
use App\Models\Perusahaan;
use App\Models\SRisiko;

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
            $companies = Perusahaan::limit(5)->get();
            $labels = [];
            $total_risk = [];
            $mitigasi = [];
            $selesai_mitigasi = [];
            foreach ($companies as $c) {
                array_push($labels, $c->instansi);
                $count_risk = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                    ->where('rd.company_id', $c->company_id)
                    ->count('rd.id_riskd');
                array_push($total_risk, $count_risk);

                $count_mitigasi = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
                    ->where('d.company_id', $c->company_id)
                    ->where('d.r_awal','>=', 12)
                    ->whereOr('status_mitigasi', '=', 1)
                    ->count('d.id_riskd');
                array_push($mitigasi, $count_mitigasi);

                $done_mitigasi = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                    ->join('mitigasi_logs as m', 'm.id_riskd', 'rd.id_riskd')
                    ->where('rd.company_id', $c->company_id)
                    ->where('m.realisasi', '=', 100)
                    ->where('m.is_approved', '=', 1)
                    ->count('rd.id_riskd');
                array_push($selesai_mitigasi, $done_mitigasi);
            }
            $counts_risiko = SRisiko::where('company_id', '=', Auth::user()->company_id)->count('id_s_risiko');
            $count_risiko = RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
                ->where('rd.company_id', Auth::user()->company_id)
                ->count('rd.id_riskd');
            if (Auth::user()->is_risk_officer) {
                return view('risk-officer.index', compact("labels", "total_risk", "mitigasi", "selesai_mitigasi", "counts_risiko", "count_risiko"));
            }
            if (Auth::user()->is_risk_owner) {
                return view('risk-owner.index');
            }
            if (Auth::user()->is_penilai) {
                return view('penilai.index');
            }
            if (Auth::user()->is_penilai_indhan) {
                return view('penilai-indhan.index');
            }
            if (Auth::user()->is_admin) {
                return view('admin.index');
            }
        } else {
            return redirect()->route('login');
        }
    }
}

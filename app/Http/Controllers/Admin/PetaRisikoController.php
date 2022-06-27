<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Srisiko;
use DB;

class PetaRisikoController extends Controller
{
    public function show($id) {
        $s_risiko = Srisiko::
            select('s_risiko.*', DB::raw('COALESCE(AVG(p.nilai_L), 0) as l_awal'), DB::raw('COALESCE(AVG(p.nilai_C), 0) as c_awal'), DB::raw('COALESCE(AVG(p.nilai_C), 0) * COALESCE(AVG(p.nilai_L), 0) as r_awal'))
            ->leftJoin('pengukuran as p', 's_risiko.id_s_risiko', '=', 'p.id_s_risiko')
            ->where('s_risiko.company_id', '=', $id)
            ->whereNull('s_risiko.deleted_at')
            ->groupBy('s_risiko.id_s_risiko')
            ->get();
        // $count_low = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
        //     ->where('d.company_id', $this->company_id)
        //     ->where('r_awal', '<', 6)
        //     ->whereNull('d.deleted_at')
        //     ->count('d.id_riskd');
        // $count_med = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
        //     ->where('d.company_id', $this->company_id)
        //     ->where('r_awal', '<', 12)
        //     ->whereNull('d.deleted_at')
        //     ->count('d.id_riskd');
        // $count_high = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
        //     ->where('d.company_id', $this->company_id)
        //     ->where('r_awal', '<', 16)
        //     ->whereNull('d.deleted_at')
        //     ->count('d.id_riskd');
        // $count_ext = RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
        //     ->where('d.company_id', $this->company_id)
        //     ->where('r_awal', '>=', 16)
        //     ->whereNull('d.deleted_at')
        //     ->count('d.id_riskd');
        return view('admin.peta-risiko', compact("s_risiko"));
    }
}

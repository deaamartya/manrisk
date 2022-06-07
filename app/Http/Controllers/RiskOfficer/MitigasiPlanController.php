<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Abstracts\AbsMitigasiPlan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeader;
use Auth;
use Illuminate\Support\Arr;
use App\Models\RiskDetail;
use App\Models\MitigasiLogs;

class MitigasiPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = AbsMitigasiPlan::getAllData();
        return view('risk-officer.mitigasi-plan', compact("headers"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headers = AbsMitigasiPlan::getDataByIdRiskh($id);
        // dd($headers);
        return view('risk-officer.mitigasi-detail', compact("headers"));
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
        $query = AbsMitigasiPlan::updateRiskDetail($request, $id);
        $id_header = $query['id_header'];

        return redirect()->route('risk-officer.mitigasi-plan.show', $id_header);
    }

    public function getProgressData(Request $request) {
        $data = null;
        $logs = MitigasiLogs::where('id_riskd', '=', $request->id)->get();
        if($logs != null){
            $data = new \stdClass();
            $data->data = [];
            $count = 0;
            foreach($logs as $c){
                if ($c->dokumen === null) {
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        $c->timestamp,
                        '',
                    ];
                } else {
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        $c->timestamp,
                        '<a href="{{ asset('.'\'document/lampiran-mitigasi/\''.$c->dokumen.') }}"  target="_blank" class="btn btn-secondary">
                        <i data-feather="zoom-out" class="small-icon" height="13"></i>Progress
                        </a>',
                    ];
                }
                array_push($data->data, $isi);
                $count++;
            }
        }
        return response()->json($data);
    }
}

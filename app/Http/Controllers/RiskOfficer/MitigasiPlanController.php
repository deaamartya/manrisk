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
use Redirect;

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
        $logs = MitigasiLogs::where('id_riskd', '=', $request->id)->orderBy('created_at', 'DESC')->get();
        if($logs != null){
            $data = new \stdClass();
            $data->data = [];
            $count = 0;
            foreach($logs as $c){
                if ($c->dokumen === null) {
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        date('d M Y', strtotime($c->created_at)),
                        '',
                        $c->description,
                    ];
                } else {
                    $path = asset('document/mitigasi-progress/'. $c->dokumen);
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        date('d M Y', strtotime($c->created_at)),
                        '<a href="'. $path. '"  target="_blank" class="btn btn-xs btn-info p-1">Lihat Dokumen</a>',
                        $c->description,
                    ];
                }
                array_push($data->data, $isi);
                $count++;
            }
        }
        return response()->json($data);
    }

    public function insertProgress(Request $request) {
        $filename = null;
        if($request->dokumen) {
            $filename = $request->file('dokumen')->getClientOriginalName();
            $folder = '/document/mitigasi-progress/';
            $request->file('dokumen')->storeAs($folder, $filename, 'public');
        }
        MitigasiLogs::insert([
            'id_riskd' => $request->id_riskd,
            'id_user' => $request->id_user,
            'realisasi' => $request->prosentase,
            'dokumen' => $filename,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return Redirect::back()->with(['success-swal' => 'Progress Mitigasi berhasil ditambahkan.']);
    }
}

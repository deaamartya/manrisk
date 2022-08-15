<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeaderIndhan;
use App\Models\RiskDetail;
use App\Models\MitigasiLogs;
use Redirect;

class MitigasiPlanIndhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = RiskHeaderIndhan::all();
        $jml_risk = [];
        foreach($headers as $h) {
            $jml_risk[] = RiskDetail::where('tahun', '=', $h->tahun)
                ->where('status_indhan', '=', 1)
                ->count();
        }
        return view('admin.mitigasi-plan-indhan', compact('headers', 'jml_risk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headers = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        return view('admin.detail-mitigasi-plan-indhan', compact("headers"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProgressData(Request $request) {
        $data = null;
        $logs = MitigasiLogs::where('id_riskd', '=', $request->id)->orderBy('created_at', 'DESC')->get();
        if($logs != null){
            $data = new \stdClass();
            $data->data = [];
            $count = 0;
            foreach($logs as $c){
                if ($c->dokumen == null) {
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        date('d M Y', strtotime($c->created_at)),
                        '',
                        $c->description ? $c->description : '-'
                    ];
                } else {
                    $path = asset('document/mitigasi-progress/'. $c->dokumen);
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        date('d M Y', strtotime($c->created_at)),
                        '<a href="'. $path. '"  target="_blank" class="btn btn-xs btn-info p-1">Lihat Dokumen</a>',
                        $c->description ? $c->description : '-'
                    ];
                }
                array_push($data->data, $isi);
                $count++;
            }
        }
        return response()->json($data);
    }

    public function insertProgress(Request $request) {
        $extension_file = $request->file('dokumen')->extension();
        if($extension_file == "pdf"){
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
                'is_approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return Redirect::back()->with(['success-swal' => 'Progress Mitigasi Indhan berhasil ditambahkan.']);
        }else{
            return Redirect::back()->with(['error-swal' => 'Progress Mitigasi Indhan gagal ditambahkan. File dokumen harus dalam format pdf. Silahkan upload ulang dokumen berekstensi .pdf']);
        }
    }
}

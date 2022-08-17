<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeaderIndhan;
use App\Models\RiskDetail;
use App\Models\MitigasiLogs;
use App\Models\RiskHeader;
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
        $detail_risk = RiskHeader::selectRaw('*,avg(pi.nilai_L) as avg_nilai_l, avg(pi.nilai_C) as avg_nilai_c')
                ->join('perusahaan', 'risk_header.company_id', 'perusahaan.company_id')
                ->join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )  
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                ->leftJoin('pengukuran_indhan as pi', 'pi.id_s_risiko', 's_risiko.id_s_risiko')
                ->where('risk_detail.status_indhan', '=', 1)
                ->where('risk_detail.company_id', '!=', 6)
                ->whereNull('risk_detail.deleted_at')
                ->where('risk_header.tahun', '=', $headers->tahun)
                ->whereNull('risk_header.deleted_at')
                ->where('status_mitigasi', '=', 1)
                ->get();
        $detail_risk_indhan = RiskDetail::selectRaw('*,avg(pi.nilai_L) as avg_nilai_l, avg(pi.nilai_C) as avg_nilai_c')
            ->join('perusahaan as p', 'p.company_id', '=', 'risk_detail.company_id')
            ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
            ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
            ->leftJoin('pengukuran_indhan as pi', 'pi.id_s_risiko', 's_risiko.id_s_risiko')
            ->where('risk_detail.status_indhan', '=', 1)
            ->where('risk_detail.company_id', '=', 6)
            ->whereNull('risk_detail.deleted_at')
            ->where('risk_detail.tahun', '=', $headers->tahun)
            ->where('status_mitigasi', '=', 1)
            ->get();
        return view('admin.detail-mitigasi-plan-indhan', compact("headers", "detail_risk" ,"detail_risk_indhan"));
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
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $data = $request->except('_token');
        $risk_detail->update($data);
        return Redirect::back()->with(['success-swal' => 'Data Mitigasi berhasil diupdate!']);
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
        if($extension_file == "pdf" || $extension_file == "png" || $extension_file == "jpeg" ){
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
            return Redirect::back()->with(['error-swal' => 'Progress Mitigasi Indhan gagal ditambahkan. File dokumen harus dalam format pdf/png/jpeg. Silahkan upload ulang dokumen dengan format sesuai ketentuan.']);
        }
    }
}

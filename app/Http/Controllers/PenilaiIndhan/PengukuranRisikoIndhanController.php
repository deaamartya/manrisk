<?php

namespace App\Http\Controllers\PenilaiIndhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DefendidPengukur;
use App\Abstracts\AbsPengukuran;
use App\Models\PengukuranIndhan;
use App\Models\SRisiko;
use PDF;
use DB;
use Auth;

class PengukuranRisikoIndhanController extends Controller
{
    public function index()
    {
       $results = AbsPengukuran::index('penilai_indhan');
       return view('penilai-indhan.pengukuran-risiko-indhan',  $results);
    }

    public function penilaianRisiko(Request $request) {
        $request->validate([
            'nama_responden' => 'required',
            'tahun' => 'required',
        ]);
        $tahun = $request->tahun;
        $id_responden = $request->id_responden;
        $nama_responden = $request->nama_responden;

        $s_risk_dinilai = SRisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                    ->join('pengukuran_indhan as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
                    ->where('p.id_pengukur', '=', $id_responden)
                    ->where('status_indhan', 1)
                    ->whereNull('p.deleted_at')
                    ->whereNull('s_risiko.deleted_at')
                    ->selectRaw('s_risiko.*, p.*')
                    ->pluck('id_s_risiko');

        $sumber_risiko = SRisiko::select('*')->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks')
            ->join('defendid_user as d', 'd.id_user','s_risiko.id_user')
            ->join('risk as r', 'r.id_risk', 'k.id_risk')
            ->join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
            ->where('s_risiko.tahun', $tahun)
            ->where('risk_detail.status_indhan', 1)
            ->whereNull('s_risiko.deleted_at')
            ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
            ->orderBy('s_risiko.id_s_risiko')
            ->get();

        return view('penilai-indhan.penilaian-risiko-indhan', compact('tahun','id_responden','nama_responden', 'sumber_risiko'));
    }

    
    public function penilaianRisikoStore(Request $request) {
        $request->validate([
        'tahun' => 'required',
        'id_responden' => 'required',
        'nama_responden' => 'required',
        'nilai_L' => 'required',
        'nilai_C' => 'required',
        'id_s_risk' => 'required',
        ]);

        $id_s_risiko = $request->id_s_risk;
        
        for ($i=0; $i < count($id_s_risiko); $i++) { 
            PengukuranIndhan::insert([
                'tahun_p' => $request->tahun,
                'id_s_risiko' => $request->id_s_risk[$i],
                'id_pengukur' => $request->id_responden,
                'nama_responden' => $request->nama_responden,
                'nilai_L' => $request->nilai_L[$i],
                'nilai_C' => $request->nilai_C[$i],
            ]);
        }

        return redirect()->route('penilai-indhan.pengukuran-risiko-indhan')->with('created-alert', 'Data penilaian risiko berhasil disimpan.');
    }

    public function generatePDF()
    {   
        $data = PengukuranIndhan::select('k.id_risk', 'k.konteks', 'sr.s_risiko','p.*', 'pengukuran.tahun_p', DB::raw('AVG(pengukuran_indhan.nilai_L) as L'), DB::raw('AVG(pengukuran_indhan.nilai_C) as C'), DB::raw('AVG(pengukuran.nilai_L) * AVG(pengukuran_indhan.nilai_C) as R'), DB::raw('count(pengukuran_indhan.nama_responden)'))
                ->join('s_risiko as sr', 'pengukuran_indhan.id_s_risiko', 'sr.id_s_risiko')
                ->join('risk_detail as rd', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                ->join('konteks as k', 'sr.id_konteks', 'k.id_konteks')
                ->join('defendid_pengukur as d', 'pengukuran_indhan.id_pengukur', 'd.id_pengukur')
                ->join('perusahaan as p', 'd.company_id', 'p.company_id')
                ->where('pengukuran_indhan.tahun_p', date('Y'))
                ->whereNull('rd.deleted_at')
                ->where('rd.status_indhan', '1')
                ->groupBy('k.id_risk', 'k.konteks',  'sr.s_risiko', 'sr.id_s_risiko')
                ->get();
        $pdf = PDF::loadView('penilai-indhan.form_kompilasi', compact('data'))->setPaper( 'a4','landscape');
        return $pdf->stream('Hasil Kompilasi Risiko.pdf');
    }


}

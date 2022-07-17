<?php

namespace App\Http\Controllers\RiskOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Abstracts\AbsPengukuran;
use App\Models\DefendidPengukur;
use App\Models\Pengukuran;
use App\Models\SRisiko;
use PDF;
use DB;
use Auth;

class PengukuranRisikoController extends Controller
{
    public function index()
    {
        $results = AbsPengukuran::index('risk_officer');
        if($results['sr_exists']){
            return view('risk-owner.pengukuran-risiko', $results);
        } else {
            return view('risk-owner.pengukuran-risiko', $results);
        }
    }

    public function penilaianRisiko(Request $request) {
        $request->validate([
            'nama_responden' => 'required',
            'tahun' => 'required',
        ]);
        $tahun = $request->tahun;
        $id_responden = $request->id_responden;
        $nama_responden = $request->nama_responden;

        $s_risk_dinilai = SRisiko::join('pengukuran as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
        ->where('p.id_pengukur', '=', $id_responden)
        ->where('status_s_risiko', 1)
        ->selectRaw('s_risiko.*, p.*')
        ->pluck('id_s_risiko');

        $sumber_risiko = SRisiko::select('*')->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks')
            ->join('defendid_user as d', 'd.id_user','s_risiko.id_user')
            ->join('risk as r', 'r.id_risk', 'k.id_risk')
            ->where('s_risiko.company_id',  Auth::user()->company_id)
            ->where('s_risiko.tahun', $tahun)
            ->where('s_risiko.status_s_risiko', 1)
            ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
            ->orderBy('s_risiko.id_s_risiko')
            ->get();

        return view('risk-owner.penilaian-risiko', compact('tahun','id_responden','nama_responden', 'sumber_risiko'));

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
            Pengukuran::insert([
                'tahun_p' => date('Y'),
                'id_s_risiko' => $request->id_s_risk[$i],
                'id_pengukur' => $request->id_responden,
                'nama_responden' => $request->nama_responden,
                'nilai_L' => $request->nilai_L[$i],
                'nilai_C' => $request->nilai_C[$i],
            ]);
        }

        return redirect()->route('risk-owner.pengukuran-risiko')->with('created-alert', 'Data penilaian risiko berhasil disimpan.');
    }

    public function generatePDF()
    {
        $data = Pengukuran::select('k.id_risk', 'k.konteks', 'sr.s_risiko', DB::raw('AVG(pengukuran.nilai_L) as L'), DB::raw('AVG(pengukuran.nilai_C) as C'), DB::raw('AVG(pengukuran.nilai_L) * AVG(pengukuran.nilai_C) as R'), DB::raw('count(pengukuran.nama_responden)'))
                ->join('s_risiko as sr', 'pengukuran.id_s_risiko', 'sr.id_s_risiko')
                ->join('konteks as k', 'sr.id_konteks', 'k.id_konteks')
                ->join('defendid_pengukur as d', 'pengukuran.id_pengukur', 'd.id_pengukur')
                ->where('sr.status_s_risiko', '1')
                ->groupBy('k.id_risk', 'k.konteks',  'sr.s_risiko', 'sr.id_s_risiko')
                ->get();
        $pdf = PDF::loadView('risk-owner.form_kompilasi', compact('data'))->setPaper( 'a4','landscape');
        return $pdf->stream('Hasil Kompilasi Risiko.pdf');

    }
}

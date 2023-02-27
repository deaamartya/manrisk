<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
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
            return view('risk-officer.pengukuran-risiko', $results);
        } else {
            return view('risk-officer.pengukuran-risiko', $results);
        }
    }

    public function penilaianRisiko(Request $request)
    {
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
            ->whereNull('p.deleted_at')
            ->whereNull('s_risiko.deleted_at')
            ->selectRaw('s_risiko.*, p.*')
            ->pluck('id_s_risiko');

        $sumber_risiko = SRisiko::select('*')->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks')
            ->join('defendid_user as d', 'd.id_user','s_risiko.id_user')
            ->join('risk as r', 'r.id_risk', 'k.id_risk')
            ->where('s_risiko.company_id',  Auth::user()->company_id)
            ->where('s_risiko.tahun', $tahun)
            ->where('s_risiko.status_s_risiko', 1)
            ->whereNull('s_risiko.deleted_at')
            ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
            ->orderBy('s_risiko.id_s_risiko')
            ->get();

        return view('risk-officer.penilaian-risiko', compact('tahun','id_responden','nama_responden', 'sumber_risiko'));
    }

    public function penilaianRisikoStore(Request $request)
    {
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

        return redirect()->route('risk-officer.pengukuran-risiko')->with('created-alert', 'Data penilaian risiko berhasil disimpan.');
    }

    public function generatePDF()
    {
        $data = Pengukuran::select('k.id_risk', 'k.konteks', 'sr.s_risiko', 'p.*', 'pengukuran.tahun_p', DB::raw('AVG(pengukuran.nilai_L) as L'), DB::raw('AVG(pengukuran.nilai_C) as C'), DB::raw('AVG(pengukuran.nilai_L) * AVG(pengukuran.nilai_C) as R'), DB::raw('count(pengukuran.nama_responden)'))
                ->join('s_risiko as sr', 'pengukuran.id_s_risiko', 'sr.id_s_risiko')
                ->join('konteks as k', 'sr.id_konteks', 'k.id_konteks')
                ->join('defendid_pengukur as d', 'pengukuran.id_pengukur', 'd.id_pengukur')
                ->join('perusahaan as p', 'd.company_id', 'p.company_id')
                ->where('sr.status_s_risiko', '1')
                ->where('sr.company_id', '=', Auth::user()->company_id)
                ->groupBy('k.id_risk', 'k.konteks',  'sr.s_risiko', 'sr.id_s_risiko')
                ->get();
        $pdf = PDF::loadView('risk-officer.form_kompilasi', compact('data'))->setPaper( 'a4','landscape');
        return $pdf->stream('Hasil Kompilasi Risiko.pdf');
    }

    public function destroy($id)
    {
        Pengukuran::destroy($id);
        return Redirect::back()->with(['success-swal' => 'Pengukuran berhasil dihapus!']);
    }
}

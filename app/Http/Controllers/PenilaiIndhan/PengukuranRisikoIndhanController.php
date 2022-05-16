<?php

namespace App\Http\Controllers\PenilaiIndhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DefendidPengukur;
use App\Models\Pengukuran;
use App\Models\PengukuranKorporasi;
use App\Models\SRisiko;
use App\Models\Risk;
use App\Models\RiskHeader;
use App\Models\RiskDetail;
use PDF;
use DB;
use Auth;


class PengukuranRisikoIndhanController extends Controller
{
    public function index()
    {
        $jml_risk = Srisiko::where('tahun', date('Y'))->where('status_korporasi', 1)->count();
        $data_sr = Srisiko::where('tahun', date('Y'))->where('status_korporasi', 1)->limit(1)->get();
        
        foreach($data_sr as $d){
            $pengukuran = PengukuranKorporasi::join('s_risiko', 'pengukuran_korporasi.id_s_risiko', 's_risiko.id_s_risiko')
                        ->where('pengukuran_korporasi.id_s_risiko', $d->id_s_risiko)->get();
               
            $company_id = Auth::user()->company_id;
            $jabatan = DefendidPengukur::join('defendid_user', 'defendid_pengukur.id_user', 'defendid_user.id_user')
                        ->where('is_penilai_indhan', 1)->get();

            $arr_pengukur = [];
            foreach($jabatan as $i=>$j){
                $pengukur_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                ->where('pengukuran.id_s_risiko', $d->id_s_risiko)
                ->where('pengukuran.nama_responden', $j->jabatan)
                ->get();  

                if(count($pengukur_risk) == 0){
                        $arr_pengukur[] = $j;
                }
                    
            }
        // dd(count($arr_pengukur));
        }
        return view('penilai-indhan.pengukuran-risiko-indhan', compact('jml_risk','data_sr','jabatan','pengukuran','arr_pengukur'));
    }


    public function penilaianRisiko(Request $request) {
        $request->validate([
            'nama_responden' => 'required',
            'tahun' => 'required',
        ]);
        $tahun = $request->tahun;
        $id_responden = $request->id_responden;
        $nama_responden = $request->nama_responden;

        $sumber_risiko = SRisiko::select('*')->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks')
        ->join('defendid_user as d', 'd.id_user','s_risiko.id_user')
        ->join('risk as r', 'r.id_risk', 'k.id_risk')
        ->where('s_risiko.tahun', $tahun)
        ->where('s_risiko.status_korporasi', 1)
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
            PengukuranKorporasi::insert([
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
        $data = PengukuranKorporasi::select('k.id_risk', 'k.konteks', 'sr.s_risiko', DB::raw('AVG(pengukuran_korporasi.nilai_L) as L'), DB::raw('AVG(pengukuran_korporasi.nilai_C) as C'), DB::raw('AVG(pengukuran.nilai_L) * AVG(pengukuran_korporasi.nilai_C) as R'), DB::raw('count(pengukuran_korporasi.nama_responden)'))
                ->join('s_risiko as sr', 'pengukuran_korporasi.id_s_risiko', 'sr.id_s_risiko')
                ->join('konteks as k', 'sr.id_konteks', 'k.id_konteks')
                ->join('defendid_pengukur as d', 'pengukuran_korporasi.id_pengukur', 'd.id_pengukur')
                ->where('pengukuran_korporasi.tahun_p', '2022')
                ->where('sr.status_korporasi', '1')
                ->groupBy('k.id_risk', 'k.konteks',  'sr.s_risiko', 'sr.id_s_risiko')
                ->get();
        $pdf = PDF::loadView('penilai-indhan.form_kompilasi', compact('data'))->setPaper( 'a4','landscape');
        return $pdf->stream('Hasil Kompilasi Risiko.pdf');

    }


}

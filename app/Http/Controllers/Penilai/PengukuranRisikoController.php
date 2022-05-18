<?php

namespace App\Http\Controllers\Penilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $user =  Auth::user()->id_user;
        $jml_risk = Srisiko::where('id_user', $user)->where('tahun', date('Y'))->where('status_s_risiko', 1)->count();
        $data_sr = Srisiko::where('id_user', $user)->where('tahun', date('Y'))
                            ->where('status_s_risiko', 1)->limit(1)->get();
                            
        // dd($data_sr);
        foreach($data_sr as $d){
            $pengukuran = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
                ->where('pengukuran.tahun_p', date('Y'))   
                ->where('pengukuran.id_s_risiko', $d->id_s_risiko)
                ->where('defendid_pengukur.id_user', $user)
                ->get();  
        // dd(count($pengukuran));

            $pengukur_user = DefendidPengukur::where('id_user', $user)->get();
            $arr_pengukur = [];
            foreach($pengukur_user as $i=>$p){
                $pengukur_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
                ->where('pengukuran.tahun_p', date('Y'))   
                ->where('pengukuran.id_s_risiko', $d->id_s_risiko)
                ->where('pengukuran.id_pengukur', $p->id_pengukur)
                ->get();  
                //blom melakukan pengukuran
                if(count($pengukur_risk) == 0){
                        $arr_pengukur[] = $p;
                }
                    
            }
        }
        $sumber_risiko = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
            ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
            ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
            ->join('defendid_user', 'defendid_pengukur.company_id','defendid_user.company_id')
            ->where('defendid_user.id_user', $user)
            ->where('pengukuran.tahun_p', date('Y'))
            ->where('s_risiko.status_s_risiko', 1)
            ->get();
            // dd(count($sumber_risiko));
        return view('penilai.pengukuran-risiko', compact('jml_risk','data_sr','pengukuran', 'arr_pengukur','sumber_risiko'));
    }


    public function penilaianRisiko(Request $request) {
        $request->validate([
            'nama_responden' => 'required',
            'tahun' => 'required',
        ]);
        $tahun = $request->tahun;
        $id_responden = $request->id_responden;
        $nama_responden = $request->nama_responden;

        $id_user = Auth::user()->id_user;

        $sumber_risiko = SRisiko::select('*')->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks')
        ->join('defendid_user as d', 'd.id_user','s_risiko.id_user')
        ->join('risk as r', 'r.id_risk', 'k.id_risk')
        ->where('s_risiko.id_user', $id_user)
        ->where('s_risiko.tahun', $tahun)
        ->where('s_risiko.status_s_risiko', 1)
        ->orderBy('s_risiko.id_s_risiko')
        ->get();

        return view('penilai.penilaian-risiko', compact('tahun','id_responden','nama_responden', 'sumber_risiko'));
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
                'tahun_p' => $request->tahun,
                'id_s_risiko' => $request->id_s_risk[$i],
                'id_pengukur' => $request->id_responden,
                'nama_responden' => $request->nama_responden,
                'nilai_L' => $request->nilai_L[$i],
                'nilai_C' => $request->nilai_C[$i],
            ]);
        }

        return redirect()->route('penilai.pengukuran-risiko')->with('created-alert', 'Data penilaian risiko berhasil disimpan.');
    }


    public function generatePDF()
    {   
        $data = Pengukuran::select('k.id_risk', 'k.konteks', 'sr.s_risiko', DB::raw('AVG(pengukuran.nilai_L) as L'), DB::raw('AVG(pengukuran.nilai_C) as C'), DB::raw('AVG(pengukuran.nilai_L) * AVG(pengukuran.nilai_C) as R'), DB::raw('count(pengukuran.nama_responden)'))
                ->join('s_risiko as sr', 'pengukuran.id_s_risiko', 'sr.id_s_risiko')
                ->join('konteks as k', 'sr.id_konteks', 'k.id_konteks')
                ->join('defendid_pengukur as d', 'pengukuran.id_pengukur', 'd.id_pengukur')
                ->where('pengukuran.tahun_p', date('Y'))
                ->where('sr.status_s_risiko', '1')
                ->groupBy('k.id_risk', 'k.konteks',  'sr.s_risiko', 'sr.id_s_risiko')
                ->get();
        $pdf = PDF::loadView('penilai.form_kompilasi', compact('data'))->setPaper( 'a4','landscape');
        return $pdf->stream('Hasil Kompilasi Risiko.pdf');

    }
}

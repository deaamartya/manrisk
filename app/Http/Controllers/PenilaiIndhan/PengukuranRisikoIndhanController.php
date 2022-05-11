<?php

namespace App\Http\Controllers\PenilaiIndhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DefendidPengukur;
use App\Models\Pengukuran;
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
        $user =  Auth::user()->id_user;
        $jml_risk = Srisiko::where('id_user', $user)->where('tahun', '2022')->where('status_s_risiko', 1)->count();
        $data_sr = Srisiko::where('id_user', $user)->where('tahun', '2022')
                            ->where('status_s_risiko', 1)->limit(1)->get();
                            
        // dd($data_sr);
        foreach($data_sr as $d){
            $pengukuran = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                        ->where('pengukuran.id_s_risiko', $d->id_s_risiko)->get();
               
            $company_id = Auth::user()->company_id;
            $jabatan = DefendidPengukur::where('company_id', $company_id)->get();

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

        //---------------------
       
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

        $id_user = Auth::user()->id_user;
        $sumber_risiko = SRisiko::select('*')->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks')
        ->join('defendid_user as d', 'd.id_user','s_risiko.id_user')
        ->join('risk as r', 'r.id_risk', 'k.id_risk')
        ->where('s_risiko.id_user', $id_user)
        ->where('s_risiko.tahun', $tahun)
        ->where('s_risiko.status_s_risiko', 1)
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
            Pengukuran::insert([
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


}

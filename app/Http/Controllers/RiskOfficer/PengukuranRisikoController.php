<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use App\Models\DefendidPengukur;
use App\Models\Pengukuran;
use Illuminate\Http\Request;
use App\Models\SRisiko;
use App\Models\Risk;
use PDF;
use DB;

class PengukuranRisikoController extends Controller
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
        $sumber_risiko = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
            ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
            ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
            ->join('defendid_user', 'defendid_pengukur.company_id','defendid_user.company_id')
            ->where('defendid_user.id_user', $user)
            ->where('pengukuran.tahun_p', '2022')
            ->where('s_risiko.status_s_risiko', 1)
            ->get();

        return view('risk-officer.pengukuran-risiko', compact('jml_risk','data_sr','jabatan','pengukuran','arr_pengukur','sumber_risiko'));
    }


    public function generatePDF()
    {   
        $data = Pengukuran::select('k.id_risk', 'k.konteks', 'sr.s_risiko', DB::raw('AVG(pengukuran.nilai_L) as L'), DB::raw('AVG(pengukuran.nilai_C) as C'), DB::raw('AVG(pengukuran.nilai_L) * AVG(pengukuran.nilai_C) as R'), DB::raw('count(pengukuran.nama_responden)'))
                ->join('s_risiko as sr', 'pengukuran.id_s_risiko', 'sr.id_s_risiko')
                ->join('konteks as k', 'sr.id_konteks', 'k.id_konteks')
                ->join('defendid_pengukur as d', 'pengukuran.id_pengukur', 'd.id_pengukur')
                ->where('pengukuran.tahun_p', '2022')
                ->where('sr.status_s_risiko', '1')
                ->groupBy('k.id_risk', 'k.konteks',  'sr.s_risiko', 'sr.id_s_risiko')
                ->get();
        $pdf = PDF::loadView('risk-officer.form_kompilasi', compact('data'))->setPaper( 'a4','landscape');
        return $pdf->stream('Hasil Kompilasi Risiko.pdf');

    }

}

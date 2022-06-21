<?php

namespace App\Http\Controllers\RiskOfficer;

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
        // $jml_risk = Srisiko::where('company_id', Auth::user()->company_id)->where('status_s_risiko', 1)->count();
        // $jml_risk = 0;
        // $data_sr = Srisiko::where('company_id', Auth::user()->company_id)->where('status_s_risiko', 1)->get();
        // // dd($data_sr);
        // $arr_pengukuran = [];
        // if(count($data_sr) > 0){
        //     $sr_exists = true;
        //     foreach($data_sr as $d){
        //         // $pengukuran = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
        //         //             ->where('pengukuran.id_s_risiko', $d->id_s_risiko)
        //         //             ->get();
        //         $pengukuran = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
        //                     ->where('pengukuran.id_s_risiko', $d->id_s_risiko)
        //                     ->groupBy('tahun', 'id_pengukur')
        //                     ->get();
        //         $jml_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
        //                     ->groupBy('tahun', 'id_pengukur')
        //                     ->count();
        //         // dd($jml_risk);  
        //         if(count($pengukuran) > 0){
        //             foreach($pengukuran as $j=>$pk){
        //                 $arr_pengukuran[$j] = $pk;
        //             }
        //         }
        //         // dd($arr_pengukuran);
        //         $pengukur = DefendidPengukur::where('id_user', Auth::user()->id_user)->get();

        //         $arr_pengukur = [];
        //         $tahun = SRisiko::select('tahun')->distinct()->get();
        //         // dd($tahun);
        //         foreach($pengukur as $i=>$p){
        //             foreach($tahun as $j=>$t){
        //                 $pengukur_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
        //                     ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
        //                     ->where('tahun', $t->tahun)
        //                     ->where('pengukuran.id_s_risiko', $d->id_s_risiko)
        //                     ->where('pengukuran.id_pengukur', $p->id_pengukur)
        //                     ->get();  

        //                 $jml_risk_pengukur = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
        //                         ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
        //                         ->where('tahun', $t->tahun)
        //                         ->where('pengukuran.id_pengukur', $p->id_pengukur)
        //                         ->count();
        //                 // dd($jml_risk_pengukur);
        //                 // dd(count($pengukur_risk));
        //                 if(count($pengukur_risk) == 0){
        //                     $arr_pengukur = 
        //                     [
        //                         'id_pengukur' => $p->id_pengukur,
        //                         'jabatan' => $p->jabatan,
        //                         'tahun' => $t->tahun,
        //                     ];
                            
        //                 }
        //         }
                    
                        
        //     }
        //         dd(count($arr_pengukur));
        //     }
        //     // dd($arr_pengukuran);
        //     // dd($jml_risk); 
        //     $sumber_risiko = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
        //         ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
        //         ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
        //         ->join('defendid_user', 'defendid_pengukur.company_id','defendid_user.company_id')
        //         // ->where('defendid_user.id_user', Auth::user()->id_user)
        //         ->where('s_risiko.status_s_risiko', 1)
        //         ->get();
        //         // dd(count($sumber_risiko));
        //         return view('risk-officer.pengukuran-risiko', compact('jml_risk', 'jml_risk_pengukur','data_sr','arr_pengukuran','arr_pengukur','sumber_risiko', 'sr_exists'));
        // }else{
        //     $sr_exists = false;
        //     return view('risk-officer.pengukuran-risiko', compact('sr_exists'));
        // }
    
        $total_jml_risk = Srisiko::where('company_id', Auth::user()->company_id)->where('status_s_risiko', 1)->count();
        $data_sr = Srisiko::where('company_id', Auth::user()->company_id)->where('status_s_risiko', 1)->get();
        $data_p = Pengukuran::leftJoin('defendid_pengukur', 'defendid_pengukur.id_pengukur', 'pengukuran.id_pengukur')->where('defendid_pengukur.company_id', Auth::user()->company_id)->get();
        // dd($data_p);
        if(count($data_sr) > 0){
            $sr_exists = true;
            $id_s_risiko = [];
            $id_s_risiko_from_pengukuran = [];
            foreach($data_sr as $index => $dsr){
                $id_s_risiko[] = $dsr->id_s_risiko;
            }
            foreach($data_p as $index => $dp){
                $id_s_risiko_from_pengukuran[] = $dp->id_s_risiko;
            }

            // dd($id_s_risiko_from_pengukuran);
            
            $pengukuran_1 = Srisiko::leftJoin('pengukuran', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                        ->leftJoin('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
                        ->whereIn('pengukuran.id_s_risiko', $id_s_risiko)
                        ->groupBy('defendid_pengukur.id_pengukur', 's_risiko.tahun')
                        ->selectRaw('s_risiko.*, COUNT(s_risiko.id_s_risiko) as jml_risk, pengukuran.*, defendid_pengukur.*')
                        ->get();
            // dd($pengukuran_1);
            
            $pengukuran_2 = Srisiko::leftJoin('pengukuran', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                            ->leftJoin('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
                            ->whereNotIn('s_risiko.id_s_risiko', $id_s_risiko_from_pengukuran)
                            ->groupBy('defendid_pengukur.id_pengukur', 's_risiko.tahun')
                            ->selectRaw('s_risiko.*, COUNT(s_risiko.id_s_risiko) as jml_risk, defendid_pengukur.*, pengukuran.nama_responden, pengukuran.tgl_penilaian, pengukuran.tahun_p')
                            ->get();
            // dd($pengukuran_2);

            $pengukuran = $pengukuran_1->merge($pengukuran_2);

            $sumber_risiko = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
                ->join('defendid_user', 'defendid_pengukur.company_id','defendid_user.company_id')
                ->where('defendid_user.id_user', Auth::user()->id_user)
                ->where('s_risiko.status_s_risiko', 1)
                ->get();
                // dd(count($sumber_risiko));
                return view('risk-officer.pengukuran-risiko', compact('data_sr','pengukuran_1', 'pengukuran_2','sumber_risiko', 'sr_exists'));
        }else{
            $sr_exists = false;
            return view('risk-officer.pengukuran-risiko', compact('sr_exists'));
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

        $sumber_risiko = SRisiko::select('*')->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks')
        ->join('defendid_user as d', 'd.id_user','s_risiko.id_user')
        ->join('risk as r', 'r.id_risk', 'k.id_risk')
        ->where('s_risiko.company_id',  Auth::user()->company_id)
        ->where('s_risiko.tahun', $tahun)
        ->where('s_risiko.status_s_risiko', 1)
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
                'tahun_p' => $request->tahun,
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
                ->groupBy('k.id_risk', 'k.konteks',  'sr.s_risiko', 'sr.id_s_risiko')
                ->get();
        $pdf = PDF::loadView('risk-officer.form_kompilasi', compact('data'))->setPaper( 'a4','landscape');
        return $pdf->stream('Hasil Kompilasi Risiko.pdf');
    }

}

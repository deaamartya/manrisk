<?php

namespace App\Abstracts;

// use App\Abstracts\AbsPengukuran;
use App\Models\DefendidPengukur;
use App\Models\Pengukuran;
use App\Models\SRisiko;
use DB;
use Auth;

class AbsPengukuran
{
    public static function index($filter)
    {
        $wr = '1=1';
        $wr_sr = 's_risiko.status_s_risiko = 1';
        if($filter != 'risk_officer'){
            if($filter == 'penilai' || $filter == 'penilai_indhan'){
                $wr_sr .= " AND defendid_pengukur.id_user = ".Auth::user()->id_user;
                $wr .= " AND defendid_pengukur.id_user = ".Auth::user()->id_user;
            }
        }
        else{
            $wr .= " AND defendid_pengukur.company_id = ".Auth::user()->company_id;
        }

        $data_pengukur = DefendidPengukur::whereRaw($wr)->get();

        if($filter == 'penilai_indhan'){
            // dd($data_sr);
            // foreach($data_sr as $d){
            //     // dd($d->id_s_risiko);
            //     $pengukuran = PengukuranIndhan::join('s_risiko', 'pengukuran_indhan.id_s_risiko', 's_risiko.id_s_risiko')
            //         ->where('pengukuran_indhan.id_s_risiko', $d->id_s_risiko)->get();
            //     // dd($pengukuran);
            //     // $jabatan = DefendidPengukur::join('defendid_user', 'defendid_pengukur.id_user', 'defendid_user.id_user')->where('defendid_user.is_penilai_indhan', 1)->get();
            //     $pengukur = DefendidPengukur::where('id_user', Auth::user()->id_user)->get();
            //     // dd($pengukur);
            //     $arr_pengukur = [];
            //     foreach($pengukur as $i=>$p){
            //         $pengukur_risk = PengukuranIndhan::join('s_risiko', 'pengukuran_indhan.id_s_risiko', 's_risiko.id_s_risiko')
            //         ->join('defendid_pengukur', 'pengukuran_indhan.id_pengukur', 'defendid_pengukur.id_pengukur')
            //         ->where('pengukuran_indhan.id_s_risiko', $d->id_s_risiko)
            //         ->where('pengukuran_indhan.id_pengukur', $p->id_pengukur)
            //         ->get();

            //         if(count($pengukur_risk) == 0){
            //                 $arr_pengukur[] = $p;
            //         }
            //     }
            // // dd(count($arr_pengukur));
            // }

            $data_sr = Srisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')->where('status_indhan', 1)->get();
            // dd($data_pengukur);
            if(count($data_sr) > 0){
                $pengukuran_1 = [];
                $pengukuran_2 = [];

                foreach($data_pengukur as $dp) {
                    // get all id_s_risiko yang sudah dinilai
                    $s_risk_dinilai = Srisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                        ->join('pengukuran_indhan as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
                        ->where('p.id_pengukur', '=', $dp->id_pengukur)
                        ->where('status_indhan', 1)
                        ->selectRaw('s_risiko.*, p.*')
                        ->pluck('id_s_risiko');
                    // count id_s_risiko yang sudah dinilai group by tahun
                    $s_risk_dinilai_yearly = Srisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                        ->join('pengukuran_indhan as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
                        ->where('p.id_pengukur', '=', $dp->id_pengukur)
                        ->where('status_indhan', 1)
                        ->groupBy('s_risiko.tahun')
                        ->selectRaw('s_risiko.*, COUNT(s_risiko.id_s_risiko) as jml_risk, p.*')
                        ->get();
                    foreach($s_risk_dinilai_yearly as $s) {
                        $pengukuran_1[] = $s;
                    }
                    $s_risk = Srisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                        ->where('status_indhan', 1)
                        ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
                        ->groupBy('s_risiko.tahun')
                        ->selectRaw('s_risiko.*, COUNT(s_risiko.id_s_risiko) as jml_risk')
                        ->get();
                    foreach($s_risk as $s) {
                        $s->nama_responden = $dp->nama;
                        $s->jabatan = $dp->jabatan;
                        $s->id_pengukur = $dp->id_pengukur;
                        $pengukuran_2[] = $s;
                    }

                    // dd($pengukuran_2);
                }

                $results['data_sr'] = $data_sr;
                $results['pengukuran_1'] = $pengukuran_1;
                $results['pengukuran_2'] = $pengukuran_2;
            }

        }else{
            $data_sr = Srisiko::where('company_id', Auth::user()->company_id)->where('status_s_risiko', 1)->get();
            // dd(Auth::user()->company_id);
            // dd($data_sr);
            if(count($data_sr) > 0){
                $sr_exists = true;
                $pengukuran_1 = [];
                $pengukuran_2 = [];

                foreach($data_pengukur as $dp) {
                    // get all id_s_risiko yang sudah dinilai
                    $s_risk_dinilai = Srisiko::join('pengukuran as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
                        ->where('p.id_pengukur', '=', $dp->id_pengukur)
                        ->where('status_s_risiko', 1)
                        ->selectRaw('s_risiko.*, p.*')
                        ->pluck('id_s_risiko');
                    // count id_s_risiko yang sudah dinilai group by tahun
                    $s_risk_dinilai_yearly = Srisiko::join('pengukuran as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
                        ->where('p.id_pengukur', '=', $dp->id_pengukur)
                        ->where('status_s_risiko', 1)
                        ->groupBy('s_risiko.tahun')
                        ->selectRaw('s_risiko.*, COUNT(s_risiko.id_s_risiko) as jml_risk, p.*')
                        ->get();
                    foreach($s_risk_dinilai_yearly as $s) {
                        $pengukuran_1[] = $s;
                    }
                    $s_risk = Srisiko::where('status_s_risiko', 1)
                        ->where('s_risiko.company_id', $dp->company_id)
                        ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
                        ->groupBy('s_risiko.tahun')
                        ->selectRaw('s_risiko.*, COUNT(s_risiko.id_s_risiko) as jml_risk')
                        ->get();
                    foreach($s_risk as $s) {
                        $s->nama_responden = $dp->nama;
                        $s->jabatan = $dp->jabatan;
                        $s->id_pengukur = $dp->id_pengukur;
                        $pengukuran_2[] = $s;
                    }
                }

                $sumber_risiko = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                                ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
                                ->whereRaw($wr_sr)
                                ->get();

                // dd($sumber_risiko);
                $results['data_sr'] = $data_sr;
                $results['pengukuran_1'] = $pengukuran_1;
                $results['pengukuran_2'] = $pengukuran_2;
                // dd($results['pengukuran_2']);
                $results['sumber_risiko'] = $sumber_risiko;
            }
            else{
                $sr_exists = false;
            }

            $results['sr_exists'] = $sr_exists;

        }

        // dd($results);
        return $results;
    }
}

?>

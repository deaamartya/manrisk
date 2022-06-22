<?php

namespace App\Abstracts;

use App\Abstracts\AbsPengukuran;
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
        if($filter != 'risk_officer'){
            if($filter != 'penilai_indhan'){
                $wr .= " AND defendid_pengukur.id_user = ".Auth::user()->id_user;
            }
            else{

            }
        }
        else{
            $wr .= " AND defendid_pengukur.company_id = ".Auth::user()->company_id;
        }
        // $total_jml_risk = Srisiko::where('company_id', Auth::user()->company_id)->where('status_s_risiko', 1)->count();
        $data_sr = Srisiko::where('company_id', Auth::user()->company_id)->where('status_s_risiko', 1)->get();
        $data_pengukur = DefendidPengukur::whereRaw($wr)->get();

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
                ->join('defendid_user', 'defendid_pengukur.company_id','defendid_user.company_id')
                ->where('defendid_user.id_user', Auth::user()->id_user)
                ->where('s_risiko.status_s_risiko', 1)
                ->get();

            $results['data_sr'] = $data_sr;
            $results['pengukuran_1'] = $pengukuran_1;
            $results['pengukuran_2'] = $pengukuran_2;
            $results['sumber_risiko'] = $sumber_risiko;
        }
        else{
            $sr_exists = false;
        }

        $results['sr_exists'] = $sr_exists;
        $results['sr_exists'] = $sr_exists;

        return $results;
    }
}

?>

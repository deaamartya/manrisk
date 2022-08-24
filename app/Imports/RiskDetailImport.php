<?php

namespace App\Imports;

use App\Models\RiskDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RiskDetailImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RiskDetail([
            'id_s_risiko' => $row['id_s_risiko'],
            'tahun' => $row['tahun'],
            'sasaran_kinerja' => $row['sasaran_kinerja'],
            'ppkh' => $row['ppkh'],
            'indikator' => $row['indikator'],
            'sebab' => $row['sebab'],
            'dampak_kuantitatif' => $row['dampak_kuantitatif'],
            'dampak' => $row['dampak'],
            'uc' => $row['uc'],
            'pengendalian' => $row['pengendalian'],
            'penilaian' => $row['penilaian'],
            'peluang' => $row['peluang'],
            'tindak_lanjut' => $row['tindak_lanjut'],
            'jadwal' => $row['jadwal'],
            'dampak_kuantitatif_residu' => $row['dampak_kuantitatif_residu'],
            'dampak_residu' => $row['dampak_residu'],
            'pic' => $row['pic'],
            'dokumen' => $row['dokumen'],
        ]);
    }
}

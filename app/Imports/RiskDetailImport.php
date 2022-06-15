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
            'ppkh' => $row['ppkh'],
            'indikator' => $row['indikator'],
            'sebab' => $row['sebab'],
            'dampak' => $row['dampak'],
            'uc' => $row['uc'],
            'pengendalian' => $row['pengendalian'],
            'l_awal' => $row['l_awal'],
            'c_awal' => $row['c_awal'],
            'r_awal' => $row['r_awal'],
            'peluang' => $row['peluang'],
            'tindak_lanjut' => $row['tindak_lanjut'],
            'jadwal' => $row['jadwal'],
            'pic' => $row['pic'],
            'mitigasi' => $row['mitigasi'],
            'jadwal_mitigasi' => $row['jadwal_mitigasi'],
            'realisasi' => $row['realisasi'],
            'keterangan' => $row['keterangan'],
            'l_akhir' => $row['l_akhir'],
            'c_akhir' => $row['c_akhir'],
            'r_akhir' => $row['r_akhir'],
        ]);
    }
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskDetail
 * 
 * @property int $id_riskd
 * @property int $id_riskh
 * @property int $id_s_risiko
 * @property string|null $ppkh
 * @property string|null $indikator
 * @property string|null $sebab
 * @property string|null $dampak
 * @property string|null $uc
 * @property string|null $pengendalian
 * @property float|null $l_awal
 * @property float|null $c_awal
 * @property float|null $r_awal
 * @property string|null $peluang
 * @property string|null $tindak_lanjut
 * @property string|null $jadwal
 * @property string|null $pic
 * @property string|null $dokumen
 * @property string|null $mitigasi
 * @property Carbon|null $jadwal_mitigasi
 * @property int|null $realisasi
 * @property string|null $keterangan
 * @property float|null $l_akhir
 * @property float|null $c_akhir
 * @property float|null $r_akhir
 * @property int|null $status
 * @property string|null $u_file
 * @property int|null $status_mitigasi
 * @property int|null $status_korporasi
 *
 * @package App\Models
 */
class RiskDetail extends Model
{
	use SoftDeletes;

	protected $table = 'risk_detail';
	protected $primaryKey = 'id_riskd';

	protected $casts = [
		'id_riskh' => 'int',
		'id_s_risiko' => 'int',
		'l_awal' => 'float',
		'c_awal' => 'float',
		'r_awal' => 'float',
		'realisasi' => 'int',
		'l_akhir' => 'float',
		'c_akhir' => 'float',
		'r_akhir' => 'float',
		'status' => 'int',
		'status_mitigasi' => 'int',
		'status_korporasi' => 'int'
	];

	protected $dates = [
		'jadwal_mitigasi',
		'deleted_at'
	];

	protected $fillable = [
		'id_riskh',
		'id_s_risiko',
		'ppkh',
		'indikator',
		'sebab',
		'dampak',
		'uc',
		'pengendalian',
		'l_awal',
		'c_awal',
		'r_awal',
		'peluang',
		'tindak_lanjut',
		'jadwal',
		'pic',
		'dokumen',
		'mitigasi',
		'jadwal_mitigasi',
		'realisasi',
		'keterangan',
		'l_akhir',
		'c_akhir',
		'r_akhir',
		'status',
		'u_file',
		'status_mitigasi',
		'status_korporasi'
	];

	public function risk_header()
	{
		return $this->belongsTo(RiskHeader::class, 'id_riskh');
	}

	public function sumber_risiko()
	{
		return $this->belongsTo(SRisiko::class, 'id_s_risiko');
	}
}

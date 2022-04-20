<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PengukuranKorporasi
 * 
 * @property int $id_p
 * @property int $id_riskh
 * @property int $id_s_risiko
 * @property string $nama_responden
 * @property Carbon $tgl_penilaian
 * @property int $nilai_L
 * @property int $nilai_C
 *
 * @package App\Models
 */
class PengukuranKorporasi extends Model
{
	use SoftDeletes;

	protected $table = 'pengukuran_korporasi';
	protected $primaryKey = 'id_p';

	protected $casts = [
		'id_riskh' => 'int',
		'id_s_risiko' => 'int',
		'nilai_L' => 'int',
		'nilai_C' => 'int'
	];

	protected $dates = [
		'tgl_penilaian',
		'deleted_at'
	];

	protected $fillable = [
		'id_riskh',
		'id_s_risiko',
		'nama_responden',
		'tgl_penilaian',
		'nilai_L',
		'nilai_C'
	];
}

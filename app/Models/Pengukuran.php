<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pengukuran
 * 
 * @property int $id_p
 * @property string $tahun_p
 * @property int $id_s_risiko
 * @property int $id_pengukur
 * @property string $nama_responden
 * @property Carbon $tgl_penilaian
 * @property int $nilai_L
 * @property int $nilai_C
 *
 * @package App\Models
 */
class Pengukuran extends Model
{
	protected $table = 'pengukuran';
	protected $primaryKey = 'id_p';
	public $timestamps = false;

	protected $casts = [
		'id_s_risiko' => 'int',
		'id_pengukur' => 'int',
		'nilai_L' => 'int',
		'nilai_C' => 'int'
	];

	protected $dates = [
		'tgl_penilaian'
	];

	protected $fillable = [
		'tahun_p',
		'id_s_risiko',
		'id_pengukur',
		'nama_responden',
		'tgl_penilaian',
		'nilai_L',
		'nilai_C'
	];
}

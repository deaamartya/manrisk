<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RiskHeaderKorporasi
 * 
 * @property int $id_riskh
 * @property int $id_divisi
 * @property string $tahun
 * @property Carbon $tanggal
 * @property string|null $target
 * @property string|null $penyusun
 * @property string|null $pemeriksa
 * @property string|null $lampiran
 * @property int|null $status_h
 * @property int|null $deleted
 *
 * @package App\Models
 */
class RiskHeaderKorporasi extends Model
{
	protected $table = 'risk_header_korporasi';
	protected $primaryKey = 'id_riskh';
	public $timestamps = false;

	protected $casts = [
		'id_divisi' => 'int',
		'status_h' => 'int',
		'deleted' => 'int'
	];

	protected $dates = [
		'tanggal'
	];

	protected $fillable = [
		'id_divisi',
		'tahun',
		'tanggal',
		'target',
		'penyusun',
		'pemeriksa',
		'lampiran',
		'status_h',
		'deleted'
	];
}

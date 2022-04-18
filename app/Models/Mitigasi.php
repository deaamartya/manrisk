<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mitigasi
 * 
 * @property int $id_mitigasi
 * @property string $id_riskd
 * @property string|null $kat
 * @property string|null $risiko
 * @property string|null $mitigasi
 * @property string|null $jadwal_pelaksanaan
 * @property string|null $relisasi
 * @property int|null $progress
 * @property string|null $keterangan
 * @property string|null $ref
 *
 * @package App\Models
 */
class Mitigasi extends Model
{
	protected $table = 'mitigasi';
	protected $primaryKey = 'id_mitigasi';
	public $timestamps = false;

	protected $casts = [
		'progress' => 'int'
	];

	protected $fillable = [
		'id_riskd',
		'kat',
		'risiko',
		'mitigasi',
		'jadwal_pelaksanaan',
		'relisasi',
		'progress',
		'keterangan',
		'ref'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
class MitigasiLogs extends Model
{
	use SoftDeletes;

	protected $table = 'mitigasi_logs';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at'];

	protected $fillable = [
		'id_riskd',
		'id_user',
		'realisasi',
		'dokumen',
		'description',
		'created_at',
		'updated_at',
	];

    public function risk_detail() {
        return $this->belongsTo(RiskDetail::class, 'id_riskd');
    }
}

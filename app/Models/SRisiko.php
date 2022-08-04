<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SRisiko
 * 
 * @property int $id_s_risiko
 * @property string $s_risiko
 * @property string|null $id_konteks
 * @property int|null $id_user
 * @property string|null $tahun
 * @property string|null $catatan
 * @property int|null $status_s_risiko
 *
 * @package App\Models
 */
class SRisiko extends Model
{
	use SoftDeletes;

	protected $table = 's_risiko';
	protected $primaryKey = 'id_s_risiko';
	protected $dates = ['deleted_at'];

	protected $casts = [
		'id_user' => 'int',
		'status_s_risiko' => 'int',
		'company_id' => 'int',
	];

	protected $fillable = [
		's_risiko',
		'id_konteks',
		'id_user',
		'tahun',
		'catatan',
		'status_s_risiko',
		'company_id',
	];

	public function konteks()
	{
		return $this->belongsTo(Kontek::class, 'id_konteks');
	}

	public function perusahaan()
	{
		return $this->belongsTo(Perusahaan::class, 'company_id');
	}
}

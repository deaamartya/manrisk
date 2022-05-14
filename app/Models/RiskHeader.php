<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskHeader
 * 
 * @property int $id_riskh
 * @property int $id_user
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
class RiskHeader extends Model
{
	use SoftDeletes;

	protected $table = 'risk_header';
	protected $primaryKey = 'id_riskh';

	protected $casts = [
		'id_user' => 'int',
		'status_h' => 'int',
	];

	protected $dates = [
		'tanggal',
		'deleted_at'
	];

	protected $fillable = [
		'id_user',
		'tahun',
		'tanggal',
		'target',
		'penyusun',
		'pemeriksa',
		'lampiran',
		'status_h'
	];

	public function risk_detail()
	{
		return $this->hasMany(RiskDetail::class, 'id_riskh');
	}

	public function defendid_user()
	{
		return $this->hasMany(DefendidUser::class, 'id_user');
	}
}

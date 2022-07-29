<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Risk
 * 
 * @property string $id_risk
 * @property string $risk
 *
 * @package App\Models
 */
class Risk extends Model
{
	use SoftDeletes;

	protected $table = 'risk';
	protected $primaryKey = 'id_risk';
	public $incrementing = false;
	protected $dates = ['deleted_at'];

	protected $fillable = [
		'risk'
	];

	public function konteks()
	{
		return $this->hasMany(Kontek::class, 'id_konteks');
	}
}

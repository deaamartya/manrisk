<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
	protected $table = 'risk';
	protected $primaryKey = 'id_risk';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'risk'
	];
}

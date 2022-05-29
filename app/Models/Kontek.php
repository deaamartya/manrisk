<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Kontek
 * 
 * @property int $id_konteks
 * @property string|null $id_risk
 * @property int|null $no_k
 * @property string|null $konteks
 * @property string|null $tahun_konteks
 *
 * @package App\Models
 */
class Kontek extends Model
{
	use SoftDeletes;
	
	protected $table = 'konteks';
	protected $primaryKey = 'id_konteks';
	protected $dates = ['deleted_at'];

	protected $casts = [
		'no_k' => 'int'
	];

	protected $fillable = [
		'id_risk',
		'no_k',
		'konteks',
		'tahun_konteks'
	];
}

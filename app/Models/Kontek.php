<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
	protected $table = 'konteks';
	protected $primaryKey = 'id_konteks';
	public $timestamps = false;

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

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Responden
 * 
 * @property int $id_responden
 * @property int $id_divisi
 * @property string|null $nama_responden
 * @property Carbon|null $tanggal
 *
 * @package App\Models
 */
class Responden extends Model
{
	use SoftDeletes;

	protected $table = 'responden';
	protected $primaryKey = 'id_responden';

	protected $casts = [
		'id_divisi' => 'int'
	];

	protected $dates = [
		'tanggal',
		'deleted_at'
	];

	protected $fillable = [
		'id_divisi',
		'nama_responden',
		'tanggal'
	];
}

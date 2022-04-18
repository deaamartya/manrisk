<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
	protected $table = 'responden';
	protected $primaryKey = 'id_responden';
	public $timestamps = false;

	protected $casts = [
		'id_divisi' => 'int'
	];

	protected $dates = [
		'tanggal'
	];

	protected $fillable = [
		'id_divisi',
		'nama_responden',
		'tanggal'
	];
}

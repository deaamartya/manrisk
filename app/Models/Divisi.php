<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Divisi
 * 
 * @property int $id_divisi
 * @property string $divisi
 * @property string $username
 * @property string $password
 * @property string $kode_divisi
 *
 * @package App\Models
 */
class Divisi extends Model
{
	use SoftDeletes;

	protected $table = 'divisi';
	protected $primaryKey = 'id_divisi';
	protected $dates = ['deleted_at'];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'divisi',
		'username',
		'password',
		'kode_divisi'
	];
}

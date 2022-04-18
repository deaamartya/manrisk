<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
	protected $table = 'divisi';
	protected $primaryKey = 'id_divisi';
	public $timestamps = false;

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

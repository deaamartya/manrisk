<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Officer
 * 
 * @property int $id_officer
 * @property string $nip
 * @property string $nama
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $officer_status
 *
 * @package App\Models
 */
class Officer extends Model
{
	protected $table = 'officer';
	protected $primaryKey = 'id_officer';
	public $timestamps = false;

	protected $casts = [
		'officer_status' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nip',
		'nama',
		'username',
		'password',
		'email',
		'officer_status'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DefendidUser
 * 
 * @property int $id_user
 * @property string $company_id
 * @property string $instansi
 * @property int $kat_user
 * @property string $username
 * @property string $password
 * @property int|null $status_user
 *
 * @package App\Models
 */
class DefendidUser extends Authenticatable
{
	use HasFactory, Notifiable;
	
	protected $table = 'defendid_user';
	protected $primaryKey = 'id_user';
	public $timestamps = false;

	protected $casts = [
		'kat_user' => 'int',
		'status_user' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'company_id',
		'instansi',
		'kat_user',
		'username',
		'password',
		'status_user'
	];
}

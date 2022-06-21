<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DefendidUser
 * 
 * @property int $id_user
 * @property int $company_id
 * @property string $username
 * @property string $password
 * @property int|null $status_user
 * @property bool $is_risk_officer
 * @property bool $is_penilai
 * @property bool $is_penilai_indhan
 * @property bool $is_risk_owner
 * @property bool $is_admin
 * 
 * @property Perusahaan $perusahaan
 *
 * @package App\Models
 */
class DefendidUser extends Authenticatable
{
	use SoftDeletes;

	use HasFactory, Notifiable;
	protected $table = 'defendid_user';
	protected $primaryKey = 'id_user';
	protected $dates = ['deleted_at'];

	protected $casts = [
		'company_id' => 'int',
		'status_user' => 'int',
		'is_risk_officer' => 'bool',
		'is_penilai' => 'bool',
		'is_penilai_indhan' => 'bool',
		'is_risk_owner' => 'bool',
		'is_admin' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'company_id',
		'username',
		'password',
		'status_user',
		'is_risk_officer',
		'is_penilai',
		'is_penilai_indhan',
		'is_risk_owner',
		'is_admin'
	];
	
	public function perusahaan()
	{
		return $this->belongsTo(Perusahaan::class, 'company_id');
	}
	
	public function defendid_pengukur(){
		return $this->hasOne(DefendidPengukur::class, 'id_user');
	}
}
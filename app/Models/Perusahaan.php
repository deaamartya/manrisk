<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Perusahaan
 * 
 * @property int $company_id
 * @property string $company_code
 * @property string $instansi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|DefendidUser[] $defendid_users
 *
 * @package App\Models
 */
class Perusahaan extends Model
{
	protected $table = 'perusahaan';
	protected $primaryKey = 'company_id';

	protected $fillable = [
		'company_code',
		'instansi'
	];

}

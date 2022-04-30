<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DefendidPengukur
 * 
 * @property int $id_pengukur
 * @property string|null $company_id
 * @property int|null $jenis
 * @property string|null $jabatan
 * @property string|null $nip
 * @property string|null $nama
 * @property int $status_pengukur
 *
 * @package App\Models
 */
class DefendidPengukur extends Model
{
	use SoftDeletes;

	protected $table = 'defendid_pengukur';
	protected $primaryKey = 'id_pengukur';
	protected $dates = ['deleted_at'];

	protected $casts = [
		'jenis' => 'int',
		'status_pengukur' => 'int'
	];

	protected $fillable = [
		'company_id',
		'jenis',
		'jabatan',
		'nip',
		'nama',
		'status_pengukur'
	];
}

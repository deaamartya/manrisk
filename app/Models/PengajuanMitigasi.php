<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanMitigasi extends Model
{
	protected $table = 'pengajuan_mitigasi';
	protected $primaryKey = 'id';

	protected $casts = [
		'id_riskd' => 'int',
	];

	protected $dates = [
		'jadwal_mitigasi',
		'deleted_at'
	];

	protected $fillable = [
		'id_riskd',
		'id_user',
		'company_id',
		'alasan',
		'status',
		'is_approved',
		'alasan_admin',
		'tipe_pengajuan',
	];

	public function risk_detail()
	{
		return $this->belongsTo(RiskDetail::class, 'id_riskd');
	}

	public function pemohon()
	{
		return $this->belongsTo(DefendidUser::class, 'id_user');
	}
}

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
		'alasan',
		'is_approved',
		'tipe_pengajuan',
	];

	public function risk_detail()
	{
		return $this->belongsTo(RiskDetail::class, 'id_riskd');
	}
}

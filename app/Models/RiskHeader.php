<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class RiskHeader
 *
 * @property int $id_riskh
 * @property int $id_user
 * @property string $tahun
 * @property Carbon $tanggal
 * @property string|null $target
 * @property string|null $penyusun
 * @property string|null $pemeriksa
 * @property string|null $lampiran
 * @property int|null $status_h
 * @property int|null $deleted
 *
 * @package App\Models
 */
class RiskHeader extends Model
{
	use SoftDeletes;

	protected $table = 'risk_header';
	protected $primaryKey = 'id_riskh';

	protected $casts = [
		'id_user' => 'int',
		'status_h' => 'int',
		'status_h_indhan' => 'int'
	];

	protected $dates = [
		'tanggal',
		'deleted_at'
	];

	protected $fillable = [
		'id_user',
		'tahun',
		'tanggal',
		'target',
		'id_penyusun',
		'id_pemeriksa',
		'lampiran',
		'company_id',
		'status_h',
		'status_h_indhan'
	];

	public function risk_detail()
	{
		return $this->hasMany(RiskDetail::class, 'id_riskh');
	}

	public function perusahaan()
	{
		return $this->belongsTo(Perusahaan::class, 'company_id');
	}

	public function penyusun()
	{
		return $this->belongsTo(DefendidUser::class, 'id_penyusun');
	}

	public function pemeriksa()
	{
		return $this->belongsTo(DefendidUser::class, 'id_pemeriksa');
	}

	public function getMitigasiDetail() {
		$pengajuan = PengajuanMitigasi::where('is_approved', '=', 1)->pluck('id_riskd');
        $mitigasi_logs = DB::raw("(
            SELECT MAX(realisasi) as final_realisasi, id_riskd FROM mitigasi_logs WHERE is_approved = 1 ORDER BY updated_at DESC
        ) as mitigasi_logs");
		$details = self::select('d.*', 'sr.*', 'k.*', 'mitigasi_logs.final_realisasi')
			->join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->join('s_risiko as sr', 'sr.id_s_risiko', '=', 'd.id_s_risiko')
			->join('konteks as k', 'k.id_konteks', '=', 'sr.id_konteks')
			->leftJoin($mitigasi_logs, 'mitigasi_logs.id_riskd', 'd.id_riskd')
			->where('d.id_riskh','=', $this->id_riskh)
			->whereNull('d.deleted_at')
			->whereNull('risk_header.deleted_at')
			->where('d.status_mitigasi','=', 1)
			->get();
		return $details;
	}

	public function migrateCount($id)
	{
		$jml = self::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.id_riskh', '=', $id)
			->where('status_mitigasi', '=', 1)
			->whereNull('d.deleted_at')
			->whereNull('risk_header.deleted_at')
			->count('d.id_riskd');
		return $jml;
	}

	public function doneMigrateCount($id)
	{
		$jml = self::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->join('mitigasi_logs as l', 'l.id_riskd', '=', 'd.id_riskd')
			->where('d.id_riskh', '=', $id)
			->where('status_mitigasi', '=', 1)
			->where('l.realisasi', '=', 100)
			->where('l.is_approved', '=', 1)
			->whereNull('d.deleted_at')
			->whereNull('risk_header.deleted_at')
			->count('d.id_riskd');
		return $jml;
	}

}

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
 * Class RiskHeaderIndhan
 * 
 * @property int $id_riskh
 * @property int $company_id
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
class RiskHeaderIndhan extends Model
{
	use SoftDeletes;

	protected $table = 'risk_header_indhan';
	protected $primaryKey = 'id_riskh';

	protected $casts = [
		'company_id' => 'int',
		'status_h' => 'int',
	];

	protected $dates = [
		'tanggal',
		'deleted_at'
	];

	protected $fillable = [
		'company_id',
		'tahun',
		'tanggal',
		'target',
		'penyusun',
		'pemeriksa',
		'lampiran',
		'status_h'
	];

	public function perusahaan()
	{
		return $this->belongsTo(Perusahaan::class, 'company_id');
	}

	public function risk_detail()
	{
		$details = RiskDetail::where('status_mitigasi', '=', 1)
			->where('tahun', '=', $this->tahun)
			->where('status_indhan', '=', 1)
			->whereNull('deleted_at')
			->get();
		return $details;
	}

	public function getMitigasiDetail() {
		// $mitigasi_logs = DB::raw("(
		// 		SELECT MAX(realisasi) as final_realisasi, id_riskd FROM mitigasi_logs WHERE is_approved = 1 ORDER BY updated_at DESC
		// ) as mitigasi_logs");
		$details = RiskDetail::join('s_risiko as sr', 'sr.id_s_risiko', '=', 'risk_detail.id_s_risiko')
			->join('konteks as k', 'k.id_konteks', '=', 'sr.id_konteks')
			// ->leftJoin($mitigasi_logs, 'mitigasi_logs.id_riskd', 'risk_detail.id_riskd')
			->where('status_mitigasi', '=', 1)
			->where('risk_detail.tahun', '=', $this->tahun)
			->where('status_indhan', '=', 1)
			->whereNull('risk_detail.deleted_at')
			->get();
		// dd($details);
		return $details;
	}

	public function getRealisasi($id) {
		$mitigasi_logs = MitigasiLogs::where('is_approved', 1)->where('id_riskd', $id)->orderBy('updated_at', 'DESC')->max('realisasi');
		// dd($mitigasi_logs);
		return $mitigasi_logs;

	}

	public function migrateCount($id)
	{
		$jml = RiskDetail::where('status_mitigasi', '=', 1)
			->where('risk_detail.tahun', '=', $this->tahun)
			->where('status_indhan', '=', 1)
			->whereNull('deleted_at')
			->count('id_riskd');
		return $jml;
	}

	public function doneMigrateCount($id)
	{
		$jml = RiskDetail::join('mitigasi_logs as l', 'l.id_riskd', '=', 'risk_detail.id_riskd')
			->where('status_mitigasi', '=', 1)
			->where('tahun', '=', $this->tahun)
			->where('status_indhan', '=', 1)
			->where('l.realisasi', '=', 100)
			->where('l.is_approved', '=', 1)
			->whereNull('risk_detail.deleted_at')
			->count('risk_detail.id_riskd');
		return $jml;
	}
}

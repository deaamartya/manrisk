<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
		'penyusun',
		'pemeriksa',
		'lampiran',
		'company_id',
		'status_h',
		'status_h_indhan'
	];

	public function risk_detail()
	{
		return $this->hasMany(RiskDetail::class, 'id_riskh');
	}

	public function getMitigasiDetail() {
		$pengajuan = PengajuanMitigasi::where('is_approved', '=', 1)->pluck('id_riskd');
		$details = self::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->join('s_risiko as sr', 'sr.id_s_risiko', '=', 'd.id_s_risiko')
			->join('konteks as k', 'k.id_konteks', '=', 'sr.id_konteks')
			->where('d.id_riskh','=', $this->id_riskh)
			->where(function($q) use ($pengajuan) {
				$q->where('d.r_awal','>=', 12)
					->whereNotIn('d.id_riskd', $pengajuan);
				$q->orWhere(function($q) use ($pengajuan) {
					$q->whereIn('d.id_riskd', $pengajuan);
				});
			})
			->get();
		return $details;
	}

	public function migrateCount()
	{
		$jml = self::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.r_awal','>=', 12)
			->whereOr('status_mitigasi', '=', 1)
			->count('d.id_riskd');
		return $jml;
	}

	public function doneMigrateCount()
	{
		$jml = self::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('status_mitigasi', '=', 1)
			->count('d.id_riskd');
		return $jml;
    }
    
	public function defendid_user()
	{
		return $this->hasMany(DefendidUser::class, 'id_user');
	}

	public function perusahaan()
	{
		return $this->belongsTo(Perusahaan::class, 'company_id');
	}

	// public function getMitigasiDetail() {
	// 	$pengajuan = PengajuanMitigasi::where('is_approved', '=', 1)->pluck('id_riskd');
	// 	$details = self::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
	// 		->join('s_risiko as sr', 'sr.id_s_risiko', '=', 'd.id_s_risiko')
	// 		->join('konteks as k', 'k.id_konteks', '=', 'sr.id_konteks')
	// 		->where('d.id_riskh','=', $this->id_riskh)
	// 		->where(function($q) use ($pengajuan) {
	// 			$q->where('d.r_awal','>=', 12)
	// 				->whereNotIn('d.id_riskd', $pengajuan);
	// 			$q->orWhere(function($q) use ($pengajuan) {
	// 				$q->whereIn('d.id_riskd', $pengajuan);
	// 			});
	// 		})
	// 		->get();
	// 	return $details;
	// }

	// public function migrateCount()
	// {
	// 	$jml = self::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
	// 		->where('d.r_awal','>=', 12)
	// 		->whereOr('status_mitigasi', '=', 1)
	// 		->count('d.id_riskd');
	// 	return $jml;
	// }

	// public function doneMigrateCount()
	// {
	// 	$jml = self::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
	// 		->where('status_mitigasi', '=', 1)
	// 		->count('d.id_riskd');
	// 	return $jml;
	// }

	
}

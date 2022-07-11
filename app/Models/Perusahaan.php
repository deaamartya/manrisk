<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

	public function getCountMitigasi() {
		return RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.company_id', $this->company_id)
			->where('status_mitigasi', '=', 1)
			->whereNull('d.deleted_at')
			->count('d.id_riskd');
	}

	public function getCountMitigasiDone() {
		return RiskHeader::join('risk_detail as rd', 'rd.id_riskh', 'risk_header.id_riskh')
			->join('mitigasi_logs as m', 'm.id_riskd', 'rd.id_riskd')
			->where('rd.company_id', $this->company_id)
			->where('m.realisasi', '=', 100)
			->where('m.is_approved', '=', 1)
			->whereNull('rd.deleted_at')
			->count('rd.id_riskd');
	}

	public function countLow() {
		return RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.company_id', $this->company_id)
			->where('r_awal', '>', 1)
			->where('r_awal', '<', 6)
			->whereNull('risk_header.deleted_at')
			->whereNull('d.deleted_at')
			->count('d.id_riskd');
	}

	public function countMed() {
		return RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.company_id', $this->company_id)
			->where('r_awal', '>=', 6)
			->where('r_awal', '<', 12)
			->whereNull('risk_header.deleted_at')
			->whereNull('d.deleted_at')
			->count('d.id_riskd');
	}

	public function countHigh() {
		return RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.company_id', $this->company_id)
			->where('r_awal', '>=', 12)
			->where('r_awal', '<', 16)
			->whereNull('risk_header.deleted_at')
			->whereNull('d.deleted_at')
			->count('d.id_riskd');
	}

	public function countExtreme() {
		return RiskHeader::join('risk_detail as d','d.id_riskh','=','risk_header.id_riskh')
			->where('d.company_id', $this->company_id)
			->where('r_awal', '>=', 16)
			->whereNull('risk_header.deleted_at')
			->whereNull('d.deleted_at')
			->count('d.id_riskd');
	}

	public function mitigasiPercentage() {
		$count_mitigasi = $this->getCountMitigasi();
		$count_done_mitigasi = $this->getCountMitigasiDone();
		if ($count_mitigasi < 1) {
			return 100;
		}
		return intval($count_done_mitigasi / $count_mitigasi * 100);
	}

}

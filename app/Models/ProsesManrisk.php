<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesManrisk extends Model
{
    use HasFactory;
    protected $table = 'proses_manrisks';
	protected $primaryKey = 'id_proses';
	protected $dates = ['created_at', 'updated_at'];

	protected $fillable = [
		'nama_proses',
	];

    public function status_proses()
	{
		return $this->hasMany(StatusProses::class, 'id_status_proses');
	}
}

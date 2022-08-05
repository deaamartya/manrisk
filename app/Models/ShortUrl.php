<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $table = 'short_url';
	protected $primaryKey = 'short_code';
    public $incrementing = false;

    protected $guarded = [];
    protected $fillable = [
        'short_code',
        'jenis_dokumen',
        'id_dokumen',
        'url'
	];
}

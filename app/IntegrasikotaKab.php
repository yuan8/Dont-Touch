<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NomenKlaturKotaKabupaten;
class IntegrasikotaKab extends Model
{
    //

    protected $table='integrasi_kotakab';

     protected $fillable=[
		'id_identifikasi_kebijakan_tahunan',
		'kode_sub_kegiatan',
		'id_user',
		'tahun',
		'id_urusan',
	];

	public function nomenklatur(){
    	return $this->belongsTo(NomenKlaturKotaKabupaten::class,'kode_sub_kegiatan','kode');
    }
}

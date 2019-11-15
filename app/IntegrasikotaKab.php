<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NomenKlaturKotaKabupaten;
use App\IndetifikasiKebijakanTahunan;

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
     public function IndetifikasiKebijakanTahunan(){
    	return $this->belongsTo(IndetifikasiKebijakanTahunan::class,'id_identifikasi_kebijakan_tahunan');
    }
}

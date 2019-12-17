<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NomenKlaturProvinsi;
use App\IndetifikasiKebijakanTahunan;

class IntegrasiProvinsi extends Model
{
    //

    protected $fillable=[
		'id_identifikasi_kebijakan_tahunan_target',
		'kode_sub_kegiatan',
		'id_user',
		'tahun',
		'id_urusan',
	];

	
    protected $table='integrasi_provinsi';



    public function nomenklatur(){
    	return $this->belongsTo(NomenKlaturProvinsi::class,'kode_sub_kegiatan','kode');
    }

    public function IndetifikasiKebijakanTahunan(){
    	return $this->belongsTo(IndetifikasiKebijakanTahunan::class,'id_identifikasi_kebijakan_tahunan_target');
    }

}

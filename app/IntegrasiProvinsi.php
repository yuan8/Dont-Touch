<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NomenKlaturProvinsi;

class IntegrasiProvinsi extends Model
{
    //

    protected $fillable=[
		'id_identifikasi_kebijakan_tahunan',
		'kode_sub_kegiatan',
		'id_user',
		'tahun',
		'id_urusan',
	];

	
    protected $table='integrasi_provinsi';


    public function nomenklatur(){
    	return $this->belongsTo(NomenKlaturProvinsi::class,'kode_sub_kegiatan','kode');
    }

}

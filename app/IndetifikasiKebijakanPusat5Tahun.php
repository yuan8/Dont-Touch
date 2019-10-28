<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
class IndetifikasiKebijakanPusat5Tahun extends Model
{
    //


    protected $table="indetifikasi_kebijakan_pusat5_tahun";

    protected $fillable=[
    	'id','id_sub_urusan',
        'id_urusan',
        'tahun',
        'isu_strategis',
    	'kondisi_saat_ini',
    	'arah_kebijakan',
    	'sasaran','target',
    	'kewenangan_pusat',
    	'kewenangan_provinsi',
    	'kewenangan_kota_kabupaten',
    	'keterangan',
    	'id_user'
	];

     public function LinkSubUrusan(){
        return $this->belongsTo(SubUrusan23::class,'id_sub_urusan');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class NomenKlaturKotaKabupaten extends Model
{
    //
     protected $table='master_nomenklatur_kabkota';


    public function programUp(){

    	return DB::table('master_nomenklatur_kabkota')->where('urusan',$this->urusan)->where('bidang_urusan',$this->bidang_urusan)->where('program',$this->program)->where('jenis','program')->first();
    }


    public function kegiatanUp(){

    	return DB::table('master_nomenklatur_kabkota')->where('urusan',$this->urusan)->where('bidang_urusan',$this->bidang_urusan)->where('program',$this->program)->where('kegiatan',$this->kegiatan)->where('jenis','kegiatan')->first();
    }
}

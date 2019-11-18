<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class NomenKlaturProvinsi extends Model
{
    //


    protected $table='master_nomenklatur_provinsi';
    protected $appends = array('kegiatan_detail','program_detail');




    public function programUp(){

    	return (array) DB::table('master_nomenklatur_provinsi')->where('urusan',$this->urusan)->where('bidang_urusan',$this->bidang_urusan)->where('program',$this->program)->where('jenis','program')->first();
    }


    public function kegiatanUp(){

    	return (array) DB::table('master_nomenklatur_provinsi')->where('urusan',$this->urusan)->where('bidang_urusan',$this->bidang_urusan)->where('program',$this->program)->where('kegiatan',$this->kegiatan)->where('jenis','kegiatan')->first();
    }


    public function getkegiatanDetailAttribute()
    {
        return $this->kegiatanUp();

    }

  
    public function getProgramDetailAttribute()
    {
        return $this->programUp(); 

    }

   
}

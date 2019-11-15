<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
use App\Mandat;
use App\Kabkota;
use App\Provinsi;

class PerdaPerkada extends Model
{
    //

    protected $table='perda_perkada';
    protected $fillable=['tahun','id_mandat','id_urusan','perda','perkada','id_user','provinsi','kota_kabupaten','telah_dinilai','id_user_penilai','penilaian','keterangan'];

    public function LinkSubUrusan(){
    	return $this->belongsTo(SubUrusan23::class,'id_sub_urusan');
    }

      public function LinkMandat(){
    	return $this->belongsTo(Mandat::class,'id_mandat');
    }

    public function LabelDaerah(){
    	if($this->kota_kabupaten){
    		return $this->belongsTo(Kabkota::class,'kota_kabupaten','id_kota');
    	}else{
    		return $this->belongsTo(Provinsi::class,'provinsi','id_provinsi');

    	}
    }
}

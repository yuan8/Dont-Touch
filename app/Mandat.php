<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
use App\PerdaPerkada;
use App\MandatUU;
use App\MasterUU;

use App\MandatPP;
use App\MasterPP;

use App\MandatPermen;
use App\MasterPermen;

use App\MandatPerpres;
use App\MasterPerpres;
class Mandat extends Model
{
    //

    protected $table='mandat';


    protected $fillable=[
        "id",
        "id_sub_urusan" ,
        "tahun" ,
        "id_urusan" ,
        "uu" ,
        "pp" ,
        "perpres" ,
        "permen" ,
        "mandat" ,
        "id_user",
        'jenis',
        'target',
        'lokus',
        'pelaksana',
        'indikator',
        'target_akumulatif',
        'target_akumulatif_satuan'
	];

    public function subUrusan(){
    	return $this->belongsTo(SubUrusan23::class,'id_urusan');
    }

    public function LinkSubUrusan(){
        return $this->belongsTo(SubUrusan23::class,'id_sub_urusan');
    }

     public function HavePerdaPerkada(){
        return $this->hasMany(PerdaPerkada::class,'id_mandat');
    }

    public function listUu(){
        return $this->belongsToMany(MasterUU::class,MandatUU::class,'id_mandat','id_uu');
    }

    public function listPp(){
        return $this->belongsToMany(MasterPP::class,MandatPP::class,'id_mandat','id_pp');
    }

    public function listPermen(){
        return $this->belongsToMany(MasterPermen::class,MandatPermen::class,'id_mandat','id_permen');
    }

    public function listPerpres(){
        return $this->belongsToMany(MasterPerpres::class,MandatPerpres::class,'id_mandat','id_perpres');
    }

    public function uus(){
        return $this->belongsToMany(MandatUU::class,'id_mandat');
    }

   


}

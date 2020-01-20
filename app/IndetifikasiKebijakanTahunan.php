<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Urusan23;
use App\ProPN;
use App\IntegrasiProvinsi;
use App\IntegrasikotaKab;
use App\MasterProgramPrioritas;
use App\MasterPrioritasNasional;
use App\KebijakanPusatTahunanTarget;
class IndetifikasiKebijakanTahunan extends Model
{
    //

    protected $table="identifikasi_kebijakan_tahunan";

    protected $fillable=[
    	'id',
    	'id_urusan',
    	'tahun',
    	'id_user',
    


    ];

    public function HaveProPn(){
        return $this->hasMany(ProPN::class,'id_identifikasi_kebijakan_tahunan');
    }


    public function HaveSubUrusanProvinsi(){
        return $this->hasMany(IntegrasiProvinsi::class,'id_identifikasi_kebijakan_tahunan_target');
    }

    public function HaveSubUrusanKabKota(){
        return $this->hasMany(IntegrasikotaKab::class,'id_identifikasi_kebijakan_tahunan');
    }


    public function HavePn(){
        return $this->belongsTo(MasterPrioritasNasional::class,'prioritas_nasional');
    }

    public function HavePp(){
        return $this->belongsTo(MasterProgramPrioritas::class,'program_prioritas');
    }

    public function HaveTarget(){
        return $this->hasMany(KebijakanPusatTahunanTarget::class,'id_kebijikan_pusat_tahunan')->orderBy('id','desc');
    }



}

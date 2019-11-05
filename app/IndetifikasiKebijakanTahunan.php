<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Urusan23;
use App\ProPN;
use App\IntegrasiProvinsi;


class IndetifikasiKebijakanTahunan extends Model
{
    //

    protected $table="identifikasi_kebijakan_tahunan";

    protected $fillable=[
    	'id',
    	'id_urusan',
    	'tahun',
    	'prioritas_nasional',
    	'program_prioritas',
    	'kegiatan_prioritas',
    	'target',
    	'lokus',
    	'pelaksana',
    	'id_user',
        'indikator',
        'target_akumulatif',
        'target_akumulatif_satuan'


    ];

    public function HaveProPN(){
        return $this->hasMany(ProPN::class,'id_identifikasi_kebijakan_tahunan');
    }


    public function HaveSubUrusanProvinsi(){
        return $this->hasMany(IntegrasiProvinsi::class,'id_identifikasi_kebijakan_tahunan');
    }



}

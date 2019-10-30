<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Urusan23;
use App\ProPN;
class IndetifikasiKebijakanTahunan extends Model
{
    //

    protected $table="indetifikasi_kebijakan_tahunan";

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
    	'id_user'
    ];

    public function HaveProPN(){
        return $this->hasMany(ProPN::class,'id_indetifikasi_kebijakan_tahunan');
    }



}

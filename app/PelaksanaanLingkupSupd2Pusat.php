<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
class PelaksanaanLingkupSupd2Pusat extends Model
{
    //
    protected $table='pelaksanaan_lingkup_supd_2_pusat';

    protected $fillable=[
    	'data',
    	'id_sub_urusan',
    	'id_urusan',
    	'tahun',
    	'indikator',
    	'id_user'

    ];

    public function Program(){
        return $this->belongsTo(SubUrusan23::class,'id_sub_urusan');
    }
    
}

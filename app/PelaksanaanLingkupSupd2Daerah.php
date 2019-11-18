<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelaksanaanLingkupSupd2Daerah extends Model
{
    //
    protected $table='pelaksanaan_lingkup_supd_2_daerah';
     protected $fillable=[
    	'data',
    	'id_sub_urusan',
    	'id_urusan',
    	'kode_daerah',
    	'tahun',
    	'indikator',
    	'id_user'
    ];

}

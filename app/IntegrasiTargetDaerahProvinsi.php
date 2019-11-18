<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrasiTargetDaerahProvinsi extends Model
{
    protected $table='integrasi_target_provinsi';


    protected $fillable=[

    	'id',
    	'id_integrasi',
    	'kode_daerah',
    	'target_daerah',
    	'id_urusan',
    	'tahun',
    	'id_user'
    ];
    

}

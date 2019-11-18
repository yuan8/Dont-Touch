<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrasiTargetDaerahKotaKab extends Model
{
    protected $table='integrasi_target_kotakab';
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

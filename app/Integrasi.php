<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrasi extends Model
{
    //

    protected $table='integrasi';

    protected $fillable=[
    	'id',
    	'id_indetifikasi_kebijakan_tahunan',
    	'id_mandat',
    	'id_urusan',
    	'tahun',
    	'kode_sub_kegiatan',
    	'indikator',
    	'target_daerah',
    	'satuan_target_daerah',
    	'target_pusat',
    	'satuan_target_pusat',
    	'kode'
    ];
}

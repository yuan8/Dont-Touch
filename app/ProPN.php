<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProPN extends Model
{
    //
    protected $table="indetifikasi_kebijakan_tahunan_pro_pn";

    protected $fillable=[
    	'id',
    	'id_urusan',
    	'tahun',
    	'id_indetifikasi_kebijakan_tahunan',
    	'pro_pn',
    	'id_user'
    ];
}

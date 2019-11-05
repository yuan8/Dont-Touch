<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProPN extends Model
{
    //
    protected $table="identifikasi_kebijakan_tahunan_pro_pn";

    protected $fillable=[
    	'id',
    	'id_urusan',
    	'tahun',
    	'id_identifikasi_kebijakan_tahunan',
    	'pro_pn',
    	'id_user'
    ];
}

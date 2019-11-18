<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
class Permasalahan extends Model
{
    //


    protected $table='permasalahan';
    protected $fillable=['id','masalah_pokok','masalah','tahun','akar_masalah','data_pendukung','id_urusan','id_user','provinsi','kota_kabupaten'];

    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
class Permasalahan extends Model
{
    //


    protected $table='permasalahan';
    protected $fillable=['id','masalah','tahun','akar_masalah','data_pendukung','id_urusan','id_sub_urusan','id_user'];

    public function LinkSubUrusan(){
    	return $this->belongsTo(SubUrusan23::class,'id_sub_urusan');
    }
}

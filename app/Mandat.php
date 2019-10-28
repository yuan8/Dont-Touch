<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
use App\PerdaPerkada;
class Mandat extends Model
{
    //

    protected $table='mandat';

    protected $fillable=[
     "id_sub_urusan" ,
     "tahun" ,
     "id_urusan" ,
	  "uu" ,
	  "pp" ,
	  "perpres" ,
	  "permen" ,
	  "mandat" ,
	  "id_user",
	];

    public function subUrusan(){
    	return $this->belongsTo(SubUrusan23::class,'id_urusan');
    }

    public function LinkSubUrusan(){
        return $this->belongsTo(SubUrusan23::class,'id_sub_urusan');
    }

     public function HavePerdaPerkada(){
        return $this->hasMany(PerdaPerkada::class,'id_mandat');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
class Mandat extends Model
{
    //

    protected $table='mandat';

    protected $fillable=[
     "id_sub_urusan" ,
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
}

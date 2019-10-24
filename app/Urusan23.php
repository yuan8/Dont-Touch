<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
class Urusan23 extends Model
{
    //
     protected $table='urusan_23';


     public function HaveSub(){
     	
     	return $this->hasMany(SubUrusan23::class,'id_urusan');
     }
}

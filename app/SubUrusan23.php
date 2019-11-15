<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Urusan23;
class SubUrusan23 extends Model
{
    //
     protected $table='master_sub_urusan';


     public function Urusan(){
     	return $this->belongsTo(Urusan23::class,'id_urusan');
     }

 }


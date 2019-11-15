<?php

namespace App\DBS;

use Illuminate\Database\Eloquent\Model;
use App\DBS\FormMainOneUU;
class FormMainOneConnectUU extends Model
{
    //
    protected $connection = 'pgsql2';
    protected $table='form_1_main_to_uu';


    public function listUu(){
      return $this->hasMany(FormMainOneUU::class,'id','id_form_1_uu');
    }
}

<?php

namespace App\DBS;

use Illuminate\Database\Eloquent\Model;
use App\DBS\FormMainOnePP;
class FormMainOneConnectPP extends Model
{
    //
    protected $connection = 'pgsql2';
    protected $table='form_1_main_to_pp';
    
    public function listPp(){
      return $this->hasMany(FormMainOnePP::class,'id','id_form_1_pp');
    }
}

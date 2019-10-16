<?php

namespace App\DBS;

use Illuminate\Database\Eloquent\Model;

class FormMainOnePerkada extends Model
{
    //
    protected $connection = 'pgsql2';
    protected $table='form_1_perkada';
    protected $fillable=['id','id_form_1','nama_perkada'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form1 extends Model
{
    //

    protected $table='form_1_main';
    protected $fillable=['id','id_bidang','uu','pp','perpres','mandat'];
    protected $dateFormat = 'Y-m-d H:i:s.u';
}

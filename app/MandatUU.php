<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MandatUU extends Model
{
    //

    protected $table='mandat_to_uu';

    protected $fillable=[
    	'id',
    	'id_mandat',
    	'id_uu'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MandatPP extends Model
{
    //

    protected $table='mandat_to_pp';

    protected $fillable=[
    	'id',
    	'id_mandat',
    	'id_pp'
    ];
}

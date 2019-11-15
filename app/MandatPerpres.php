<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MandatPerpres extends Model
{
    //
    protected $table='mandat_to_perpres';

    protected $fillable=[
    	'id',
    	'id_mandat',
    	'id_perpres'
    ];
}

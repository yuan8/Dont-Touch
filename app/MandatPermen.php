<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MandatPermen extends Model
{
    //

    protected $table='mandat_to_permen';

    protected $fillable=[
    	'id',
    	'id_mandat',
    	'id_permen'
    ];
}

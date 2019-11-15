<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterPerpres extends Model
{
    //

    protected $table='master_perpres';

    protected $fillable=[
    	'id',
    	'nama_perpres',
    ];
}

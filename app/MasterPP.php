<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterPP extends Model
{
    //

     protected $table='master_pp';

    protected $fillable=[
    	'id',
    	'nama_pp',
    ];
}

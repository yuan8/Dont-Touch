<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterPermen extends Model
{
    //

    protected $table='master_permen';

    protected $fillable=[
    	'id',
    	'nama_permen',
    ];
}

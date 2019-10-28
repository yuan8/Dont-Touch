<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabkota extends Model
{
    //

    protected $table='kabupaten';
    protected $fillable=['id_kota','nama'];
}

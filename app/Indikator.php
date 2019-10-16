<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    //
    protected $table='tb_indikator';
    protected $fillable=['id','kode','nama_indikator'];
}

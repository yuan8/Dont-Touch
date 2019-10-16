<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //
    protected $table='tb_kegiatan';
    protected $fillable=['id','kode','nama_kegiatan'];
}

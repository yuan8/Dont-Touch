<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    //
    protected $table='tb_sub_kegiatan';
    protected $fillable=['id','kode','nama_sub_kegiatan'];
}

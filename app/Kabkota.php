<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabkota extends Model
{
    //

    protected $table='tb_indikator';
    protected $fillable=['ID_kota_kab','kode','nama_indikator'];
}

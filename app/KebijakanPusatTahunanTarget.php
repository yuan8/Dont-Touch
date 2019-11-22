<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KebijakanPusatTahunanTarget extends Model
{
    //

    protected $table='kebijakan_pusat_tahunan_target';
    protected $fillable=['target','lokus','pelaksana','id_user','id_kebijikan_pusat_tahunan','tahun','id_urusan'];
}

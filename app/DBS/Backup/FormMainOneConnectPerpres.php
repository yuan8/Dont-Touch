<?php

namespace App\DBS;

use Illuminate\Database\Eloquent\Model;

class FormMainOneConnectPerpres extends Model
{
    //
    protected $connection = 'pgsql2';
    protected $table='form_1_main_to_perpres';
}

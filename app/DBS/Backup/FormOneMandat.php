<?php

namespace App\DBS;

use Illuminate\Database\Eloquent\Model;

class FormOneMandat extends Model
{
    //
    protected $connection = 'pgsql2';
    protected $table='form_1_mandat';
}

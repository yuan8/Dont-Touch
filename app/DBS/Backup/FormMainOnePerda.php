<?php

namespace App\DBS;

use Illuminate\Database\Eloquent\Model;

class FormMainOnePerda extends Model
{
    //
    protected $connection = 'pgsql2';
    protected $table='form_1_perda';

    protected $fillable=['id_form_1','nama_perda'];

}

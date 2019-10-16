<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $table='tb_program';
    protected $fillable=['id','kode','nama_program'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementData extends Model
{
    //
    protected $table='tb_element_data';
    protected $fillable=['id','kode','nama_element'];
}

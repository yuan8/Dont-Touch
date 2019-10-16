<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidangUrusan extends Model
{
    //
    protected $table='tb_bidang_urusan';
    protected $fillable=['id','kode','nama_bidang_urusan'];
    protected $dateFormat = 'Y-m-d H:i:s.u';


}

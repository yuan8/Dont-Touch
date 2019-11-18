<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBidangUrusan extends Model
{
    //

    protected $table='user_bidang_urusan';
    protected $fillable=['id','id_user','id_bidang'];
    protected $dateFormat = 'Y-m-d H:i:s.u';

    
}

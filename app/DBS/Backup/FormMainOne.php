<?php

namespace App\DBS;

use Illuminate\Database\Eloquent\Model;
use App\DBS\FormMainOneConnectUU;
use App\DBS\FormMainOneConnectPP;
use App\DBS\FormMainOneConnectPerpres;
use App\DBS\FormMainOneConnectPermen;


use App\DBS\FormMainOneUU;
use App\DBS\FormMainOnePP;
use App\DBS\FormMainOnePerpres;
use App\DBS\FormMainOnePermen;
use App\DBS\FormMainOnePerkada;
use App\DBS\FormMainOnePerda;




class FormMainOne extends Model
{
    //
    protected $connection = 'pgsql2';
    protected $table='form_1_main';

    protected $fillable=[
      'id','k_mandat','k_sub_urusan','k_perda','k_perkada','k_kesesuaian','k_keterangan'
    ];

    public function listUu(){
      return $this->belongsToMany(FormMainOneUU::class,FormMainOneConnectUU::class,'id_form_1','id_form_1_uu');
    } 
    public function listSubUrusan(){
      return $this->belonsTo(FormMainOneSubUrusan::class,'k_sub_urusan');
    }
    public function listMandat(){
      return $this->hasMany(FormMainOneMandat::class,'id_form_1');
    }


    public function listPp(){
      return $this->belongsToMany(FormMainOnePP::class,FormMainOneConnectPP::class,'id_form_1','id_form_1_pp');
    }

    public function listPerpres(){
      return $this->belongsToMany(FormMainOnePerpres::class,FormMainOneConnectPerpres::class,'id_form_1','id_form_1_perpres');
    }

    public function listPermen(){
      return $this->belongsToMany(FormMainOnePermen::class,FormMainOneConnectPermen::class,'id_form_1','id_form_1_permen');
    }

    public function listPerda(){
      return $this->hasMany(FormMainOnePerda::class,'id_form_1');
    }
    public function listPerkada(){
      return $this->hasMany(FormMainOnePerkada::class,'id_form_1');
    }
}

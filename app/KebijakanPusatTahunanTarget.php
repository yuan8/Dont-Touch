<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\IndetifikasiKebijakanTahunan;
class KebijakanPusatTahunanTarget extends Model
{
    //

    protected $table='kebijakan_pusat_tahunan_target';
    protected $fillable=['target','satuan_target','lokus','pelaksana','id_user','id_kebijikan_pusat_tahunan','tahun','id_urusan'];

    public function KebijakanPusatTahunan(){

    	return $this->belongsTo(IndetifikasiKebijakanTahunan::class,'id_kebijikan_pusat_tahunan');
    	
    }

}

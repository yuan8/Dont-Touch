<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubUrusan23;
class Daerah extends Model
{
    //

    protected $table='view_daerah';
    protected $appends=['sub_urusan'];

    public static $id_urusan=0;
    public static $tahun=0;

    public function getSubUrusanAttribute()
	{
		return SubUrusan23::where('id_urusan',$this->id_urusan)->get();
	}
}

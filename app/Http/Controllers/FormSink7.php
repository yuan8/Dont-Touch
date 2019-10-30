<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Urusan23;
use App\IndetifikasiKebijakanTahunan;
class FormSink7 extends Controller
{
    //

    public function index($urusan){
    	$data_link=Urusan23::find($urusan);
    	$data=IndetifikasiKebijakanTahunan::where('tahun',session('focus_tahun'))
    	->where('id_urusan',$urusan)->paginate(10);



    	return view('form_singkron.form7')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BidangUrusan;
use App\Kewenangan;
class FormSink6 extends Controller
{
    //


    public function index($urusan,Request $request){
    	$data_link=BidangUrusan::find($urusan);
    	$kewenangan=Kewenangan::where('nomer_bidang_urusan',$urusan)->get();
    	return view('form_singkron.form6')->with(['id_link'=>$urusan,'data_link'=>$data_link,'kewenangans'=>$kewenangan]);
    }
}

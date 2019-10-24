<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BidangUrusan;
class FormSink4 extends Controller
{
    //


    public function index($urusan,Request $request){
    		$data_link=BidangUrusan::find($urusan);
    	return view('form_singkron.form4')->with(['id_link'=>$urusan,'data_link'=>$data_link]);
    }
}

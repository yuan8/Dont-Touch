<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Urusan23;
class FormSink7 extends Controller
{
    //

    public function index($urusan){
    	$data_link=Urusan23::find($urusan);
    	return view('form_singkron.form7')->with('id_link',$urusan)->with('data_link',$data_link);
    }
}

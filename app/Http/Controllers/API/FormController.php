<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    //
    public function Trf1(Request $request){

      if($request->key){
        return view('init.them.tr_f1')->with('key',$request->key)->render();
      }else{
        return '';
      }
    }
}

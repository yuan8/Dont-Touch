<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use DB;
class AdminCtrl extends Controller
{
    //

    public function index(){
      $provincies=Provinsi::orderBy('nama','ASC')->get();
      return view('init.data_form')->with('provincies',$provincies);
    }

    public function form(){

      $datas=DB::connection(env('DBC2'))->table('form_1_main')->get();
      return view('init.main_form')->with('datas',$datas);
    }
}

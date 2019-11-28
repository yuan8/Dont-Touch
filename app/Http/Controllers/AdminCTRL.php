<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use DB;
use App\BidangUrusan;
use Auth; 
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

    public function madat(){
      $user=Auth::User();
      if($user->role==1){
        $bidangs=BidangUrusan::all();

      }else{
        $ids=$user->haveUrusan;
        if($ids){
          $ids=$ids->pluck('id_bidang');
        }else{
          $ids=[];
        }
        $bidangs=BidangUrusan::whereIn('id',$ids)->get();

      }
    	return view('admin.form.mandat')->with('bidangs',$bidangs);
    }

    public function rubah_tahun(Request $request){

      if(isset($request->tahun)){
         session(['focus_tahun' => $request->tahun]);
      }

      return back();
    }

    public function ts(){
      return view('test');
    }

}

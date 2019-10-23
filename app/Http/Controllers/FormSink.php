<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Auth;
class FormSink extends Controller
{
    //

    public function Form1Store(Request $request){
	 	
		$data=($request->f);
		$data=json_encode($data,true);
		if($data){
			if(file_exists(storage_path('app/f1_.json'))){
			$koma=file_get_contents(storage_path('app/f1_.json'));
			if($koma!=""){
				$koma=',';
			}else{
				$koma="";
			}
			Storage::append('f1_.json', $koma.$data);	

			}else{
			Storage::append('f1_.json',$data);	
			}
		}
		
		return back();

    }

   public function Form1(Request $request){
		
		$data=file_get_contents(storage_path('app/f1_.json'));
		$data='['.$data.']';
		$data=json_decode($data,true);
		
		return view('form_singkron.form1')->with('datas',$data);

    }

   public  function Form1Update(Request $request){
		
		$data=file_get_contents(storage_path('app/f1_.json'));
		$koma=$data;
		if($koma!=""){
			$koma=',';
		}else{
			$koma="";
		}
		$data='['.$data.']';
		$data=json_decode($data,true);
		$data[$request->key]=json_encode($request->f);
		if($data){
			if(file_exists(storage_path('app/f1_.json'))){
				Storage::append('f1_.json', $koma.$data);	

			}else{
				Storage::append('f1_.json',$data);	
			}
		}
		
		return view('form_singkron.form1')->with('datas',$data);

    }



   public  function Form1Delete(Request $request){


		$data=file_get_contents(storage_path('app/f1_.json'));
		$koma=$data;
		if($koma!=""){
			$koma=',';
		}else{
			$koma="";
		}
		$data='['.$data.']';
		$data=json_decode($data,true);
		if(isset($data[$request->key])){
			unset($data[$request->key]);
		}

		if($data  OR ($data=[])){
			if(file_exists(storage_path('app/f1_.json'))){
				
				Storage::append('f1_.json', $koma.$data);	

			}else{
				Storage::append('f1_.json',$data);	
			}
		}
		
		return back();

    }


    public function index(){
    	$urusan=Auth::User()->haveUrusan;
    	return view('form_singkron.index')->with('urusans',$urusan)->with('title','SUPD2 Data Suport Sistem');
    }

}

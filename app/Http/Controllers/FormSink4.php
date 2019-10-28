<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urusan23;
use App\SubUrusan23;
use Validator;
use App\Permasalahan;
use Auth;
use Alert;
class FormSink4 extends Controller
{
    //


    public function index($urusan,Request $request){
    	$data_link=Urusan23::find($urusan);
        $data=Permasalahan::where('id_urusan',$urusan)->orderBy('id','DESC')->paginate(10);

    	return view('form_singkron.form4')->with('id_link',$urusan)->with('data_link',$data_link)->with('permasalahans',$data);
    }


    public function create($urusan){
    	$data_link=Urusan23::find($urusan);
    	$sub_urusans=SubUrusan23::where('id_urusan',$urusan)->orderBy('nama','ASC')->get();
    	return view('form_singkron.form4_tambah')->with('id_link',$urusan)->with('data_link',$data_link)->with('sub_urusans',$sub_urusans);
    }


    public function store($urusan,Request $request){
        $data_link=Urusan23::find($urusan);
        $validator=Validator::make($request->all(),[
            'masalah.*'=>'required',
            'sub_urusan'=>'required|exists:sub_urusan_23,id',
        ]);

        if($validator->fails()){
        

        }else{
            $masalah=[];
            $akar_masalah=[];
            $data_dukung=[];

            if(isset($request->masalah)){
                $masalah=($request->masalah);
            }
            if(isset($request->akar_masalah)){
                $akar_masalah=($request->akar_masalah);
            }  
            if(isset($request->data_dukung)){
                $data_dukung=($request->data_dukung);
            }

            $masalah=json_encode($masalah);
            $akar_masalah=json_encode($akar_masalah);    
            $data_dukung=json_encode($data_dukung);    


            $permasalahan=Permasalahan::create([
                'id_sub_urusan'=>$request->sub_urusan,
                'id_urusan'=>$urusan,
                'masalah'=>$masalah,
                'akar_masalah'=>$akar_masalah,
                'data_pendukung'=>$data_dukung,
                'id_user'=>Auth::User()->id
            ]);

            if($permasalahan){
                Alert::success('Data Berhasil Ditambahkan','success');
                return back();
            }else{
                return abort('500');
            }



        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urusan23;
use App\SubUrusan23;
use App\IndetifikasiKebijakanPusat5Tahun;
use Auth;
class FormSink2 extends Controller
{
    //


    public function index($urusan){
    	$data_link=Urusan23::find($urusan);
    	$data=IndetifikasiKebijakanPusat5Tahun::where('id_urusan',$urusan)->get();

    	return view('form_singkron.form2')->with('id_link',$urusan)->with('data_link',$data_link)->with('indentifikasis',$data);
    }

    public function show($urusan,$id){
        $data_link=Urusan23::find($urusan);
        $sub_urusans=SubUrusan23::where('id_urusan',$urusan)
        ->get();
        $data=IndetifikasiKebijakanPusat5Tahun::find($id);

        if($data){
             return view('form_singkron.form2_edit')->with('id_link',$urusan)
        ->with('data_link',$data_link)->with('sub_urusans',$sub_urusans)->with('data',$data);
        }else{

        }
       
    }

    public function update($urusan,$id,Request $request){
        $data=IndetifikasiKebijakanPusat5Tahun::find($id);
        if($data){
            $kondisi_saat_ini=[];
            $sasaran=[];
            $arah_kebijakan=[];
            $target=[];
            $isu_strategis=[];


            if(isset($request->kondisi_saat_ini)){
                $kondisi_saat_ini=$request->kondisi_saat_ini;
            }

            if(isset($request->sasaran)){
                $sasaran=$request->sasaran;
            }

            if(isset($request->arah_kebijakan)){
                $arah_kebijakan=$request->arah_kebijakan;
            }

            if(isset($request->target)){
                $target=$request->target;
            }  
            if(isset($request->isu_strategis)){
                $isu_strategis=$request->isu_strategis;
            }   



            $kondisi_saat_ini=json_encode($kondisi_saat_ini);
            $sasaran=json_encode($sasaran);
            $arah_kebijakan=json_encode($arah_kebijakan);
            $target=json_encode($target);
            $isu_strategis=json_encode($isu_strategis); 



            $data=$data->update([
                'id_sub_urusan'=>$request->sub_urusan,
                'kondisi_saat_ini'=>$kondisi_saat_ini,
                'isu_strategis'=>$isu_strategis,
                'arah_kebijakan'=>$arah_kebijakan,
                'sasaran'=>$sasaran,
                'target'=>$target,
                'kewenangan_pusat'=>$request->kewenangan_pusat,
                'kewenangan_provinsi'=>$request->kewenangan_provinsi,
                'kewenangan_kota_kabupaten'=>$request->kewenangan_kota_kabupaten,
                'keterangan'=>$request->keterangan,
            ]);

            return back();

        }
    }


    public function create($urusan){
    	$data_link=Urusan23::find($urusan);
    	$sub_urusans=SubUrusan23::where('id_urusan',$urusan)->get();


    	return view('form_singkron.form2_tambah')->with('id_link',$urusan)->with('data_link',$data_link)->with('sub_urusans',$sub_urusans);
    }


    public function store($urusan,Request $request){
    	$kondisi_saat_ini=[];
    	$sasaran=[];
    	$arah_kebijakan=[];
    	$target=[];
    	$isu_strategis=[];


    	if(isset($request->kondisi_saat_ini)){
    		$kondisi_saat_ini=$request->kondisi_saat_ini;
    	}

    	if(isset($request->sasaran)){
    		$sasaran=$request->sasaran;
    	}

		if(isset($request->arah_kebijakan)){
    		$arah_kebijakan=$request->arah_kebijakan;
    	}

    	if(isset($request->target)){
    		$target=$request->target;
    	}  
    	if(isset($request->isu_strategis)){
    		$isu_strategis=$request->isu_strategis;
    	}   



    	$kondisi_saat_ini=json_encode($kondisi_saat_ini);
    	$sasaran=json_encode($sasaran);
    	$arah_kebijakan=json_encode($arah_kebijakan);
    	$target=json_encode($target);
    	$isu_strategis=json_encode($isu_strategis); 



    	$data=IndetifikasiKebijakanPusat5Tahun::create([
    		'id_sub_urusan'=>$request->sub_urusan,
    		'id_urusan'=>$urusan,
            'tahun'=>session('focus_tahun'),
    		'kondisi_saat_ini'=>$kondisi_saat_ini,
    		'isu_strategis'=>$isu_strategis,
    		'arah_kebijakan'=>$arah_kebijakan,
    		'sasaran'=>$sasaran,
    		'target'=>$target,
    		'kewenangan_pusat'=>$request->kewenangan_pusat,
    		'kewenangan_provinsi'=>$request->kewenangan_provinsi,
    		'kewenangan_kota_kabupaten'=>$request->kewenangan_kota_kabupaten,
    		'keterangan'=>$request->keterangan,
    		'id_user'=>Auth::User()->id,
    	]);



    	if($data){
    		return back();
    	}



    }


    public function delete($urusan,$id){

        $data=IndetifikasiKebijakanPusat5Tahun::find($id);
        if($data){
            $data->delete();
            return back();
        }

    }
}

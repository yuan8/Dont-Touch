<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urusan23;
use App\IndetifikasiKebijakanTahunan;
use Auth;
use App\ProPN;
class FormSink3 extends Controller
{
    //
    public function update_indikator($urusan,$id,Request $request){
        $data=IndetifikasiKebijakanTahunan::find($id);
        if($data){
            $data->indikator=$request->indikator;
            $data->target_akumulatif=$request->target_akumulatif;
            $data->target_akumulatif_satuan=$request->target_akumulatif_satuan;

            $data->save();
            return back();
        }else{
        }
    }


    public function index($urusan){
    	$data_link=Urusan23::find($urusan);
    	$data=IndetifikasiKebijakanTahunan::where('tahun',session('focus_tahun'))
    	->where('id_urusan',$urusan)->paginate(10);


    	return view('form_singkron.form3')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data);
    }


     public function create($urusan){
    	$data_link=Urusan23::find($urusan);
    	return view('form_singkron.form3_tambah')->with('id_link',$urusan)->with('data_link',$data_link);
    }


    public function store($urusan,Request $request){

    	$id=IndetifikasiKebijakanTahunan::create(
    		[
    		'id_urusan'=>$urusan,
	    	'tahun'=>session('focus_tahun'),
	    	'prioritas_nasional'=>$request->prioritas_nasional,
	    	'program_prioritas'=>$request->program_prioritas,
	    	'kegiatan_prioritas'=>$request->kegiatan_prioritas,
	    	'target'=>$request->target,
	    	'lokus'=>$request->lokus,
	    	'pelaksana'=>$request->pelaksana,
	    	'id_user'=>Auth::User()->id
	    	]
    	);

    	if($id){
    		$id=$id->id;
    		if($request->pro_pn){
    			foreach($request->pro_pn as $pro_pn){

	    			if($pro_pn!=""){
	    				ProPN::create([
		    				'id_urusan'=>$urusan,
		    				'id_identifikasi_kebijakan_tahunan'=>$id,
		    				'tahun'=>session('focus_tahun'),
		    				'pro_pn'=> $pro_pn,
		    				'id_user'=>Auth::User()->id
	    				]);
	    			}
    			}

	    	}

	    	return back();
    	}

    }

    public function delete($urusan,$id){
    	$data=IndetifikasiKebijakanTahunan::find($id);
    	if($data){
    		$data->delete();
    		return back();
    	}
    }

    public function show($urusan,$id){
    	$data_link=Urusan23::find($urusan);
    	$data=IndetifikasiKebijakanTahunan::find($id);
    	if($data){
    		return view('form_singkron.form3_edit')->with('id_link',$urusan)
    		->with('data_link',$data_link)->with('data',$data);
    	}
    }

    public function update($urusan,$id,Request $request){
    	$data=IndetifikasiKebijakanTahunan::find($id);
    	if($data){
    		$data->update(
    			[
		    	'prioritas_nasional'=>$request->prioritas_nasional,
		    	'program_prioritas'=>$request->program_prioritas,
		    	'kegiatan_prioritas'=>$request->kegiatan_prioritas,
		    	'target'=>$request->target,
		    	'lokus'=>$request->lokus,
		    	'pelaksana'=>$request->pelaksana,
	    		]
    		);
    		$id=$data->id;
    		$propn=ProPN::where('id_indetifikasi_kebijakan_tahunan',$id)->delete();
    		if($request->pro_pn){
    			foreach($request->pro_pn as $pro_pn){
	    			if($pro_pn!=""){
	    				ProPN::create([
		    				'id_urusan'=>$urusan,
		    				'id_indetifikasi_kebijakan_tahunan'=>$id,
		    				'tahun'=>session('focus_tahun'),
		    				'pro_pn'=> $pro_pn,
		    				'id_user'=>Auth::User()->id
	    				]);
	    			}
    			}

	    	}

	    	return back();

    	}
    }
}

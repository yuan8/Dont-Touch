<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BidangUrusan;
use App\Kewenangan;
use App\Urusan23;
use App\SubUrusan23;
use Validator;
use Alert;
use Auth;
use DB;
use App\PelaksanaanLingkupSupd2Pusat;
class FormSink6 extends Controller
{
    //


    public function index($urusan,Request $request){
    	$data_link=Urusan23::find($urusan);
    	$data=PelaksanaanLingkupSupd2Pusat::where('id_urusan',$urusan)
    	->where('tahun',session('focus_tahun'))->with('Program')->paginate(20);

    	return view('form_singkron.form6')->with(['id_link'=>$urusan,'data_link'=>$data_link,'datas'=>$data]);
    }


    public function pusat_create($urusan){
    	$data_link=Urusan23::find($urusan);
    	$program=SubUrusan23::where('id_urusan',$urusan)->get();
    	return view('form_singkron.form6_pusat_tambah')->with(['program'=>$program,'id_link'=>$urusan,'data_link'=>$data_link]);
    }


    public function pusat_store($urusan,Request $request){
    	$request->request->add(['id_urusan'=>$urusan]);    	
    	$validator= Validator::make($request->all(),[
    		'program'=>'required|numeric|exists:master_sub_urusan,id',
    		'id_urusan'=>'required|numeric|exists:master_urusan,id',
    		'indikator'=>'required|string',
    		'data'=>'nullable|array',
    		'data.*'=>'nullable|string'
    	]);

    	if($validator->fails()){
    		Alert::error('','error');
    		return back();
    	}

    	$data='[]';
    	if(isset($request->data)){
    		$data=json_encode($request->data);
    	}

    	$d=PelaksanaanLingkupSupd2Pusat::create([
    		'data'=>$data,
    		'id_sub_urusan'=>$request->program,
    		'id_urusan'=>$urusan,
    		'tahun'=>session('focus_tahun'),
    		'indikator'=>$request->indikator,
    		'id_user'=>Auth::User()->id
    	]);

    	if($d){
    		Alert::success('Data Berhasil Ditambahkan','success');
    		return back();
    	}


    	
    }


    public function pusat_delete($urusan,$id){
    	$data=PelaksanaanLingkupSupd2Pusat::find($id);

    	if($data){
    		$data->delete();
    	}

    	return back();
    }


    public function pusat_show($urusan,$id){
        $data=PelaksanaanLingkupSupd2Pusat::find($id);
        if($data){
             $data_link=Urusan23::find($urusan);
        $program=SubUrusan23::where('id_urusan',$urusan)->get();
        return view('form_singkron.form6_pusat_edit')->with(['program'=>$program,'id_link'=>$urusan,'data_link'=>$data_link,'data'=>$data]);
        }


       
    }

    public function pusat_update($urusan,$id,Request $request){

       $request->request->add(['id_urusan'=>$urusan]);      
        $validator= Validator::make($request->all(),[
            'program'=>'required|numeric|exists:master_sub_urusan,id',
            'id_urusan'=>'required|numeric|exists:master_urusan,id',
            'indikator'=>'required|string',
            'data'=>'nullable|array',
            'data.*'=>'nullable|string'
        ]);

        if($validator->fails()){
            Alert::error('','error');
            return back();
        }

        $data='[]';
        if(isset($request->data)){
            $data=json_encode($request->data);
        }

        $d=PelaksanaanLingkupSupd2Pusat::find($id);

            if($d){

             $d=$d->update([
                'data'=>$data,
                'id_sub_urusan'=>$request->program,
                'id_urusan'=>$urusan,
                'tahun'=>session('focus_tahun'),
                'indikator'=>$request->indikator,
                'id_user'=>Auth::User()->id
             ]);

            if($d){
                Alert::success('Data Berhasil Ditambahkan','success');
                return back();
            }

        }else{

        }
    }


    public function daerah($urusan,Request $request){
        $data_link=Urusan23::find($urusan);
        
        $model=\App\daerah::$id_urusan=$urusan;

        $data=DB::table("select * from
        (select a.nama as nama_daerah,* from view_daerah as a ,
        (select id as id_sub_urusan,id_urusan,nama from master_sub_urusan where id_urusan=".$urusan.") as b) c 
        left join pelaksanaan_lingkup_supd_2_daerah d on c.id=d.kode_daerah and c.id_sub_urusan=d.id_sub_urusan limit 10");


        dd($data);

        // $data=$model::paginate(10);
        // $data=json_encode($data,true);
        // $data=json_decode($data,true);


        // dd($data);



        // return view('form_singkron.form6_daerah')->with(['program'=>$program,'id_link'=>$urusan,'data_link'=>$data_link]);

    }
}

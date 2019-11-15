<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Urusan23;
use App\IndetifikasiKebijakanTahunan;
use App\NomenKlaturProvinsi;
use App\IntegrasiProvinsi;
use Auth;
use App\Satuan;
use App\IntegrasikotaKab;
use App\Provinsi;
use App\IntegrasiTargetDaerahProvinsi;
use App\IntegrasiTargetDaerahKotaKab;
use App\Kabupaten;
class FormSink7 extends Controller
{
    //

    public function index($urusan){
    	$data_link=Urusan23::find($urusan);
    	$data = IndetifikasiKebijakanTahunan::where('tahun',session('focus_tahun'))
		->where('id_urusan',$urusan)->paginate(10);

    	return view('form_singkron.form7')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data);
    }

    public function showIndetifikasiTahunan($urusan,$id){
    	$data_link=Urusan23::find($urusan);
        $satuan=Satuan::all();
    	$data=IndetifikasiKebijakanTahunan::find($id);
        $program_provinsi=NomenKlaturProvinsi::where('kode','ilike',$data_link->nomenklatur_provinsi.'%')->where('jenis','program')->get();
        
    	return view('form_singkron.form7_indetifikasi_tahunan')->with('id_link',$urusan)->with('data_link',$data_link)->with('data',$data)->with('program_provinsi',$program_provinsi)->with('satuans',$satuan);
    }



    public function add_sub_urusan_provinsi(Request $request,$urusan,$id){
        $data_link=Urusan23::find($urusan);
        $data=IndetifikasiKebijakanTahunan::find($id);

        $d=IntegrasiProvinsi::where('id_identifikasi_kebijakan_tahunan',$id)
        ->where('kode_sub_kegiatan',$request->sub_urusan_provinsi)
        ->where('tahun',session('focus_tahun'))
        ->where('id_urusan',$urusan)->first();

        if($d){
            return back();
        }

        IntegrasiProvinsi::create([
            'id_identifikasi_kebijakan_tahunan'=>$id,
            'kode_sub_kegiatan'=>$request->sub_urusan_provinsi,
            'id_user'=>Auth::User()->id,
            'tahun'=>session('focus_tahun'),
            'id_urusan'=>$urusan
        ]);

        return back();
    }


    public function add_sub_urusan_kotakab(Request $request,$urusan,$id){

        $data_link=Urusan23::find($urusan);
        $data=IndetifikasiKebijakanTahunan::find($id);

        $d=IntegrasikotaKab::where('id_identifikasi_kebijakan_tahunan',$id)
        ->where('kode_sub_kegiatan',$request->sub_urusan_provinsi)
        ->where('tahun',session('focus_tahun'))
        ->where('id_urusan',$urusan)->first();
        
        if($d){
            return back();
        }

        IntegrasikotaKab::create([
            'id_identifikasi_kebijakan_tahunan'=>$id,
            'kode_sub_kegiatan'=>$request->sub_urusan_provinsi,
            'id_user'=>Auth::User()->id,
            'tahun'=>session('focus_tahun'),
            'id_urusan'=>$urusan
        ]);

        return back();

    }


    public function integrasi_provinsi(Request $request,$urusan){
        $data_link=Urusan23::find($urusan);

        $data_return=[];

        $integrasi=IntegrasiProvinsi::with(['nomenklatur'=>function($query){
            $query;
        },'IndetifikasiKebijakanTahunan.HavePn','IndetifikasiKebijakanTahunan.HavePp'])
        ->where('tahun',session('focus_tahun'))
        ->where('id_urusan',$urusan)->get()->toArray();
     

        $provinsis=Provinsi::orderBy('nama','ASC');
        if(isset($request->q)){
            if($request->q!=''){
                 $provinsis->where('nama','ILIKE','%'.(isset($request->q)?$request->q:null).'%');
            }
        }

        $provinsis=$provinsis->paginate(5);
        $provinsis=$provinsis->appends(['q'=>$request->q]);

        foreach ($provinsis->items() as $key => $d) {
            $d=json_decode($d,true);
            $d['data']=$integrasi;
            
            foreach ($d['data'] as $k=> $dd) {

                $target=IntegrasiTargetDaerahProvinsi::where('id_integrasi',$dd['id'])->where('kode_daerah',$d['id_provinsi'])
                ->where('tahun',session('focus_tahun'))
                ->where('id_urusan',$urusan)->first();

                if($target){
                    $target=$target->target_daerah;
                }else{
                    $target=0;
                }

                $d['data'][$k]['target_daerah']=$target;
                
            }

            $data_return[]= $d;
        }

        return view('form_singkron.form7_integrasi_provinsi')->with('id_link',$urusan)->with('data_link',$data_link)->with('provinsis',$data_return)->with('data_paginate',$provinsis);
    }


    public function store_integrasi_target_provinsi(Request $request,$urusan,$id){

        $d=IntegrasiTargetDaerahProvinsi::where('id_urusan',$urusan)
        ->where('kode_daerah',$request->kode_daerah)
        ->where('tahun',session('focus_tahun'))
        ->where('id_integrasi',$request->id_integrasi)
        ->first();

        if($d){
            $d->target_daerah=$request->target_daerah;
            $d->id_user=Auth::User()->id;
            $d->save();
        }else{
            IntegrasiTargetDaerahProvinsi::create([
                'kode_daerah'=>$request->kode_daerah,
                'tahun'=>session('focus_tahun'),
                'id_integrasi'=>$request->id_integrasi,
                'id_user'=>Auth::User()->id,
                'target_daerah'=>$request->target_daerah,
                'id_urusan'=>$urusan
            ]);

        }

        return back();

    }

    public function delete_sub_urusan_provinsi($urusan,$id){
        $d=IntegrasiProvinsi::find($id);
        if($d){
            $d->delete();
        }

        else{

        }

        return back();

    }

    public function delete_sub_urusan_kotakab($urusan,$id){
        $d=IntegrasikotaKab::find($id);
        if($d){
            $d->delete();
        }

        else{

        }

        return back();
    }


    public function integrasi_kota_kabupaten($urusan,Request $request){
          $data_link=Urusan23::find($urusan);

        $data_return=[];

        $integrasi=IntegrasikotaKab::with(['nomenklatur'=>function($query){
            $query;
        },'IndetifikasiKebijakanTahunan.HavePn','IndetifikasiKebijakanTahunan.HavePp'])
        ->where('tahun',session('focus_tahun'))
        ->where('id_urusan',$urusan)->get()->toArray();
     

        $provinsis=Kabupaten::orderBy('nama','ASC');
        if(isset($request->q)){
            if($request->q!=''){
                 $provinsis->where('nama','ILIKE','%'.(isset($request->q)?$request->q:null).'%');
            }
        }

        $provinsis=$provinsis->paginate(5);
        $provinsis=$provinsis->appends(['q'=>$request->q]);

        foreach ($provinsis->items() as $key => $d) {
            $d=json_decode($d,true);
            $d['data']=$integrasi;
            
            foreach ($d['data'] as $k=> $dd) {

                $target=IntegrasiTargetDaerahKotaKab::where('id_integrasi',$dd['id'])->where('kode_daerah',$d['id_kota'])
                ->where('tahun',session('focus_tahun'))
                ->where('id_urusan',$urusan)->first();

                if($target){
                    $target=$target->target_daerah;
                }else{
                    $target=0;
                }

                $d['data'][$k]['target_daerah']=$target;
                
            }

            $data_return[]= $d;
        }

        return view('form_singkron.form7_integrasi_kotakab')->with('id_link',$urusan)->with('data_link',$data_link)->with('provinsis',$data_return)->with('data_paginate',$provinsis);
    }


     public function store_integrasi_target_kota_kabupaten(Request $request,$urusan,$id){

        $d=IntegrasiTargetDaerahKotaKab::where('id_urusan',$urusan)
        ->where('kode_daerah',$request->kode_daerah)
        ->where('tahun',session('focus_tahun'))
        ->where('id_integrasi',$request->id_integrasi)
        ->first();

        if($d){
            $d->target_daerah=$request->target_daerah;
            $d->id_user=Auth::User()->id;
            $d->save();
        }else{
            IntegrasiTargetDaerahKotaKab::create([
                'kode_daerah'=>$request->kode_daerah,
                'tahun'=>session('focus_tahun'),
                'id_integrasi'=>$request->id_integrasi,
                'id_user'=>Auth::User()->id,
                'target_daerah'=>$request->target_daerah,
                'id_urusan'=>$urusan
            ]);

        }

        return back();

    }

}

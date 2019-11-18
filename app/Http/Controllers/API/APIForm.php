<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use App\DBS\FormMainOne;
use App\BidangUrusan;
use Auth;
use App\Form1;
use App\SubUrusan23;
use App\Mandat;
class APIForm extends Controller
{
    //

    public function getListMandat(Request $request){
      $id_sub_urusan=$request->sub_urusan;
      $mandat=Mandat::where('id_sub_urusan',$id_sub_urusan)->where('tahun',$request->tahun)->where('mandat','!=','[]')->get();
      return $mandat;

    }

    public function addDataMaster(Request $request){
      $validator=Validator::make($request->all(),[
        'tb'=>'required|string',
        'field'=>'required|string',
        'data'=>'required|unique:'.$request->tb.','.$request->field,
        'tahun'=>'nullable|numeric'
      ]);

      if($validator->fails()){
        return array(
          'code'=>500,
          'message'=>'Data Tidak Lengkap, Server Mengalami Error',
          'data'=>[]
        );
      }else{
        $dt=[];

        $dt[$request->field]=$request->data;
        if(isset($request->tahun)){
          if($request->tahun!=null){
            $dt['tahun']=$request->tahun;
          }
        }
        
        $return=DB::table($request->tb)
        ->insert($dt);

        if($return){
          return array(
            'code'=>200,
            'message'=>'Data Berhasil di Tambah',
            'data'=>[]
          );
        }else{
          return array(
            'code'=>500,
            'message'=>'Data Tidak Berhasil di Tambah',
            'data'=>[]
          );
        }

      }


    }

    public function getList(Request $request){

      if($request->use_id){
          $query=("SELECT id as id,".$request->field." as text FROM ".$request->tb." ".
      "WHERE ".$request->field." ILIKE ('%".$request->nama."%') ".(isset($request->tahun)?($request->tahun!=null?('AND tahun='.$request->tahun):""):"")." ORDER BY ".$request->field." ASC");

      }else{
         $query=("SELECT ".$request->field." as id,".$request->field." as text FROM ".$request->tb." ".
      "WHERE ".$request->field." ILIKE ('%".$request->nama."%') ".(isset($request->tahun)?($request->tahun!=null?('AND tahun='.$request->tahun):""):"")." ORDER BY ".$request->field." ASC");

      }
      
      return DB::connection('pgsql')->select($query);
    }

    public function TableMandat(Request $request){
      $user=Auth::user();
      $bidang=$request->bidang_id;
      $mandat=[];
      if($user->role==1){
        $bidang=BidangUrusan::find($bidang);
      }else{
        $ids=$user->haveUrusan;
        if($ids){
          $ids=$ids->pluck('id_bidang');
          $ids=json_decode($ids,true);
          if(in_array($bidang, $ids)){
            $mandat=Form1::where('id_bidang',$bidang)->orderBy('id','DESC')->get();
            $bidang=BidangUrusan::find($bidang);
          }else{
            $bidang=null;
          }

        }else{
          $ids=[];
        }
      }

      if($bidang){
        return view('admin.form.component.mandat_table')->with('bidang',$bidang)->with('mandats',$mandat)->render();
      }else{
        return 'Role User Not Valid';
      }
      
    }

    public function formMandat(Request $request){
      $user=Auth::user();
      $bidang=$request->bidang_id;

      if($user->role==1){
        $bidang=BidangUrusan::find($bidang);
      }else{
        $ids=$user->haveUrusan;
        if($ids){
          $ids=$ids->pluck('id_bidang');
          $ids=json_decode($ids,true);
          if(in_array($bidang, $ids)){
            $bidang=BidangUrusan::find($bidang);
          }else{
            $bidang=null;
          }

        }else{
          $ids=[];
        }
      }

      if($bidang){
        return view('admin.form.component.mandat_input')->with('bidang',$bidang)->render();
      }else{
        return 'Role User Not Valid';
      }
      
    }

    public function getForm1(Request $request){

      return datatables()->eloquent(
        FormMainOne::with(['listPp','listUu','listPermen','listPerpres','listPerda','listPerkada','listMandat','listSubUrusan'])->orderBy('id','DESC')


      )->addColumn('mandat',function(FormMainOne $from_1_main){
        return '';
         //  $list=[];
         // return $from_1_main->listSubUrusan->nama_sub_urusan;
      })->addColumn('nama_sub_urusan',function(FormMainOne $from_1_main){
          $list=[];
         return $from_1_main->listSubUrusan->nama_sub_urusan;
      })->addColumn('nama_uu',function(FormMainOne $from_1_main){
          $list=[];
          foreach ($from_1_main->listUu as $key => $value) {
            $list[]=$value->nama_uu;
          }
         return $list;
      })->addColumn('nama_pp',function(FormMainOne $from_1_main){
          $list=[];
          foreach ($from_1_main->listPp as $key => $value) {
            $list[]=$value->nama_pp;
          }
         return $list;
      })->addColumn('nama_perpres',function(FormMainOne $from_1_main){
          $list=[];
          foreach ($from_1_main->listPerpres as $key => $value) {
            $list[]=$value->nama_perpres;
          }
         return $list;
      })->addColumn('nama_permen',function(FormMainOne $from_1_main){
          $list=[];
          foreach ($from_1_main->listPermen as $key => $value) {
            $list[]=$value->nama_permen;
          }
         return $list;
      })->addColumn('nama_perda',function(FormMainOne $from_1_main){
            $list=[];
            foreach ($from_1_main->listPerda as $key => $value) {
              $list[]=$value->nama_perda;
            }
           return $list;
      })->addColumn('nama_perkada',function(FormMainOne $from_1_main){
            $list=[];
            foreach ($from_1_main->listPerkada as $key => $value) {
              $list[]=$value->nama_perkada;
            }
           return $list;
      })->addColumn('action_button',function(FormMainOne $from_1_main){
          return array(
              // array('tag'=>'view','href'=>route('form_1.edit',['id'=>$from_1_main->id])),
              array('tag'=>'edit','href'=>route('form_1.edit',['id'=>$from_1_main->id])),
          );
      })

      ->toJson();
    }

    public function getForm2(Request $request){
      return datatables()->of(
        DB::connection(env('DBC2'))
          ->select("
            select
            form_1_main.k_sub_urusan as k_sub_urusan,
            form_1_pp.nama_pp as k_pp,
            form_1_uu.nama_uu as k_uu,
            form_1_perpres.nama_perpres as k_perpres,
            form_1_permen.nama_permen as k_permen,
            form_1_main.k_perda,
            form_1_main.k_perkada,
            form_1_main.k_mandat,
            form_1_main.k_keterangan,
            form_1_main.k_kesesuaian
            from form_1_main
            left join form_1_pp  on form_1_pp.id = form_1_main.k_pp
            left join form_1_uu on form_1_uu.id = form_1_main.k_uu
            left join form_1_perpres on form_1_perpres.id = form_1_main.k_perpres
            left join form_1_permen on form_1_permen.id = form_1_main.k_permen
            order by form_1_main.id DESC
            ")
        )->toJson();
    }
}

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
use App\KebijakanPusatTahunanTarget;
use DB;
class FormSink7 extends Controller
{
    //

    public function index($urusan){
    	$data_link=Urusan23::find($urusan);

    	$data = IndetifikasiKebijakanTahunan::where('tahun',session('focus_tahun'))
		->where('id_urusan',$urusan)->paginate(10);

        $data2=KebijakanPusatTahunanTarget::with('KebijakanPusatTahunan')->where('tahun',session('focus_tahun'))
        ->where('id_urusan',$urusan)->get()->toArray();

    	return view('form_singkron.form7')->with('menu_id','s.7.1')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data);
    }

    public function showIndetifikasiTahunan($urusan,$id){
    	$data_link=Urusan23::find($urusan);
        $satuan=Satuan::all();
    	$data=IndetifikasiKebijakanTahunan::find($id);
        $program_provinsi=NomenKlaturProvinsi::where('kode','ilike',$data_link->nomenklatur_provinsi.'%')->where('jenis','program')->get();
        
    	return view('form_singkron.form7_indetifikasi_tahunan')->with('menu_id','s.7.1')->with('id_link',$urusan)->with('data_link',$data_link)->with('data',$data)->with('program_provinsi',$program_provinsi)->with('satuans',$satuan);
    }



    public function add_sub_urusan_provinsi(Request $request,$urusan,$id){
        $data_link=Urusan23::find($urusan);
        $data=IndetifikasiKebijakanTahunan::find($id);

        $d=IntegrasiProvinsi::where('id_identifikasi_kebijakan_tahunan',$id)
        ->where('kode_sub_kegiatan',$request->sub_urusan_provinsi)
        ->with('menu_id','s.7.2')
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
        ->with('menu_id','s.7.3')
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


    public function integrasi_provinsi_2(Request $request,$urusan){
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

        return view('form_singkron.form7_integrasi_provinsi')->with('menu_id','s.7.2')->with('id_link',$urusan)->with('data_link',$data_link)->with('provinsis',$data_return)->with('data_paginate',$provinsis);
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

        return view('form_singkron.form7_integrasi_kotakab')->with('menu_id','s.7.3')->with('id_link',$urusan)->with('data_link',$data_link)->with('provinsis',$data_return)->with('data_paginate',$provinsis);
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


    public function integrasi_provinsi($urusan,Request $request){
        $data_link=Urusan23::find($urusan);

        if(isset($request->q)){

            $daerah_paginate= \App\Provinsi::where('nama','ILIKE',"%".$request->q."%")->paginate(2);

            $daerah_paginate->appends(['q'=>$request->q]);
        }else{
            $daerah_paginate= \App\Provinsi::paginate(2);
        }
       $daerah=$daerah_paginate->pluck('id_provinsi');
       $ids='()';
       foreach ($daerah as $key => $value) {
            if($ids=='()'){
                $ids='';
             }
            if(!isset($daerah[$key+1])){
                $ids.="'".(string)$value."'";
            }else{
            $ids.="'".(string)$value."',";
            }
       }

       $ids='('.$ids.')';
       $query="select pp.nama_pp as pp, pn.nama_pn as pn, kpt.tahun as tahun, p_id,p_nama,kpt.id as id_kebijakan_tahunan,kpt.kegiatan_prioritas as kp,tpp.tp_id as id_target_pusat, tpp.target_pusat as target_pusat,lokus_pusat,pelaksana_pusat,tpro.id id_target_daerah, tpro.target as target_daerah,
            sub_k.nomenklatur as sub_k,k.nomenklatur as k,p.nomenklatur as p,tpro.kode_sub_kegiatan as kode_sub_kegiatan

             from 
        (   
            select p.nama as p_nama, p.id_provinsi as p_id, tp.id as  tp_id,tp.target as target_pusat, tp.id_kebijikan_pusat_tahunan, tp.lokus as lokus_pusat, tp.pelaksana as pelaksana_pusat  from provinsi as p  ,
            (select * from kebijakan_pusat_tahunan_target where id_urusan = ".$urusan." and tahun=".session('focus_tahun').") as tp
        ) as tpp 
         left join kebijakan_pusat_tahunan_target_provinsi as tpro on tpp.tp_id = tpro.id_target_pusat and tpro.kode_daerah=p_id and tpro.tahun = ".session('focus_tahun')." and tpro.id_urusan =".$urusan."
         left join identifikasi_kebijakan_tahunan as kpt on kpt.id = tpp.id_kebijikan_pusat_tahunan
        left join master_prioritas_nasional  as pn on pn.id = kpt.prioritas_nasional
        left join master_program_prioritas  as pp on pp.id = kpt.program_prioritas 

        left join master_nomenklatur_provinsi  as sub_k on sub_k.kode = tpro.kode_sub_kegiatan and sub_k.jenis='sub_kegiatan'
        left join master_nomenklatur_provinsi  as k on k.kode = CONCAT(sub_k.urusan,'.',sub_k.bidang_urusan,'.',sub_k.program,'.',sub_K.kegiatan) and k.jenis = 'kegiatan'
        left join master_nomenklatur_provinsi  as p on p.kode =CONCAT(sub_k.urusan,'.',sub_k.bidang_urusan,'.',sub_k.program) and P.jenis = 'program'
         where kpt.tahun =".session('focus_tahun')." and  p_id in ".$ids." order by p_id,id_kebijakan_tahunan,id_target_pusat,id_target_daerah ASC";

      $daerah= DB::select($query);
      $daerah=json_encode(($daerah));
      $daerah=json_decode($daerah,true);
        $data_return=[];
      foreach ($daerah as $key => $v) {
        if(isset($data_return[$v['p_id']])){

        }else{
            $data_return[$v['p_id']]=array('p_id'=>$v['p_id'],'p_nama'=>$v['p_nama']);
        }
       

        if(isset($data_return[$v['p_id']]['kebijakan_tahunan'])){

            if($v['id_kebijakan_tahunan']){

                 $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]=array(
                'id_kebijakan_tahunan'=>$v['id_kebijakan_tahunan'],

                'kp'=>$v['kp'],
                'pp'=>$v['pp'],
                'pn'=>$v['pn'],
                );
            }
        }else{
            $data_return[$v['p_id']]['kebijakan_tahunan']=[];
            if($v['id_kebijakan_tahunan']){
                $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]=array(
                    'id_kebijakan_tahunan'=>$v['id_kebijakan_tahunan'],
                    'kp'=>$v['kp'],
                    'pp'=>$v['pp'],
                    'pn'=>$v['pn'],

                );
            }
        }

        if(isset($data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]['target_pusat'])){
            if(isset($v['id_target_pusat'])){
            
                $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]['target_pusat'][$v['id_target_pusat']]=array(
                    'id_target_pusat'=>$v['id_target_pusat'],
                    'target_pusat'=>$v['target_pusat'],
                    'lokus_pusat'=>$v['lokus_pusat'],
                    'pelaksana_pusat'=>$v['pelaksana_pusat']
                );
            }

        }else{

            $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]['target_pusat']=[];
             if(isset($v['id_target_pusat'])){
                $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]['target_pusat'][$v['id_target_pusat']]=array(
                    'id_target_pusat'=>$v['id_target_pusat'],
                    'target_pusat'=>$v['target_pusat'],
                    'lokus_pusat'=>$v['lokus_pusat'],
                    'pelaksana_pusat'=>$v['pelaksana_pusat']
                );
            }
        }

        if(isset( $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]['target_pusat'][$v['id_target_pusat']]['target_daerah'])){
             if(isset($v['id_target_daerah'])){
                $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]['target_pusat'][$v['id_target_pusat']]['target_daerah'][$v['id_target_daerah']]=array(
                'id_target_daerah'=>$v['id_target_daerah'],
                'target_daerah'=>$v['target_daerah'],
                'kode_sub_kegiatan'=>$v['kode_sub_kegiatan'],

                'p'=>$v['p'],
                'k'=>$v['k'],
                'sub_k'=>$v['sub_k'],


                );
            }

        }else{
            $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]['target_pusat'][$v['id_target_pusat']]['target_daerah']=[];

            if(isset($v['id_target_daerah'])){
                $data_return[$v['p_id']]['kebijakan_tahunan'][$v['id_kebijakan_tahunan']]['target_pusat'][$v['id_target_pusat']]['target_daerah'][$v['id_target_daerah']]=array(
                'id_target_daerah'=>$v['id_target_daerah'],
                'target_daerah'=>$v['target_daerah'],
                    'kode_sub_kegiatan'=>$v['kode_sub_kegiatan'],

                'p'=>$v['p'],
                'k'=>$v['k'],
                'sub_k'=>$v['sub_k'],
                );
            }
        }

      }

      if(count($data_return)<=0){
        $daerah_paginate=\App\Provinsi::where('id_provinsi',NULL)->paginate(10);
      }
      // return $data_return;
      return view('form_singkron.form7_integrasi_provinsi')->with('menu_id','s.7.2')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data_return)->with('data_paginate',$daerah_paginate);

    }

    public function integrasi_provinsi_tambah($urusan,$kode_daerah,$id_target_pusat){
        $data_link=Urusan23::find($urusan);


        $data_head=DB::select("select kpt.id as id,kpt.lokus as lokus, kpt.pelaksana as pelaksana, kpt.target as target,
            pn.nama_pn as pn, pp.nama_pp as pp, k.kegiatan_prioritas as kp
            from kebijakan_pusat_tahunan_target as kpt
            left join identifikasi_kebijakan_tahunan as k on k.id = kpt.id_kebijikan_pusat_tahunan
            left join master_prioritas_nasional as pn on pn.id = k.prioritas_nasional
            left join master_program_prioritas as pp on pp.id = k.program_prioritas
            where kpt.id_urusan =".$urusan." and kpt.tahun = ".session('focus_tahun')." and kpt.id=".$id_target_pusat);

       if($data_head){
        $data_head=json_encode(($data_head));
        $data_head=json_decode($data_head,true);
        $data_head=$data_head[0];
        $data=IntegrasiTargetDaerahProvinsi::where('id_integrasi',$id_target_pusat)->where('tahun',session('focus_tahun'))->where('kode_daerah',$kode_daerah)->get();

        $daerah=\App\Provinsi::where('id_provinsi',$kode_daerah)->first();

        $program_provinsi=\App\NomenKlaturProvinsi::where('kode','ilike',$data_link->nomenklatur_provinsi.'%')->where('jenis','program')->get();
        $master_satuan=DB::table('master_satuan')->get();

        return view('form_singkron.form7_integrasi_provinsi_tambah')
        ->with('menu_id','s.7.2')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data)->with('parent',$data_head)->with('daerah',$daerah)->with('program_provinsi',$program_provinsi)->with('master_satuan',$master_satuan);
            
       }

       


    }

}

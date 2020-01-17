<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urusan23;
use App\IndetifikasiKebijakanTahunan;
use Auth;
use App\ProPN;
use Validator;
use DB;
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


    public function index($urusan, Request $request){

  



        $paginate=5;
        $query_count="select count(*) as jdata,".(isset($request->page)?$request->page:1)." as page, CONCAT('".(count($request->all())>0?(json_encode($request->except(["page",0]))):"[]")."')  as input,".$paginate." as paginate

      
         from n_kebijakan_pusat_tahunan as kpt
         where kpt.id_urusan = ".$urusan." and kpt.tahun =".session("focus_tahun").' limit '.$paginate;

        $query='select 

        kpt.id as id,kpt.id_master_pn, pn.prioritas_nasional,pn.program_prioritas, pn.kegiatan_prioritas, propn.pro_pn,propn.id as id_propn,
        kptarget.target,kptarget.tahun as tahun_target,kptarget.lokus as lokus_target,kptarget.pelaksana as pelaksana_target,kptarget.id as id_target,kptarget.satuan_target as satuan_target, kptarget.uraian_target as uraian_target

        from n_kebijakan_pusat_tahunan as  kpt
        left join master_pn as pn on pn.id =  kpt.id_master_pn
        left join identifikasi_kebijakan_tahunan_pro_pn as propn on 
        propn.id_identifikasi_kebijakan_tahunan = kpt.id
        left join kebijakan_pusat_tahunan_target as kptarget on 
        
        kptarget.id_kebijikan_pusat_tahunan = kpt.id

        where kpt.id_urusan = '.$urusan.' and kpt.tahun ='.session('focus_tahun').'

        ';

        return $query;
        $data=DB::select($query);

        dd($data);
        // dd(DB::select($query_count));

        $paginate=(array) DB::select($query_count)[0];
        $paginate['input']=(array) $paginate['input'];
        $data_return=[];

        foreach ($data as $key => $value) {
            # code...
            $data_return[$value->id]['id']=$value->id;
            $data_return[$value->id]['pn']=$value->prioritas_nasional;
            $data_return[$value->id]['id_master_pn']=$value->id_master_pn;

            $data_return[$value->id]['pp']=$value->program_prioritas;
            $data_return[$value->id]['kp']=$value->kegiatan_prioritas;
            $data_return[$value->id]['pro_pn'][$value->id_propn]['id']=$value->id_propn;

            $data_return[$value->id]['pro_pn'][$value->id_propn]['propn']=$value->pro_pn;

            $data_return[$value->id]['target'][$value->id_target]['target']=$value->target;
            $data_return[$value->id]['target'][$value->id_target]['uraian']=$value->uraian_target;

            $data_return[$value->id]['target'][$value->id_target]['satuan']=$value->satuan_target;

            $data_return[$value->id]['target'][$value->id_target]['tahun']=$value->tahun_target;
            $data_return[$value->id]['target'][$value->id_target]['lokus']=$value->lokus_target;
            $data_return[$value->id]['target'][$value->id_target]['pelaksana']=$value->pelaksana_target;
        }

    	$data_link=Urusan23::find($urusan);
    	return view('form_singkron.form3')->with('menu_id','s.3')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data_return)->with('paginate',$paginate);
    }


     public function create($urusan){
    	$data_link=Urusan23::find($urusan);
    	return view('form_singkron.form3_tambah')->with('menu_id','s.3')->with('id_link',$urusan)->with('data_link',$data_link);;
    }


    public function store($urusan,Request $request){
        
    	$id=IndetifikasiKebijakanTahunan::create(
    		[
    		'id_urusan'=>$urusan,
	    	'tahun'=>session('focus_tahun'),
	    	'prioritas_nasional'=>isset($request->pn)?(($request->pn[0])):null,
	    	'program_prioritas'=>isset($request->pp)?(($request->pp[0])):null,
	    	'kegiatan_prioritas'=>$request->kegiatan_prioritas,
	    	// 'target'=>$request->target,
	    	// 'lokus'=>$request->lokus,
	    	// 'pelaksana'=>$request->pelaksana,
	    	'id_user'=>Auth::User()->id
	    	]
    	);

    	if($id){
    		$id=$id->id;
    		if($request->new_propn){
    			foreach($request->new_propn as $pro_pn){
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
            if(isset($request->new_target)){
                foreach($request->new_target as $target){

                    if(($target['target']!="")&&($target['lokus']!="")){

                        \App\KebijakanPusatTahunanTarget::create([
                            'id_urusan'=>$urusan,
                            'uraian_target'=>$target['uraian'],
                            'id_kebijikan_pusat_tahunan'=>$id,
                            'tahun'=>session('focus_tahun'),
                            'target'=> $target['target'],
                            'satuan_target'=> $target['satuan_target'],
                            'lokus'=> $target['lokus'],
                            'pelaksana'=> $target['pelaksana'],
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
    		return view('form_singkron.form3_edit')->with('menu_id','s.3')->with('id_link',$urusan)
    		->with('data_link',$data_link)->with('data',$data);
    	}
    }

    public function update($urusan,$id,Request $request){
    	$data=IndetifikasiKebijakanTahunan::find($id);

    	if($data){

    		$data->update(
    			[
		    	'prioritas_nasional'=>isset($request->pn)?(($request->pn[0])):null,
                'program_prioritas'=>isset($request->pp)?(($request->pp[0])):null,
		    	'kegiatan_prioritas'=>$request->kegiatan_prioritas,
	    		]
    		);

    		$id=$data->id;


    		// $propn=ProPN::where('id_identifikasi_kebijakan_tahunan',$id)->delete();
    		if(isset($request->new_propn)){
    			foreach($request->new_propn as $key=>$pro_pn){
            
                    

	    			if(($pro_pn!=null )){
	    				ProPN::create([
		    				'id_urusan'=>$urusan,
		    				'id_identifikasi_kebijakan_tahunan'=>$id,
		    				'tahun'=>session('focus_tahun'),
		    				'pro_pn'=> $pro_pn,
		    				'id_user'=>Auth::User()->id,
	    				]);
	    			}
    			}

	    	}

            if(isset($request->new_target)){
                foreach($request->new_target as $target){

                    if(($target['target']!="")&&($target['lokus']!="")){

                      $f=  \App\KebijakanPusatTahunanTarget::create([
                            'id_urusan'=>$urusan,
                            'id_kebijikan_pusat_tahunan'=>$id,
                            'tahun'=>session('focus_tahun'),
                            'target'=> $target['target'],
                            'uraian_target'=> $target['uraian'],
                            'lokus'=> $target['lokus'],
                            'pelaksana'=> $target['pelaksana'],
                            'satuan_target'=> $target['satuan_target'],
                            'id_user'=>Auth::User()->id
                        ]);

                    }
                }

            }

	    	return back();

    	}
    }


    public function target_update($urusan,$id,Request $request){
        if($request->target){
            foreach($request->target as $key=>$target_r){
                $data=$request;
                foreach ($target_r as $keyx => $value) {
                  
                    $data->request->add([$keyx=>$value]);
                }

                
                $validator= Validator::make($data->all(),[
                        'target'=>'required|string',
                        'lokus'=>'required|string',
                        'pelaksana'=>'required|string',

                ]);

                if(!$validator->fails()){
                    $target=\App\KebijakanPusatTahunanTarget::find($key);
                    if($target){
                        $target->update([
                        'target'=> $target_r['target'],
                        'lokus'=> $target_r['lokus'],
                        'pelaksana'=> $target_r['pelaksana'],
                        'satuan_target'=> $target['satuan_target'],
                        'id_user'=>Auth::User()->id
                        ]);
                    }
                }else{
                    dd($validator->errors());
                }

                return back();

            }
        }
    }



     public function target_delete($urusan,$id,$id_target){
         $target=\App\KebijakanPusatTahunanTarget::where('id_urusan',$urusan)
         ->where('id_kebijikan_pusat_tahunan',$id)
         ->where('id',$id_target)->first();

         if($target){
            
            $target->delete();
            return back();

         }else{


         }

        
    }

    public function propn_delete($urusan,$id,$id_target){
         $propn=\App\ProPN::where('id_urusan',$urusan)
         ->where('id_identifikasi_kebijakan_tahunan',$id)
         ->where('id',$id_target)->first();
         if($propn){
        
            $propn->delete();
            return back();

         }else{


         }

        
    }

     
}

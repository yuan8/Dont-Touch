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


    static public function jsonBuild($data=[]){
        $data_return=[];
        foreach ($data as $key => $value) {
            $pn=explode('|++|', $value->pn);
            if(count($pn)>0){
                $pn=explode('||',$pn[0]);

            }else{
                $pn=[null,null,null,null];
            }

            $propn=explode('|++|',  str_replace('"','',$value->propn));
             
            

            $data_return[$value->id]['id']=$value->id;
            $data_return[$value->id]['pn']=$pn[1];            
            $data_return[$value->id]['pp']=$pn[2];
            $data_return[$value->id]['kp']=$pn[3];
            $data_return[$value->id]['id_pn']=$pn[0];


            if(!isset($data_return[$value->id]['propn'])){
                $data_return[$value->id]['propn']=[];
            }

            if(!isset($data_return[$value->id]['target'])){
                $data_return[$value->id]['target']=[];
            }

            foreach ($propn as $key => $d) {
                $d=explode('||', $d);
                 if((count($d)>=1)&&($d[0]!="")){
                     if($d!=null){
                        $data_return[$value->id]['propn'][$d[0]]['propn']=$d[1];
                        $data_return[$value->id]['propn'][$d[0]]['id']=$d[0];
                    }
                 }
            }
            
            $target=explode('|++|', $value->target);

            foreach ($target as $key => $d) {
                # code...
                $d=explode('||', $d);
                if(count($d)>2){
                    $data_return[$value->id]['target'][$d[0]]['id']=$d[0];
                    $data_return[$value->id]['target'][$d[0]]['uraian']=$d[1];
                    $data_return[$value->id]['target'][$d[0]]['target']=$d[2];
                    $data_return[$value->id]['target'][$d[0]]['satuan']=$d[3];
                    $data_return[$value->id]['target'][$d[0]]['lokus']=$d[4];
                    $data_return[$value->id]['target'][$d[0]]['pelaksana']=$d[5];
                    $data_return[$value->id]['target'][$d[0]]['tahun']=$d[6];

                }
            }

           
        }

        return $data_return;
    } 

    public function listPN($urusan,Request $request){
        $query="select * from master_pn where prioritas_nasional ilike '%".$request->pn."%'  and program_prioritas ilike '%".$request->pp."%' and kegiatan_prioritas ilike '%".$request->kp."%'";
    


        $data=DB::select($query);

        $data_link=Urusan23::find($urusan);
        return view('form_singkron.form3_list_master_pn')->with('data',$data)->with('id_link',$urusan)->with('data_link',$data_link);
    }

    public function index($urusan, Request $request){



        $tahun=session('focus_tahun')!=null?session('focus_tahun'):2020;

        $page=isset($request->page)?($request->page==1?0:$request->page):0;
        $paginate=5;
        $query_count="select count(*) as jdata,".(isset($request->page)?$request->page:1)." as page, CONCAT('".(count($request->all())>0?(json_encode($request->except(["page",0]))):"[]")."')  as input,".$paginate." as paginate
         from n_kebijakan_pusat_tahunan as kpt
         where kpt.id_urusan = ".$urusan." and kpt.tahun =".$tahun.' limit '.$paginate;

        $query="select 
            a.id,
            
            (select string_agg(CONCAT(id::text,'||', pro_pn::text),'|++|')::text 
            
            from public.identifikasi_kebijakan_tahunan_pro_pn 
            
            where id_identifikasi_kebijakan_tahunan = a.id ) as propn ,
            
            (select string_agg(CONCAT(id,'||',uraian_target,'||',target,'||',satuan_target,'||',lokus,'||',pelaksana,'||',tahun),'|++|') 
            
            from  public.kebijakan_pusat_tahunan_target
            
            where id_kebijikan_pusat_tahunan = a.id and tahun=".$tahun." ) as target,
            
            (select string_agg(

            DISTINCT(CONCAT(id,'||',prioritas_nasional,'||',program_prioritas,'||',kegiatan_prioritas)),'|++|')
            
            from  public.master_pn as pn
            
            where pn.id = a.id_master_pn limit 1 ) as pn
            
            from identifikasi_kebijakan_tahunan as a
            
            where a.id_urusan=".$urusan." and a.tahun =".$tahun."  and a.id_master_pn is not null
            
            group by a.id order by a.id  limit ".$paginate ." offset ".$page;

        ;


        // $query="select a.id as id,  
        //     (select string_agg(CONCAT(id::text,'||', pro_pn::text),'|++|')::text 
        //     from public.identifikasi_kebijakan_tahunan_pro_pn 
        //     where id_identifikasi_kebijakan_tahunan = a.id ) as propn,

        //     (select string_agg(CONCAT(id,'||',uraian_target,'||',target,'||',satuan_target,'||',lokus,'||',pelaksana,'||',tahun),'|++|') 
        //     from  public.kebijakan_pusat_tahunan_target
        //     where id_kebijikan_pusat_tahunan = a.id and tahun=".$tahun." ) as target,

         
        //     (CONCAT(mpn.id,'||',mpn.prioritas_nasional,'||',mpn.program_prioritas,'||',mpn.kegiatan_prioritas,'|++|')) as pn

        //     from master_pn as mpn
        //     left join n_kebijakan_pusat_tahunan  as a on a.id_master_pn = mpn.id 
        // "

        // ;


        $data=DB::select($query);
        $paginate=(array) DB::select($query_count)[0];
        $paginate['input']=(array) $paginate['input'];
        $data_return=[];

        $data_return=static::jsonBuild($data);
        
    	$data_link=Urusan23::find($urusan);
    	return view('form_singkron.form3')->with('menu_id','s.3')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data_return)->with('paginate',$paginate)->with('tahun',$tahun);
    }


     public function create($urusan,$id_master_pn){
        $tahun=session('focus_tahun')!=null?session('focus_tahun'):2020;
        $dataAxis=DB::table('identifikasi_kebijakan_tahunan')->where([['id_master_pn','=',$id_master_pn],['tahun','=',$tahun],['id_urusan',$urusan]])->first();

        if($dataAxis){
            return redirect()->route('fs.f3.show',['urusan'=>$urusan,'id'=>$dataAxis->id]);
        }

        $data=DB::table('master_pn')->where('id',$id_master_pn)->first();
        if($data){
            $data=(array) $data;
        }else{
            return redirect()->route('fs.f3.index');
        }


    	$data_link=Urusan23::find($urusan);
    	return view('form_singkron.form3_tambah')->with('data',$data)->with('menu_id','s.3')->with('id_link',$urusan)->with('data_link',$data_link);;
    }


    public function store($urusan,Request $request){
        
        $tahun=session('focus_tahun')!=null?session('focus_tahun'):2020;
    	
        $id=DB::table('identifikasi_kebijakan_tahunan')->insertGetId([
            'id_urusan'=>$urusan,
            'id_master_pn'=>$request->id_master_pn,
            'tahun'=>$tahun,
            'created_at'=>date('Y-m-d h:i'),
            'updated_at'=>date('Y-m-d h:i'),
            'id_user'=>Auth::User()->id
        ]);

      

    	if($id){
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
        $tahun=session('focus_tahun')?session('focus_tahun'):2020;

         $query="select 
            a.id,
            
            (select string_agg(CONCAT(id::text,'||', pro_pn::text),'|++|')::text 
            
            from public.identifikasi_kebijakan_tahunan_pro_pn 
            
            where id_identifikasi_kebijakan_tahunan = a.id ) as propn ,
            
            (select string_agg(CONCAT(id,'||',uraian_target,'||',target,'||',satuan_target,'||',lokus,'||',pelaksana,'||',tahun),'|++|') 
            
            from  kebijakan_pusat_tahunan_target
            
            where id_kebijikan_pusat_tahunan = a.id and tahun=".$tahun." ) as target,
            
            (select string_agg(

            DISTINCT(CONCAT(id,'||',prioritas_nasional,'||',program_prioritas,'||',kegiatan_prioritas)),'|++|')
            
            from  public.master_pn as pn
            
            where pn.id = a.id_master_pn limit 1 ) as pn
            
            from identifikasi_kebijakan_tahunan as a
            
            where a.id_urusan=".$urusan." and a.tahun =".$tahun." and a.id=".$id."  and a.id_master_pn is not null
            
            group by a.id order by a.id ";

        ;

        $data=DB::select($query);


        $data_return=static::jsonBuild($data);

        if(count($data_return)>0){

            $data_return=$data_return[$id];
        }

        
        $data_link=Urusan23::find($urusan);
    	
        if($data_return){
    		return view('form_singkron.form3_edit')->with('menu_id','s.3')->with('id_link',$urusan)
    		->with('data_link',$data_link)->with('data',$data_return);
    	}else{
            return abort('404');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urusan23;

use DB;
class FormSink5 extends Controller
{
    //

    public function index($urusan,Request $request){
    	$data_link=Urusan23::find($urusan);

        $data_paginate=DB::table('program_kegiatan_lingkup_supd_2')->where(['tahun'=>session('focus_tahun')]);

        $query="select s.nama as sub_urusan, ki.indikator, ki.target_awal, ki.satuan,ki.target_ahir, d.nama as daerah, a.id as id , a.anggaran, a.nspk,a.spm, a.pn, a.spm, a.sdgs , a.pelaksana as pelaksana,";
        
        // $query.="np.nomenklatur as program , nk.nomenklatur as kegiatan from program_kegiatan_lingkup_supd_2 as a";

        $query.=" a.uraian_kode_program_daerah as program , a.uraian_kode_kegiatan_daerah as kegiatan from program_kegiatan_lingkup_supd_2 as a ";

        $query.=" left join program_kegiatan_lingkup_supd_2_indikator_provinsi as ki on ki.id_kegiatan_supd_2 = a.id";
        $query.=" left join master_nomenklatur_provinsi as np on a.kode_program = np.kode";
        $query.=" left join master_nomenklatur_provinsi as nk on a.kode_kegiatan = nk.kode";
        $query.=" left join provinsi as d on a.kode_daerah = d.id_provinsi";
        $query.=" left join master_sub_urusan as s on s.id = a.id_sub_urusan";

        $query.=" where a.tahun = ".session('focus_tahun');
        $data_paginate=$data_paginate->where('id_urusan',$urusan);




        $data_paginate_appends=[];
        if(isset($request->daerah)){
            $query.=" and a.kode_daerah = '".($request->daerah)."'";
            $data_paginate=$data_paginate->where('kode_daerah',$request->daerah);
            $data_paginate_appends['kode_daerah']=$request->daerah;
           
        }
        if(isset($request->npsk)){
            $query.=" and a.nspk = true";
            $data_paginate=$data_paginate->where('nspk',true);
            $data_paginate_appends['nspk']=$request->nspk;
            
        }
       
        if(isset($request->spm)){
            $query.=" and a.spm = true";
            $data_paginate=$data_paginate->where('spm',true);
            $data_paginate_appends['spm']=$request->spm;
        }
        
        if(isset($request->pn)){
            $query.=" and a.pn = true";

            $data_paginate=$data_paginate->where('pn',true);
            $data_paginate_appends['pn']=$request->pn;
        }

         if(isset($request->sub_urusan)){
            $query.=" and a.id_sub_urusan =".$request->sub_urusan;

           $data_paginate=$data_paginate->where('id_sub_urusan',$request->sub_urusan);
            $data_paginate_appends['sub_urusan']=$request->sub_urusan;
        }

        if(isset($request->sdgs)){
            $query.=" and a.sdgs = true";
            $data_paginate=$data_paginate->where('sdgs',true);
            $data_paginate_appends['sdgs']=$request->sdgs;
        }

        if(isset($request->kode_program)){
            $query.=" and a.kode_program = '".$request->kode_program."'";
           $data_paginate=$data_paginate->where('kode_program',$request->kode_program);
            $data_paginate_appends['kode_program']=$request->kode_program;
        }

        if(isset($request->kode_kegiatan)){
           if(isset($request->kode_kegiatan)){
            $query.=" and a.kode_kegiatan = '".$request->kode_kegiatan."'";
            $data_paginate=$data_paginate->where('kode_kegiatan',$request->kode_kegiatan);
            $data_paginate_appends['kode_kegiatan']=$request->kode_kegiatan;
           }
        }



       
        

        $data_paginate=$data_paginate->paginate(5);

        $data=$data_paginate->pluck('id');
        $ids="(0)";

        foreach ($data as $key => $value) {
            if($ids=='(0)'){
                $ids="";
            }

            if(isset($data[$key+1])){
                $ids.=$value.',';
            }else{
                $ids.=$value;
            }
        }

        $query.=" and a.id_urusan =".$urusan." and a.id in (".$ids.")";
        $query.=" order by a.id DESC";


        // return $query;
        $data=DB::select($query);
        $data=json_encode($data);
        $data=json_decode($data,true);
        $data_return=[];

        foreach ($data as $key => $value) {
            
            if(isset($data_return[$value['id']])){
                  if(isset($value['indikator'])){
                     $data_return[$value['id']]['indikator'][]=array(
                        'target_ahir'=>$value['target_ahir'],
                        'target_awal'=>$value['target_awal'],
                        'indikator'=>$value['indikator'],
                        'satuan'=>$value['satuan'],
                    );
                }



            
            }else{

                $data_return[$value['id']]=array(
                    'id'=>$value['id'],
                    'nspk'=>$value['nspk'],
                    'spm'=>$value['spm'],
                    'pn'=>$value['pn'],
                    'nspk'=>$value['nspk'],
                    'sdgs'=>$value['sdgs'],
                    'daerah'=>$value['daerah'],
                    'sub_urusan'=>$value['sub_urusan'],

                    'program'=>$value['program'],
                    'kegiatan'=>$value['kegiatan'],
                    'anggaran'=>$value['anggaran'],
                    'pelaksana'=>$value['pelaksana'],
                    'indikator'=>[]

                );

                if(isset($value['indikator'])){
                     $data_return[$value['id']]['indikator'][]=array(
                    'target_ahir'=>$value['target_ahir'],
                    'target_awal'=>$value['target_awal'],
                    'indikator'=>$value['indikator'],
                    'satuan'=>$value['satuan'],

                );
                }
            }
        }

     

        $program_provinsi=\App\NomenKlaturProvinsi::where('kode','ilike',$data_link->nomenklatur_provinsi.'%')->where('jenis','program')->get();

        $daerahs=\App\Provinsi::all();

        $sub_urusans=DB::table('master_sub_urusan')->where('id_urusan',$urusan)->get();









    	// $data=DB::connection('pgsql2')->table('perumahan_kegiatan_2')->join('view_daerah','kodedaerah','id')->orderBy('ID','DESC')->where('perumahan_kegiatan_2.id_urusan',$urusan);


     //    if($request->daerah && $request->daerah!=""){
     //        $data=$data->where('nama','ilike',('%'.$request->daerah.'%'));
     //    }
     //    if(isset($request->program) && $request->program!=""){
     //        $data=$data->where('nama_program','ilike',('%'.$request->program.'%'));
     //    }

     //    if(isset($request->kegiatan) && $request->kegiatan!=""){
     //        $data=$data->where('kegiatan','ilike',('%'.$request->kegiatan.'%'));
     //    }


     //    $data=$data->paginate(10);

     //    $data=$data->appends(['program'=>$request->program,'daerah'=>$request->daerah,'kegiatan'=>$request->kegiatan]);



    	return view('form_singkron.form5')->with('id_link',$urusan)->with('data_link',$data_link)
    	->with('datas',$data_return)->with('data_paginate',$data_paginate)->with('program_provinsi',$program_provinsi)->with('daerah',$daerahs)->with('sub_urusans',$sub_urusans);
    }

    public function update_jenis_kegiatan($urusan,$id,Request $request){
    	$data=DB::connection('pgsql2')->table('perumahan_kegiatan_2')->where('ID',$id)->first();

    	if($data){
    		$data->NSPK=isset($request->nspk)?1:0;
    		$data->SPM=isset($request->spm)?1:0;
    		$data->PN=isset($request->pn)?1:0;
    		$data->SDGS=isset($request->sdgs)?1:0;
    		$data=(array) $data;
    		$return=DB::connection('pgsql2')->table('perumahan_kegiatan_2')->where('ID',$id)->update($data);

    	}

    	return back();

    }

    public function update_pkl_supd_2($id,Request $request){

        $d=DB::table('program_kegiatan_lingkup_supd_2')->where('id',$id)->update($request->data);

        return $d;
    }



}

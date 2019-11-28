<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urusan23;

use DB;

class KegiatanSupd2Ctrl extends Controller
{
    //
    public function index(Request $request){

    	$urusan=isset($request->kode_urusan)?$request->kode_urusan:null;

    	$data_link=Urusan23::find($urusan);
        $tahun=(session('focus_tahun')==!null)?session('focus_tahun'):2020;
        $query2_group_by="";
        $filter=array(
            'daerah'=>false,
            'urusan'=>false,
            'sub_urusan'=>false,
        );

       	$data_paginate=DB::table('program_kegiatan_lingkup_supd_2')->where(['tahun'=>$tahun]);

        $query2="select count(CASE WHEN (ki.indikator != null) THEN 1  END) as jml_indikator, sum(a.anggaran) as jml_anggaran,count(a.id) as jml_kegiatan, count(CASE WHEN a.nspk THEN 1 END) as jml_nspk,count(CASE WHEN a.spm THEN 1 END) as jml_spm,count(CASE WHEN a.pn THEN 1 END) as jml_pn, count(CASE WHEN a.sdgs THEN 1 END) as jml_sdgs,d.nama as label ";

        $query2.=" from program_kegiatan_lingkup_supd_2 as a ";


        $query2.=" left join program_kegiatan_lingkup_supd_2_indikator_provinsi as ki on ki.id_kegiatan_supd_2 = a.id";
        $query2.=" left join master_nomenklatur_provinsi as np on a.kode_program = np.kode";
        $query2.=" left join master_nomenklatur_provinsi as nk on a.kode_kegiatan = nk.kode";
        $query2.=" left join provinsi as d on a.kode_daerah = d.id_provinsi";
        $query2.=" left join master_sub_urusan as s on s.id = a.id_sub_urusan";
        $query2.=" where a.tahun = ".$tahun;


        $query="select s.nama as sub_urusan, ki.indikator, ki.target_awal, ki.satuan,ki.target_ahir, d.nama as daerah, a.id as id , a.anggaran, a.nspk,a.spm, a.pn, a.spm, a.sdgs , a.pelaksana as pelaksana,";
        
        // $query.="np.nomenklatur as program , nk.nomenklatur as kegiatan from program_kegiatan_lingkup_supd_2 as a";

        $query.=" a.uraian_kode_program_daerah as program , a.uraian_kode_kegiatan_daerah as kegiatan from program_kegiatan_lingkup_supd_2 as a ";

        $query.=" left join program_kegiatan_lingkup_supd_2_indikator_provinsi as ki on ki.id_kegiatan_supd_2 = a.id";
        $query.=" left join master_nomenklatur_provinsi as np on a.kode_program = np.kode";
        $query.=" left join master_nomenklatur_provinsi as nk on a.kode_kegiatan = nk.kode";
        $query.=" left join provinsi as d on a.kode_daerah = d.id_provinsi";
        $query.=" left join master_sub_urusan as s on s.id = a.id_sub_urusan";

        $query.=" where a.tahun = ".$tahun;

        $data_paginate_appends=[];

        if(isset($request->daerah)){
            $query.=" and a.kode_daerah = '".($request->daerah)."'";
            $query2.=" and a.kode_daerah = '".($request->daerah)."'";

            $data_paginate=$data_paginate->where('kode_daerah',$request->daerah);
            $data_paginate_appends['kode_daerah']=$request->daerah;

            if($query2_group_by==""){
                $query2_group_by.=" group by a.kode_daerah,d.nama";

            }else{
                $query2_group_by.=",a.kode_daerah";
            }

            $filter['daerah']=true;
           
        }else{
            if($query2_group_by==""){
                $query2_group_by.=" group by a.kode_daerah,d.nama";

            }else{
                $query2_group_by.=",a.kode_daerah";
            }

        }
        
        if(isset($request->nspk)){
            $query.=" and a.nspk = true ";
            $query2.=" and a.nspk = true ";

            $data_paginate=$data_paginate->where('nspk',true);
            $data_paginate_appends['nspk']=$request->nspk;
            
        }

        if(isset($request->spm)){
            $query.=" and a.spm = true";
            $query2.=" and a.spm = true";

         	$data_paginate=$data_paginate->where('spm',true);
            $data_paginate_appends['spm']=$request->spm;
        }
        
        if(isset($request->pn)){
            $query.=" and a.pn = true";
            $query2.=" and a.pn = true";


            $data_paginate=$data_paginate->where('pn',true);
            $data_paginate_appends['pn']=$request->pn;
        }

        if($urusan!=null){
             $query.=" and a.id_urusan =".$urusan;
             $query2.=" and a.id_urusan =".$urusan;
            $filter['urusan']=true;

             $data_paginate=$data_paginate->where('id_urusan',$urusan);
             $data_paginate_appends['kode_urusan']=$request->kode_urusan;
        }else{

        }

         if(isset($request->sub_urusan)){
            $query.=" and a.id_sub_urusan =".$request->sub_urusan;

            $query2.=" and a.id_sub_urusan =".$request->sub_urusan;

            $filter['sub_urusan']=true;

            $data_paginate=$data_paginate->where('id_sub_urusan',$request->sub_urusan);
            $data_paginate_appends['sub_urusan']=$request->sub_urusan;
        }else{


        }

        if(isset($request->sdgs)){
            $query.=" and a.sdgs = true";
            $query2.=" and a.sdgs = true";

            $data_paginate=$data_paginate->where('sdgs',true);
            $data_paginate_appends['sdgs']=$request->sdgs;
        }

        if(isset($request->kode_program)){
            $query.=" and a.kode_program = '".$request->kode_program."'";
            $query2.=" and a.kode_program = '".$request->kode_program."'";

           $data_paginate=$data_paginate->where('kode_program',$request->kode_program);
            $data_paginate_appends['kode_program']=$request->kode_program;
        }

        if(isset($request->kode_kegiatan)){
           if(isset($request->kode_kegiatan)){
            $query.=" and a.kode_kegiatan = '".$request->kode_kegiatan."'";

            $query2.=" and a.kode_kegiatan = '".$request->kode_kegiatan."'";

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

        $query.=" and a.id in (".$ids.")";

        $query.=" order by a.id DESC";

        $data_paginate->appends($data_paginate_appends);

        // return $query;
        $data=DB::select($query);
        $data_chart=DB::select($query2." ".$query2_group_by);

        // dd($data_chart);

        $data=json_encode($data);
        $data=json_decode($data,true);
        $data_return=[];
        foreach ($data as $key => $value) {
            
            if(isset($data_return[$value['id']])){
                  if(isset($value['indikator'])){
                     $data_return[$value['id']]['indikator'][]=array(
                        'target_ahir'=>$value['target_ahir'],
                        // 'target_awal'=>$value['target_awal'],
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

     
        if($urusan){
        	$program_provinsi=\App\NomenKlaturProvinsi::where('kode','ilike',$data_link->nomenklatur_provinsi.'%')->where('jenis','program')->get();

       		 $sub_urusans=DB::table('master_sub_urusan')->where('id_urusan',$urusan)->get();

        }else{
        	$program_provinsi=[];
        	$sub_urusans=[];

        }

       	$urusan=DB::table('master_urusan')->get();

        


        $daerahs=\App\Provinsi::all();







    	return view('all.kegiatan_supd2')->with('id_link',$urusan)->with('data_link',$data_link)
    	->with('datas',$data_return)->with('data_paginate',$data_paginate)->with('program_provinsi',$program_provinsi)->with('daerah',$daerahs)->with('sub_urusans',$sub_urusans)->with('urusans',$urusan);
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


    public function chart(Request $request){

        $tahun=(session('focus_tahun')!=null)?session('focus_tahun'):2020;
        $urusan=null;
        $query2="";
        $query="";

        $query2_group_by="";

        $query2_select="select count(CASE WHEN (ki.indikator != null) THEN 1  END) as jml_indikator, sum(a.anggaran) as jml_anggaran,count(a.id) as jml_kegiatan, count(CASE WHEN a.nspk THEN 1 END) as jml_nspk,count(CASE WHEN a.spm THEN 1 END) as jml_spm,count(CASE WHEN a.pn THEN 1 END) as jml_pn, count(CASE WHEN a.sdgs THEN 1 END) as jml_sdgs,d.nama as label ";

        $query2.=" from program_kegiatan_lingkup_supd_2 as a ";


        $query2.=" left join program_kegiatan_lingkup_supd_2_indikator_provinsi as ki on ki.id_kegiatan_supd_2 = a.id";
        $query2.=" left join master_nomenklatur_provinsi as np on a.kode_program = np.kode";
        $query2.=" left join master_nomenklatur_provinsi as nk on a.kode_kegiatan = nk.kode";
        $query2.=" left join provinsi as d on a.kode_daerah = d.id_provinsi";
        $query2.=" left join master_sub_urusan as s on s.id = a.id_sub_urusan";
        $query2.=" where a.tahun = ".$tahun;

        if(isset($request->daerah)){
            $query.=" and a.kode_daerah = '".($request->daerah)."'";
            $query2.=" and a.kode_daerah = '".($request->daerah)."'";

            $data_paginate_appends['kode_daerah']=$request->daerah;

            if($query2_group_by==""){
                $query2_group_by.=" group by a.kode_daerah,d.nama";

            }else{
                $query2_group_by.=",a.kode_daerah";
            }

            $filter['daerah']=true;
           
        }else{
            if($query2_group_by==""){
                $query2_group_by.=" group by a.kode_daerah,d.nama";

            }else{
                $query2_group_by.=",a.kode_daerah";
            }

        }
        
        if(isset($request->nspk)){
            $query.=" and a.nspk = true ";
            $query2.=" and a.nspk = true ";

            $data_paginate_appends['nspk']=$request->nspk;
            
        }

        if(isset($request->spm)){
            $query.=" and a.spm = true";
            $query2.=" and a.spm = true";

            $data_paginate_appends['spm']=$request->spm;
        }
        
        if(isset($request->pn)){
            $query.=" and a.pn = true";
            $query2.=" and a.pn = true";


            $data_paginate_appends['pn']=$request->pn;
        }

        if(isset($request->kode_urusan)){
            $urusan=($request->kode_urusan);
             $query.=" and a.id_urusan =".$urusan;
             $query2.=" and a.id_urusan =".$urusan;
             $filter['urusan']=true;

             $data_paginate_appends['kode_urusan']=$request->kode_urusan;
        }else{

        }

         if(isset($request->sub_urusan)){
            $query.=" and a.id_sub_urusan =".$request->sub_urusan;

            $query2.=" and a.id_sub_urusan =".$request->sub_urusan;

            $filter['sub_urusan']=true;

            $data_paginate_appends['sub_urusan']=$request->sub_urusan;
        }else{


        }

        if(isset($request->sdgs)){
            $query.=" and a.sdgs = true";
            $query2.=" and a.sdgs = true";

            $data_paginate_appends['sdgs']=$request->sdgs;
        }

        if(isset($request->kode_program)){
            $query.=" and a.kode_program = '".$request->kode_program."'";
            $query2.=" and a.kode_program = '".$request->kode_program."'";

            $data_paginate_appends['kode_program']=$request->kode_program;
        }

        if(isset($request->kode_kegiatan)){
           if(isset($request->kode_kegiatan)){
            $query.=" and a.kode_kegiatan = '".$request->kode_kegiatan."'";

            $query2.=" and a.kode_kegiatan = '".$request->kode_kegiatan."'";

            $data_paginate_appends['kode_kegiatan']=$request->kode_kegiatan;
           }
        }
        $sub_urusans=[];


        if($urusan){
            
             $sub_urusans=DB::table('master_sub_urusan')->where('id_urusan',$urusan)->get();

        }else{
            $program_provinsi=[];
            $sub_urusans=[];

        }

        $urusan=DB::table('master_urusan')->get();

        $daerahs=\App\Provinsi::all();

        $query2=$query2_select.$query2.$query2_group_by;
        $data=DB::select($query2);
        $data=json_encode($data);
        $data=json_decode($data,true);

        return view('all.kegiatan_supd2_chart')->with('datas',$data)->with('daerah',$daerahs)->with('sub_urusans',$sub_urusans)->with('urusans',$urusan);
    }



}


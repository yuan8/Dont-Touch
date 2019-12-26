<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Urusan23;
class NuwasController extends Controller
{
    //



    public function index($tahun=2020){
    	$dt=DB::select("

    		select kode_daerah,sum(anggaran) as jumlah_anggaran,  count(DISTINCT(CONCAT(kode_daerah,kode_kegiatan))) as jumlah_kegiatan ,rank() over(order by sum(anggaran) desc) ranking,a.tahun,
			case when (rank() over(order by sum(anggaran) desc))>20 then '#dd4b39'
			when (rank() over(order by sum(anggaran) desc))<=20 and (rank() over(order by sum(anggaran) desc))> 10 then '#f39c12'
			when (rank() over(order by sum(anggaran) desc))<=10 then '#00a65a' end as color from program_kegiatan_lingkup_supd_2 as a
			 where (tahun=".$tahun." and a.id_urusan = ".(3)." and a.id_sub_urusan = 12) or (tahun=".$tahun." and  uraian_kode_kegiatan_daerah ilike '%(pdam|air)%' ) or (tahun=".$tahun." and  uraian_kode_program_daerah ilike '%(pdam|air)%')
			  group by kode_daerah,tahun order by sum(anggaran) desc

            
        ");

        $dt=($dt);

        return view('nuwas.map')->with('data_provinsi',$dt);

    }


    public function profile_pemda(){

    	// nama pemda
    	// anggaran
    	// apbd
    	// cakupan layanan

    	

    	



    }

  


    public function profile_pdam(){

    	// class pdam
    	// anggaran
    	// apbd
    	// cakupan layanan

    

    }



    public static function query($tahun=2020,$type='semua',$where=[]){


        $where_op='';

        foreach ($where as $key => $value) {
            $where_op.=' and a.'.$key."='".$value."'";
        }


        $add_select='';
        $op=['program','kegiatan','anggaran'];

        switch ($type) {
            case 'nspk':
                $data=\App\Mapper\NSPK::query($tahun,$add_select);  
                array_push($op,'nspk_factor');
            break;

            case 'spm':
                $data=\App\Mapper\SPM::query($tahun,$add_select);   
                array_push($op,'spm_factor');


            
            break;
            case 'pn':
                $data=\App\Mapper\PN::query($tahun,$add_select);    
                array_push($op,'pn_factor');


            
            break;

            case 'sdgs':
                $data=\App\Mapper\SDGS::query($tahun,$add_select);  
                array_push($op,'sdgs_factor');


            
            break;
                
            default:

            $query="
            select 
              ".($add_select!=''?($add_select.','):'')."
            s.nama as nama_sub_urusan,
            count(case when a.sdgs then 1 end ) as jml_sdgs,
            count(case when a.pn then 1 end ) as jml_pn,
            count(case when a.spm then 1 end ) as jml_spm,
            count(case when a.nspk then 1 end ) as jml_nspk,
            sum(a.anggaran) as jml_anggaran,kode_daerah,
            d.nama as nama_daerah,
            a.id_urusan,
            u.nama as nama_urusan,
            a.id_sub_urusan,
            a.kode_program,
            a.tahun,
            uraian_kode_program_daerah,
            count(DISTINCT(kode_program)) as jml_program,
            count(DISTINCT(kode_kegiatan)) as jml_kegiatan 
            from program_kegiatan_lingkup_supd_2 as a
            left join view_daerah as d on d.id= a.kode_daerah
            left join master_urusan as u on u.id= a.id_urusan
            left join master_sub_urusan as s on s.id=a.id_sub_urusan
            where (a.tahun=".$tahun." and a.id_urusan = ".(3)." and a.id_sub_urusan = 12 ".$where_op.") or (a.tahun=".$tahun." and  a.uraian_kode_kegiatan_daerah ilike '%(pdam|air)%' ".$where_op.") or (a.tahun=".$tahun." and  a.uraian_kode_program_daerah ilike '%(pdam|air)%' ".$where_op.") 
            group by kode_daerah,
            a.id_urusan,
            a.id_sub_urusan,
            a.kode_program,
            a.uraian_kode_program_daerah,
            d.nama,
            u.nama,
            s.nama,
            a.tahun ";



            $data=DB::select($query);
            $data=json_encode($data);
            $data=json_decode($data,true);


            array_push($op,'nspk','spm','sdgs','pn');

            break;
        }


        

        return array('op'=>$op,'data'=>$data);


    }

    public static function getChart(Request $request,$tahun=2020){
        $req=[];

        $data=static::query($tahun,'semua',(array)$request->where);

        $data= \App\Mapper\Init::map($data['data'],$request->map,$tahun,$data['op'],$request->type,$request->id_daerah);

        return $data;
    }

      public function program_kegiatan_table($tahun=2020,Request $request){
        $urusan=isset($request->kode_urusan)?$request->kode_urusan:null;

        $data_link=Urusan23::find($urusan);
        $query2_group_by="";
        $filter=array(
            'daerah'=>false,
            'urusan'=>false,
            'sub_urusan'=>false,
        );

        $data_paginate=DB::table('program_kegiatan_lingkup_supd_2');

        $query2="select count(CASE WHEN (ki.indikator != null) THEN 1  END) as jml_indikator, sum(a.anggaran) as jml_anggaran,count(a.id) as jml_kegiatan, count(CASE WHEN a.nspk THEN 1 END) as jml_nspk,count(CASE WHEN a.spm THEN 1 END) as jml_spm,count(CASE WHEN a.pn THEN 1 END) as jml_pn, count(CASE WHEN a.sdgs THEN 1 END) as jml_sdgs,d.nama as label ";

        $query2.=" from program_kegiatan_lingkup_supd_2 as a ";


        $query2.=" left join program_kegiatan_lingkup_supd_2_indikator_provinsi as ki on ki.id_kegiatan_supd_2 = a.id";
        $query2.=" left join master_nomenklatur_provinsi as np on a.kode_program = np.kode";
        $query2.=" left join master_nomenklatur_provinsi as nk on a.kode_kegiatan = nk.kode";
        $query2.=" left join provinsi as d on a.kode_daerah = d.id_provinsi";
        $query2.=" left join master_sub_urusan as s on s.id = a.id_sub_urusan";
        // $query2.=" where a.tahun = ".$tahun;
        $query6=$query2;
        $query2='';
        // $query2.=" and a.tahun = ".$tahun;


        $query="select s.nama as sub_urusan, ki.indikator, ki.target_awal, ki.satuan,ki.target_ahir, d.nama as daerah, a.id as id , a.anggaran, a.nspk,a.spm, a.pn, a.spm, a.sdgs , a.pelaksana as pelaksana,";
        
        // $query.="np.nomenklatur as program , nk.nomenklatur as kegiatan from program_kegiatan_lingkup_supd_2 as a";

        $query.=" a.uraian_kode_program_daerah as program , a.uraian_kode_kegiatan_daerah as kegiatan from program_kegiatan_lingkup_supd_2 as a ";

        $query.=" left join program_kegiatan_lingkup_supd_2_indikator_provinsi as ki on ki.id_kegiatan_supd_2 = a.id";
        // $query.=" left join master_nomenklatur_provinsi as np on a.kode_program = np.kode";
        // $query.=" left join master_nomenklatur_provinsi as nk on a.kode_kegiatan = nk.kode";
        $query.=" left join provinsi as d on a.kode_daerah = d.id_provinsi";
        $query.=" left join master_sub_urusan as s on s.id = a.id_sub_urusan";

        $query5=$query;
        $query='';
        $op_where_q=[];
        $query.="and a.tahun = ".$tahun;

        $data_paginate_appends=[];

        if(isset($request->daerah)){
            $query.=" and a.kode_daerah = '".($request->daerah)."'";
            $query2.=" and a.kode_daerah = '".($request->daerah)."'";
            $op_where_q[]=['kode_daerah','=',$request->daerah];

            // $data_paginate=$data_paginate->where('kode_daerah',$request->daerah);
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

            // $data_paginate=$data_paginate->where('nspk',true);
            $op_where_q[]=['nspk','=',true];
            $data_paginate_appends['nspk']=$request->nspk;
            
        }

        if(isset($request->spm)){
            $query.=" and a.spm = true";
            $query2.=" and a.spm = true";

            // $data_paginate=$data_paginate->where('spm',true);
            $op_where_q[]=['spm','=',true];

            $data_paginate_appends['spm']=$request->spm;
        }
        
        if(isset($request->pn)){
            $query.=" and a.pn = true";
            $query2.=" and a.pn = true";


            // $data_paginate=$data_paginate->where('pn',true);
            $op_where_q[]=['sdgs','=',true];

            $data_paginate_appends['pn']=$request->pn;
        }

        if($urusan!=null){
             $query.=" and a.id_urusan =".$urusan;
             $query2.=" and a.id_urusan =".$urusan;
            $filter['urusan']=true;

             // $data_paginate=$data_paginate->where('id_urusan',$urusan);
            $op_where_q[]=['id_urusan','=',$id_urusan];

             $data_paginate_appends['kode_urusan']=$request->kode_urusan;
        }else{

        }

         if(isset($request->sub_urusan)){
            $query.=" and a.id_sub_urusan =".$request->sub_urusan;

            $query2.=" and a.id_sub_urusan =".$request->sub_urusan;

            $filter['sub_urusan']=true;

            // $data_paginate=$data_paginate->where('id_sub_urusan',$request->sub_urusan);
            $op_where_q[]=['id_sub_urusan','=',$request->sub_urusan];

            $data_paginate_appends['sub_urusan']=$request->sub_urusan;
        }else{


        }

        if(isset($request->sdgs)){
            $query.=" and a.sdgs = true";
            $query2.=" and a.sdgs = true";

            // $data_paginate=$data_paginate->where('sdgs',true);
            $op_where_q[]=['sdgs','=',true];

            $data_paginate_appends['sdgs']=$request->sdgs;
        }

        if(isset($request->kode_program)){
            $query.=" and a.kode_program = '".$request->kode_program."'";
            $query2.=" and a.kode_program = '".$request->kode_program."'";

           // $data_paginate=$data_paginate->where('kode_program',$request->kode_program);
            $op_where_q[]=['kode_program','=',"'".$request->kode_program."'"];

            $data_paginate_appends['kode_program']=$request->kode_program;
        }

        if(isset($request->kode_kegiatan)){
           if(isset($request->kode_kegiatan)){
            $query.=" and a.kode_kegiatan = '".$request->kode_kegiatan."'";

            $query2.=" and a.kode_kegiatan = '".$request->kode_kegiatan."'";
            $op_where_q[]=['kode_program','=',"'".$request->kode_kegiatan."'"];


            // $data_paginate=$data_paginate->where('kode_kegiatan',$request->kode_kegiatan);
            $data_paginate_appends['kode_kegiatan']=$request->kode_kegiatan;
           }
        }

     


        $q_where='';

        $op_where=["a.id_urusan = ".(3)." and a.id_sub_urusan = 12","a.uraian_kode_kegiatan_daerah ilike '%(pdam|air)%'","a.uraian_kode_program_daerah ilike '%(pdam|air)%'"];


        $op_where2=[
            [['id_urusan','=',3],['id_sub_urusan','=',12]],
            [['uraian_kode_kegiatan_daerah','ilike','%(pdam|air)%']],
            [['uraian_kode_program_daerah','ilike','%(pdam|air)%']],
        ];

        for ($qp=0; $qp < 3 ; $qp++) { 

             foreach ($op_where_q as $key => $value) {
               $op_where2[$qp][]=$value;

            }
           
            if($q_where==''){
                $q_where.='where ('.$op_where[$qp].' '.$query.' )';
                $data_paginate=$data_paginate->where($op_where2[$qp]);


            }else{
                 $q_where.=' or ( '.$op_where[$qp].' '.$query.' )';
                $data_paginate=$data_paginate->orWhere($op_where2[$qp]);

            }

            $op=$op_where;
            


           

        }

        // dd($op_where2);



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
        $q_where='';

        $op_where2=[
            [['id_urusan','=',3],['id_sub_urusan','=',12]],
            [['uraian_kode_kegiatan_daerah','ilike','%(pdam|air)%']],
            [['uraian_kode_program_daerah','ilike','%(pdam|air)%']],
        ];


        for ($qp=0; $qp < 3 ; $qp++) { 
           
            if($q_where==''){
                $q_where.='where ('.$op_where[$qp].' '.$query.' ) ';
            }else{
                 $q_where.=' or ( '.$op_where[$qp].' '.$query.' ) ';
            }
            $op=$op_where;

           


        }



        $query=$query5.' '.$q_where;
        $query2=$query6.' '.$q_where;



        $query.=" order by a.id DESC";

        $data_paginate->appends($data_paginate_appends);

        // return $query;

        $data=DB::select($query);
        // $data_chart=DB::select($query2." ".$query2_group_by);
        $data_chart=[];

        // dd($data_chart);

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

     
        if($urusan){
            $program_provinsi=\App\NomenKlaturProvinsi::where('kode','ilike',$data_link->nomenklatur_provinsi.'%')->where('jenis','program')->get();

             $sub_urusans=DB::table('master_sub_urusan')->where('id_urusan',$urusan)->get();

        }else{
            $program_provinsi=[];
            $sub_urusans=[];

        }

        $urusan=DB::table('master_urusan')->get();

        


        $daerahs=\App\Provinsi::all();







        return view('nuwas.pro_keg')->with('id_link',$urusan)->with('data_link',$data_link)
        ->with('datas',$data_return)->with('data_paginate',$data_paginate)->with('program_provinsi',$program_provinsi)->with('daerah',$daerahs)->with('sub_urusans',$sub_urusans)->with('urusans',$urusan)
        ->with('tahun',$tahun)
        ->with('menu_id','1.1');
    }


}

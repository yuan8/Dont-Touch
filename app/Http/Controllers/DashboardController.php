<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
class DashboardController extends Controller
{
    //

    public function landing($tahun=2020){

        $data=DB::select('select count(*) as jml_data from program_kegiatan_lingkup_supd_2 where tahun ='.$tahun);

        $data_pie=json_encode($data);
        $data=json_decode($data_pie,true);

        if(count($data)>0){
            $data=$data[0];
            $data=$data['jml_data'];
        }else{  
            $data=0;
        }



        return view('all.landing')->with('data',$data)->with('menu_id','1.0')->with('tahun',$tahun);
    }

    public function index($tahun=2020){
    	   $query="
            select kode_daerah,d.nama as nama_daerah,id_urusan,u.nama as nama_urusan,id_sub_urusan,kode_program,uraian_kode_program_daerah, count(distinct(kode_program)) as jml_program,count(kode_kegiatan) as jml_kegiatan from 
            program_kegiatan_lingkup_supd_2 as a
            left join view_daerah as d on d.id= a.kode_daerah
            left join master_urusan as u on u.id= a.id_urusan
            group by kode_daerah,id_urusan,id_sub_urusan,uraian_kode_program_daerah,d.nama,u.nama,kode_program
            ";
        $data=DB::select($query);
        $data=json_encode($data);
        $data=json_decode($data,true);

    	$data_return=array(
    		'data'=>[],
    		'count'=>[
    			'daerah'=>[],
    			'urusan'=>[],
    			'program'=>0,
    			'kegiatan'=>0
    		]
    	);
    	
    	foreach($data as $key => $value) {
    		if(!isset($data_return['data'][$value['kode_daerah']])){
    			$data_return['data'][$value['kode_daerah']]=[];
    			$data_return['data'][$value['kode_daerah']]['jumlah_urusan']=0;
    			$data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=0;
    			$data_return['data'][$value['kode_daerah']]['jumlah_program']=0;
    			$data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']=0;
    		}

    		if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']])){
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]=[];
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=0;
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_program']=0;
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_kegiatan']=0;
    		}

    		if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']])){
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]=[];

    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_program']=0;
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_kegiatan']=0;
    		}

    		if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']])){

    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]=[];

    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;

    		}
    		if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['kegiatan'])){
    			
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;
    		}




    		$data_return['data'][$value['kode_daerah']]['nama']=$value['nama_daerah'];

    		
    		$data_return['data'][$value['kode_daerah']]['jumlah_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan']);

    		
    		$data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);



    		
    		$data_return['data'][$value['kode_daerah']]['jumlah_program']+=$value['jml_program'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=+$value['jml_kegiatan'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_program']+=$value['jml_program'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_program']+=$value['jml_program'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    		$data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['nama']='';

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['nama']=$value['uraian_kode_program_daerah'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']+=$value['jml_kegiatan'];




    		array_push($data_return['count']['daerah'],$value['kode_daerah']);
    		array_push($data_return['count']['urusan'],$value['id_urusan']);
    		$data_return['count']['program']+=(int)$value['jml_program'];
    		$data_return['count']['kegiatan']+=(int)$value['jml_kegiatan'];

    	}



    	$data_return['count']['daerah']=array_unique($data_return['count']['daerah']);
    	$data_return['count']['urusan']=array_unique($data_return['count']['urusan']);
    	$data_return['count']['daerah']=count($data_return['count']['daerah']);
    	$data_return['count']['urusan']=count($data_return['count']['urusan']);


    	// pie chart
    	$list_factor=['nspk','spm','pn','sdgs'];
		$results = array(array( ));
		$combination_sql=[];
	    foreach ($list_factor as $element){
	        foreach ($results as $combination){
	            array_push($results, array_merge(array($element), $combination));
	        }
	    }

	    foreach ($results as $key => $value) {
    		$ls=['nspk'=>false,'spm'=>false,'pn'=>false,'sdgs'=>false];
    		$name="tidak_satupun";
    		$n=0;
    		foreach ($value as $i) {
    			$ls[$i]=true;
    			
    			if($name=="tidak_satupun"){
    				$name="hanya_";
    			}

    			if((count($value)-1)!=$n){
    				$name.=$i.'_';
    				$n+=1;
    			}else{
    				$name.=$i;

    			}
    		}

    		$k_n=0;
    		$tk="";

    		


    		foreach ($ls as $k => $l) {
    			if($tk==""){
    				$tk="COUNT( CASE WHEN ";
    			}
    			if((count($ls)-1)!=$k_n){
    				$tk.="(".$k."=".($l?'true':'false').")and";
    				$k_n+=1;
    			}else{

    				$tk.="(".$k."=".($l?'true':'false').") THEN 1 END ) as ".$name." ";

    			}
    		}
    		
    		$combination_sql[]=$tk;

	    }
	    foreach ($list_factor as $key => $value) {
    			$combination_sql[]="COUNT(CASE WHEN ".$value."=true THEN 1 END) as mendukung_".$value;
    		}

	    $select="";

	    foreach ($combination_sql as $key => $value) {
	
	    	if(isset($combination_sql[$key+1])){
	    		$select.=$value.",";
	    	}else{
	    		$select.=$value;

	    	}
	    }

	    $query_pie="select ".$select."  from program_kegiatan_lingkup_supd_2 ";

		$data_pie=DB::select($query_pie);	
		$data_pie=json_encode($data_pie);
    	$data_pie=json_decode($data_pie,true);

    	return view('all.dashboard')
    	->with('data_head',$data_return)
    	->with('data_pie',$data_pie[0])
        ->with('tahun',$tahun)

        ->with('menu_id','2.2');


    }

	public static function query($tahun=2020){

		$query="
    		select s.nama as nama_sub_urusan,count(case when sdgs then 1 end ) as jml_sdgs,count(case when pn then 1 end ) as jml_pn,count(case when spm then 1 end ) as jml_spm,count(case when nspk then 1 end ) as jml_nspk,sum(anggaran) as jml_anggaran,kode_daerah,d.nama as nama_daerah,a.id_urusan,u.nama as nama_urusan,id_sub_urusan,kode_program,uraian_kode_program_daerah, count(DISTINCT(kode_program)) as jml_program,count(*) as jml_kegiatan from 
			program_kegiatan_lingkup_supd_2 as a
			left join view_daerah as d on d.id= a.kode_daerah
			left join master_urusan as u on u.id= a.id_urusan
            left join master_sub_urusan as s on s.id=a.id_sub_urusan
            where a.tahun =
            ".$tahun."
			group by kode_daerah,a.id_urusan,id_sub_urusan,a.kode_program,uraian_kode_program_daerah,d.nama,u.nama,s.nama ";

		$data=DB::select($query);
    	$data=json_encode($data);
    	$data=json_decode($data,true);


    	return $data;

	}

	public function anggaran($tahun=2020){
    	$data=static::query($tahun);


    	$data_return=array(
    		'data'=>[],
    		'count'=>[
    			'daerah'=>[],
    			'urusan'=>[],
    			'program'=>0,
    			'kegiatan'=>0,
    			'anggaran'=>0,

    		]
    	);
    	
    	foreach($data as $key => $value) {
    		if(!isset($data_return['data'][$value['kode_daerah']])){
    			$data_return['data'][$value['kode_daerah']]=[];
    			$data_return['data'][$value['kode_daerah']]['jumlah_urusan']=0;
    			$data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=0;
    			$data_return['data'][$value['kode_daerah']]['jumlah_program']=0;
    			$data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']=0;
    			$data_return['data'][$value['kode_daerah']]['jumlah_anggaran']=0;
    		}

    		if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']])){
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]=[];
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=0;
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_program']=0;
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_kegiatan']=0;
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_anggaran']=0;
    		}

    		if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']])){
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]=[];

    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_program']=0;
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_kegiatan']=0;



    		}

    		if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']])){

    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]=[];

    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;

    		}
    		if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['kegiatan'])){
    			
    			$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;
    		}




    		$data_return['data'][$value['kode_daerah']]['nama']=$value['nama_daerah'];

    		
    		$data_return['data'][$value['kode_daerah']]['jumlah_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan']);

    		
    		$data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);



    		
    		$data_return['data'][$value['kode_daerah']]['jumlah_program']+=$value['jml_program'];
    		$data_return['data'][$value['kode_daerah']]['jumlah_anggaran']+=$value['jml_anggaran'];


    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=+$value['jml_kegiatan'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_program']+=$value['jml_program'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_anggaran']+=$value['jml_anggaran'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_program']+=$value['jml_program'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    		$data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['nama']='';

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['nama']=$value['uraian_kode_program_daerah'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']+=$value['jml_kegiatan'];




    		array_push($data_return['count']['daerah'],$value['kode_daerah']);
    		array_push($data_return['count']['urusan'],$value['id_urusan']);
    		$data_return['count']['program']+=(int)$value['jml_program'];
    		$data_return['count']['kegiatan']+=(int)$value['jml_kegiatan'];
    		$data_return['count']['anggaran']+=(int)$value['jml_anggaran'];

    	}



    	$data_return['count']['daerah']=array_unique($data_return['count']['daerah']);
    	$data_return['count']['urusan']=array_unique($data_return['count']['urusan']);
    	$data_return['count']['daerah']=count($data_return['count']['daerah']);
    	$data_return['count']['urusan']=count($data_return['count']['urusan']);


    	// pie chart
    	$list_factor=['nspk','spm','pn','sdgs'];
		$results = array(array( ));
		$combination_sql=[];
	    foreach ($list_factor as $element){
	        foreach ($results as $combination){
	            array_push($results, array_merge(array($element), $combination));
	        }
	    }

	    $results=[0];
	    foreach ($results as $key => $value) {
    		$ls=['nspk'=>false,'spm'=>false,'pn'=>false,'sdgs'=>false];
    		$name="tidak_satupun";
    		$n=0;
    		// foreach ($value as $i) {
    		// 	$ls[$i]=true;
    			
    		// 	if($name=="tidak_satupun"){
    		// 		$name="hanya_";
    		// 	}

    		// 	if((count($value)-1)!=$n){
    		// 		$name.=$i.'_';
    		// 		$n+=1;
    		// 	}else{
    		// 		$name.=$i;

    		// 	}
    		// }

    		$k_n=0;
    		$tk="";

    		


    		foreach ($ls as $k => $l) {
    			

    			if($tk==""){
    				$tk=" SUM( CASE WHEN ";
    			}
    			if((count($ls)-1)!=$k_n){
    				$tk.="(".$k."=".($l?'true':'false').")and";
    				$k_n+=1;
    			}else{

    				$tk.="(".$k."=".($l?'true':'false').") THEN anggaran END ) as ".$name." ";

    			}
    		}
    		
    		$combination_sql[]=$tk;

	    }
	    foreach ($list_factor as $key => $value) {
    			$combination_sql[]="sum(CASE WHEN ".$value."=true THEN anggaran END) as mendukung_".$value;
    		}

	    $select="";

	    foreach ($combination_sql as $key => $value) {
	
	    	if(isset($combination_sql[$key+1])){
	    		$select.=$value.",";
	    	}else{
	    		$select.=$value;

	    	}
	    }

	    $query_pie="select ".$select."  from program_kegiatan_lingkup_supd_2 ";

		$data_pie=DB::select($query_pie);	
		$data_pie=json_encode($data_pie);
    	$data_pie=json_decode($data_pie,true);

    	return view('all.anggaran')
    	->with('data_head',$data_return)
    	->with('data_pie',$data_pie[0])
        ->with('title','ANGGARAN')
        ->with('tahun',$tahun)
        ->with('menu_id','2.1');    
	}


    public static function generate_json($data){
        $data_return=array(
            'data'=>[],
            'count'=>[
                'daerah'=>[],
                'urusan'=>[],
                'program'=>0,
                'kegiatan'=>0,
                'anggaran'=>0,

            ]
        );
        
        foreach($data as $key => $value) {
            if(!isset($data_return['data'][$value['kode_daerah']])){
                $data_return['data'][$value['kode_daerah']]=[];
                $data_return['data'][$value['kode_daerah']]['jumlah_urusan']=0;
                $data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=0;
                $data_return['data'][$value['kode_daerah']]['jumlah_program']=0;
                $data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']=0;
                $data_return['data'][$value['kode_daerah']]['jumlah_anggaran']=0;
                $data_return['data'][$value['kode_daerah']]['jumlah_nspk']=0;
                $data_return['data'][$value['kode_daerah']]['jumlah_spm']=0;
                $data_return['data'][$value['kode_daerah']]['jumlah_pn']=0;
                $data_return['data'][$value['kode_daerah']]['jumlah_sdgs']=0;
            }


            if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']])){
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]=[];
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_program']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_kegiatan']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_anggaran']=0;

                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_nspk']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_spm']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_pn']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sdgs']=0;
            }

            if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']])){
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]=[];

                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_program']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_kegiatan']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_nspk']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_spm']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_pn']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_sdgs']=0;
            }

            if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']])){

                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]=[];

                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;

                 $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_nspk']=0;
            
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_spm']=0;
                
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_pn']=0;
                
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_sdgs']=0;

            }

            // if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan'])){
                
            //     $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;
            
            // }




            $data_return['data'][$value['kode_daerah']]['nama']=$value['nama_daerah'];
            $data_return['data'][$value['kode_daerah']]['jumlah_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan']);
            $data_return['data'][$value['kode_daerah']]['jumlah_nspk']+=$value['jml_nspk'];
            $data_return['data'][$value['kode_daerah']]['jumlah_spm']+=$value['jml_spm'];
            $data_return['data'][$value['kode_daerah']]['jumlah_pn']+=$value['jml_pn'];
            $data_return['data'][$value['kode_daerah']]['jumlah_sdgs']+=$value['jml_sdgs'];
            $data_return['data'][$value['kode_daerah']]['jumlah_program']+=$value['jml_program'];
            $data_return['data'][$value['kode_daerah']]['jumlah_anggaran']+=$value['jml_anggaran'];
            $data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']+=$value['jml_kegiatan'];


             $data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);

            // urusan


            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);

            

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_program']+=$value['jml_program'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_anggaran']+=$value['jml_anggaran'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_nspk']+=$value['jml_nspk'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_spm']+=$value['jml_spm'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_pn']+=$value['jml_pn'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sdgs']+=$value['jml_sdgs'];

           
            // sub_urusan


            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_program']+=$value['jml_program'];
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_kegiatan']+=$value['jml_kegiatan'];



            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['nama']=$value['nama_sub_urusan'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_nspk']+=$value['jml_nspk'];
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_spm']+=$value['jml_spm'];
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_pn']+=$value['jml_pn'];;
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_sdgs']+=$value['jml_sdgs'];;


            // program

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['nama']=$value['uraian_kode_program_daerah'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_nspk']+=$value['jml_nspk'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_spm']+=$value['jml_spm'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_pn']+=$value['jml_pn'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_sdgs']+=$value['jml_sdgs'];



            array_push($data_return['count']['daerah'],$value['kode_daerah']);
            array_push($data_return['count']['urusan'],$value['id_urusan']);
            $data_return['count']['program']+=(int)$value['jml_program'];
            $data_return['count']['kegiatan']+=(int)$value['jml_kegiatan'];
            $data_return['count']['anggaran']+=(int)$value['jml_anggaran'];

        }



        $data_return['count']['daerah']=array_unique($data_return['count']['daerah']);
        $data_return['count']['urusan']=array_unique($data_return['count']['urusan']);
        $data_return['count']['daerah']=count($data_return['count']['daerah']);
        $data_return['count']['urusan']=count($data_return['count']['urusan']);

        return $data_return;
    }

	public function tagging($tahun=2020){
		$data=static::query($tahun);

	 	 $data_return=static::generate_json($data);

    	return view('all.tagging')
    	->with('data_head',$data_return)
        ->with('tahun',$tahun)
        ->with('menu_id','2.3');

	}


    public function tingkatan($tahun=2020){
        $data=static::query();
        $data_return=static::generate_json($data);

        return view('all.tingkatan')
        ->with('data_head',$data_return)
        ->with('tahun',$tahun)
        ->with('menu_id','2.4');

    }


    public function get_kegitaan($tahun=2020,Request $request){
        $request->request->add(['tahun'=>$tahun]);
        $validator=Validator::make($request->all(),[
            'tahun'=>'required|numeric',
            'id_urusan'=>'required|numeric',
            'id_sub_urusan'=>'required|numeric',
            'kode_daerah'=>'required|string',
            'kode_program'=>'required|string',
        ]);
        
        if($validator->fails()){
            return array('code'=>500,'data'=>[],'message'=>$validator->errors());
        }else{

        }


        $query='select uraian_kode_kegiatan_daerah as nama, count(DISTINCT(kode_kegiatan)) as jml_kegiatan  from program_kegiatan_lingkup_supd_2 where tahun ='.
        $request->tahun." and id_urusan = ".

        $request->id_urusan." and kode_daerah = '".$request->kode_daerah."' and kode_program = '".
        $request->kode_program."' and id_sub_urusan = ".$request->id_sub_urusan."
            GROUP BY kode_kegiatan,id_urusan,kode_daerah,id_sub_urusan,kode_program,kode_kegiatan,uraian_kode_kegiatan_daerah
        ";

    
        $data=DB::select($query);

        return ($data);


    }
}

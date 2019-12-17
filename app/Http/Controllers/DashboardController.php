<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
class DashboardController extends Controller
{
    //


    public static function tahun($tahun){
        if((int) $tahun){
            
        }else{
            if(gettype($tahun)=='string'){
                $tahun=2020;
            }
        }

        return (int) $tahun;

    }
    public function landing($tahun=2020){
        $tahun=static::tahun($tahun);

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
            $tahun=static::tahun($tahun);

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
    		select s.nama as nama_sub_urusan,count(case when sdgs then 1 end ) as jml_sdgs,count(case when pn then 1 end ) as jml_pn,count(case when spm then 1 end ) as jml_spm,count(case when nspk then 1 end ) as jml_nspk,sum(anggaran) as jml_anggaran,kode_daerah,d.nama as nama_daerah,a.id_urusan,u.nama as nama_urusan,id_sub_urusan,kode_program,uraian_kode_program_daerah, count(DISTINCT(kode_program)) as jml_program,count(DISTINCT(kode_kegiatan)) as jml_kegiatan from 
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

    public static function query_nuws($tahun=2020){

        $query="
            select s.nama as nama_sub_urusan,count(case when sdgs then 1 end ) as jml_sdgs,count(case when pn then 1 end ) as jml_pn,count(case when spm then 1 end ) as jml_spm,count(case when nspk then 1 end ) as jml_nspk,sum(anggaran) as jml_anggaran,kode_daerah,d.nama as nama_daerah,a.id_urusan,u.nama as nama_urusan,id_sub_urusan,kode_program,uraian_kode_program_daerah, count(DISTINCT(kode_program)) as jml_program,count(*) as jml_kegiatan from 
            program_kegiatan_lingkup_supd_2 as a
            left join view_daerah as d on d.id= a.kode_daerah
            left join master_urusan as u on u.id= a.id_urusan
            left join master_sub_urusan as s on s.id=a.id_sub_urusan
            where a.tahun =
            ".$tahun." and a.id_urusan = ".(3)." and a.id_sub_urusan = 12
            group by kode_daerah,a.id_urusan,id_sub_urusan,a.kode_program,uraian_kode_program_daerah,d.nama,u.nama,s.nama ";

        $data=DB::select($query);
        $data=json_encode($data);
        $data=json_decode($data,true);


        return $data;

    }



    public static function query_urusan($tahun=2020){

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
        $tahun=static::tahun($tahun);

    	$data=static::query($tahun);


    	// $data_return=array(
    	// 	'data'=>[],
    	// 	'count'=>[
    	// 		'daerah'=>[],
    	// 		'urusan'=>[],
    	// 		'program'=>0,
    	// 		'kegiatan'=>0,
    	// 		'anggaran'=>0,

    	// 	]
    	// );
    	
    	// foreach($data as $key => $value) {
    	// 	if(!isset($data_return['data'][$value['kode_daerah']])){
    	// 		$data_return['data'][$value['kode_daerah']]=[];
    	// 		$data_return['data'][$value['kode_daerah']]['jumlah_urusan']=0;
    	// 		$data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=0;
    	// 		$data_return['data'][$value['kode_daerah']]['jumlah_program']=0;
    	// 		$data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']=0;
    	// 		$data_return['data'][$value['kode_daerah']]['jumlah_anggaran']=0;
    	// 	}

    	// 	if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']])){
    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]=[];
    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=0;
    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_program']=0;
    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_kegiatan']=0;
    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_anggaran']=0;
    	// 	}

    	// 	if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']])){
    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]=[];

    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_program']=0;
    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_kegiatan']=0;



    	// 	}

    	// 	if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']])){

    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]=[];

    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;

    	// 	}
    	// 	if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['kegiatan'])){
    			
    	// 		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;
    	// 	}




    	// 	$data_return['data'][$value['kode_daerah']]['nama']=$value['nama_daerah'];

    		
    	// 	$data_return['data'][$value['kode_daerah']]['jumlah_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan']);

    		
    	// 	$data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);

    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);



    		
    	// 	$data_return['data'][$value['kode_daerah']]['jumlah_program']+=$value['jml_program'];
    	// 	$data_return['data'][$value['kode_daerah']]['jumlah_anggaran']+=$value['jml_anggaran'];


    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=+$value['jml_kegiatan'];

    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_program']+=$value['jml_program'];
    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_anggaran']+=$value['jml_anggaran'];

    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_program']+=$value['jml_program'];
    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    	// 	$data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['nama']='';

    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['nama']=$value['uraian_kode_program_daerah'];

    	// 	$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']+=$value['jml_kegiatan'];




    	// 	array_push($data_return['count']['daerah'],$value['kode_daerah']);
    	// 	array_push($data_return['count']['urusan'],$value['id_urusan']);
    	// 	$data_return['count']['program']+=(int)$value['jml_program'];
    	// 	$data_return['count']['kegiatan']+=(int)$value['jml_kegiatan'];
    	// 	$data_return['count']['anggaran']+=(int)$value['jml_anggaran'];

    	// }



    	// $data_return['count']['daerah']=array_unique($data_return['count']['daerah']);
    	// $data_return['count']['urusan']=array_unique($data_return['count']['urusan']);
    	// $data_return['count']['daerah']=count($data_return['count']['daerah']);
    	// $data_return['count']['urusan']=count($data_return['count']['urusan']);

        $data_return=static::generate_json($data);

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
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_anggaran']=0;
            }

            if(!isset($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']])){

                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]=[];

                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=0;

                 $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_nspk']=0;
            
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_spm']=0;
                
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_pn']=0;
                
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_sdgs']=0;
                $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_anggaran']=0;

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
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_pn']+=$value['jml_pn'];
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_sdgs']+=$value['jml_sdgs'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['jumlah_anggaran']+=$value['jml_anggaran'];


            // program

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['nama']=$value['uraian_kode_program_daerah'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_nspk']+=$value['jml_nspk'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_spm']+=$value['jml_spm'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_pn']+=$value['jml_pn'];
            
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_sdgs']+=$value['jml_sdgs'];
            $data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_anggaran']+=$value['jml_anggaran'];


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
        $tahun=static::tahun($tahun);

		$data=static::query($tahun);

	 	 $data_return=static::generate_json($data);

    	return view('all.tagging')
    	->with('data_head',$data_return)
        ->with('tahun',$tahun)
        ->with('menu_id','2.3');

	}


    public function tingkatan($tahun=2020){
        $tahun=static::tahun($tahun);

        $data=static::query($tahun);
        $data_return=static::generate_json($data);

        return view('all.tingkatan')
        ->with('data_head',$data_return)
        ->with('tahun',$tahun)
        ->with('menu_id','2.4');

    }


    public function get_kegiatan($tahun=2020,Request $request){
        $tahun=static::tahun($tahun);
        $request->request->add(['tahun'=>$tahun]);
        $validator=Validator::make($request->all(),[
            'tahun'=>'required|numeric',
            'id_urusan'=>'required|numeric',
            'id_sub_urusan'=>'nullable|numeric',
            'kode_daerah'=>'required|string',
            'kode_program'=>'required|string',
            'id_nspk'=>'nullable|numeric',
            'id_spm'=>'nullable|numeric',
            'id_pn3'=>'nullable|numeric',
            'id_sdgs'=>'nullable|numeric',




        ]);

        if($validator->fails()){

            return array('code'=>500,'data'=>[],'message'=>$validator->errors());

        }else{

        }

        $where='';
        foreach ($request->except('token') as $key => $value) {
                
                $value=(in_array($key,['kode_daerah','kode_program']))?("'".$value."'"):$value;
                $value=(in_array($key,['nspk','spm','pn','sdgs']))?((boolean)$value):$value;
                $value=(in_array($key,['id_urusan','id_sub_urusan','id_nspk','id_spm','id_sdgs','id_pn3']))?((int)$value):$value;



                if($where==''){
                    $where.=' where a.'.$key.'='.$value;
                }else{
                    $where.=' and a.'.$key.'='.$value;
                }
        }

             
        $query='select a.kode_kegiatan,b.indikator,(case when b.target_awal = null then 0 end) as target_awal,b.target_ahir,b.satuan, a.uraian_kode_kegiatan_daerah as nama, count(DISTINCT(a.kode_kegiatan)) as jml_kegiatan  from program_kegiatan_lingkup_supd_2 as a 

            left join program_kegiatan_lingkup_supd_2_indikator_provinsi as b on  b.id_kegiatan_supd_2 = a.id 
            
            '.$where."
            
            GROUP BY a.kode_kegiatan,a.id_urusan,a.kode_daerah,a.id_sub_urusan,a.kode_program,a.kode_kegiatan,
            a.uraian_kode_kegiatan_daerah,b.indikator,b.target_awal,b.target_ahir,b.satuan
        ";


        $data=DB::select($query);
        $data=json_encode($data);
        $data=json_decode($data,true);

        $data_return=[];
        foreach($data as $d)
        {
            if(!isset($data_return[('k'.$d['kode_kegiatan'])])){

                $data_return[('k'.$d['kode_kegiatan'])]['nama']=$d['nama'];
                $data_return[('k'.$d['kode_kegiatan'])]['indikator']=[];
            }

            if(($d['indikator']!='')and($d['indikator']!=null)){
                $data_return[('k'.$d['kode_kegiatan'])]['indikator'][]=array(
                    'indikator'=>$d['indikator'],
                    'target_awal'=>$d['target_awal']." ".$d['satuan'],
                    'target_ahir'=>$d['target_ahir']." ".$d['satuan'],
                );
            }


        }



        return ($data_return);


    }


    public function tingkatan_urusan($tahun=2020){
        $tahun=static::tahun($tahun);

        $data=static::query($tahun);

        $data_return=static::generate_json_urusan($data);

        return view('all.profile_urusan')
        ->with('data_head',$data_return)
        ->with('tahun',$tahun)
        ->with('menu_id','2.5');

    }


    public static function generate_json_urusan($data){
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

        foreach ($data as $key => $d) {
            if(!isset($data_return['data'][$d['id_urusan']])){
                $data_return['data'][$d['id_urusan']]['nama']=$d['nama_urusan'];
                $data_return['data'][$d['id_urusan']]['jumlah_sdgs']=0;
                $data_return['data'][$d['id_urusan']]['jumlah_pn']=0;
                $data_return['data'][$d['id_urusan']]['jumlah_nspk']=0;
                $data_return['data'][$d['id_urusan']]['jumlah_spm']=0;
                $data_return['data'][$d['id_urusan']]['jumlah_program']=0;
                $data_return['data'][$d['id_urusan']]['jumlah_kegiatan']=0;
                $data_return['data'][$d['id_urusan']]['jumlah_anggaran']=0;

                $data_return['data'][$d['id_urusan']]['daerah']=[];

            }

             if(!isset($data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']])){

                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_spm']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_nspk']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_sdgs']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_pn']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_kegiatan']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_program']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_anggaran']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['nama']=$d['nama_daerah'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program']=[];


            }

            if(!isset($data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']])){

                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_spm']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_nspk']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_sdgs']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_pn']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_kegiatan']=0;
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['nama']=$d['uraian_kode_program_daerah'];

                 $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_anggaran']=0;

            }

                $data_return['data'][$d['id_urusan']]['jumlah_sdgs']+=$d['jml_sdgs'];
                $data_return['data'][$d['id_urusan']]['jumlah_nspk']+=$d['jml_nspk'];
                $data_return['data'][$d['id_urusan']]['jumlah_spm']+=$d['jml_spm'];
                $data_return['data'][$d['id_urusan']]['jumlah_pn']+=$d['jml_pn'];
                $data_return['data'][$d['id_urusan']]['jumlah_program']+=$d['jml_program'];
                $data_return['data'][$d['id_urusan']]['jumlah_kegiatan']+=$d['jml_kegiatan'];
                $data_return['data'][$d['id_urusan']]['jumlah_anggaran']+=$d['jml_anggaran'];




                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_spm']+=$d['jml_spm'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_nspk']+=$d['jml_nspk'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_sdgs']+=$d['jml_sdgs'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_pn']+=$d['jml_pn'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_kegiatan']+=$d['jml_kegiatan'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_program']+=$d['jml_program'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_anggaran']+=$d['jml_anggaran'];



                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_kegiatan']+=$d['jml_kegiatan'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_nspk']+=$d['jml_nspk'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_spm']+=$d['jml_spm'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_sdgs']+=$d['jml_sdgs'];
                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_pn']+=$d['jml_pn'];

                $data_return['data'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_anggaran']+=$d['jml_anggaran'];


        }

        return $data_return;
    }


    public function nuws($tahun=2020){


        $tahun=static::tahun($tahun);

        $data=static::query_nuws($tahun);

        $data_return=static::generate_json($data);

        return view('all.nuws')
        ->with('data_head',$data_return)
        ->with('tahun',$tahun)
        ->with('title','NUWAS')
        ->with('menu_id','2.4');


    }



    public function pendukung($tahun=2020){

        $tahun=static::tahun($tahun);

        $query="
            select s.nama as nama_sub_urusan,count(case when sdgs then 1 end ) as jml_sdgs,count(case when pn then 1 end ) as jml_pn,count(case when spm then 1 end ) as jml_spm,count(case when nspk then 1 end ) as jml_nspk,sum(anggaran) as jml_anggaran,kode_daerah,d.nama as nama_daerah,a.id_urusan,u.nama as nama_urusan,id_sub_urusan,kode_program,uraian_kode_program_daerah, count(DISTINCT(kode_program)) as jml_program,count(*) as jml_kegiatan from 
            program_kegiatan_lingkup_supd_2 as a
            left join view_daerah as d on d.id= a.kode_daerah
            left join master_urusan as u on u.id= a.id_urusan
            left join master_sub_urusan as s on s.id=a.id_sub_urusan
            where (a.tahun =".$tahun." and a.nspk =true) or (a.tahun =".$tahun." and a.spm =true) and (a.tahun =".$tahun." and a.pn =true) and (a.tahun =".$tahun." and a.sdgs =true)
            group by kode_daerah,a.id_urusan,id_sub_urusan,a.kode_program,uraian_kode_program_daerah,d.nama,u.nama,s.nama";

        $data=DB::select($query);
        $data=json_encode($data);
        $data=json_decode($data,true);

        $data_return=[];

        foreach ($data as $key => $d) {
            
            $var_loop=['nspk','spm','pn','sdgs'];

            foreach ($var_loop as  $f) {
                if($d['jml_'.$f]>0){
                    if(!isset($data_return['data'][$f])){
                        $data_return['data'][$f]['nama']=strtoupper($f);
                        $data_return['data'][$f]['jumlah_'.$f]=0;
                        $data_return['data'][$f]['jumlah_program']=0;
                        $data_return['data'][$f]['jumlah_kegiatan']=0;
                        $data_return['data'][$f]['jumlah_anggaran']=0;

                    }

                    if(!isset($data_return['data'][$f]['urusan'][$d['id_urusan']])){
                           $data_return['data'][$f]['urusan'][$d['id_urusan']]['nama']=$d['nama_urusan'];
                           $data_return['data'][$f]['urusan'][$d['id_urusan']]['jumlah_'.$f]=0;
                           $data_return['data'][$f]['urusan'][$d['id_urusan']]['jumlah_program']=0;
                           $data_return['data'][$f]['urusan'][$d['id_urusan']]['jumlah_kegiatan']=0;
                           $data_return['data'][$f]['urusan'][$d['id_urusan']]['jumlah_anggaran']=0;

                    }

                    if(!isset($data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']])){
                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['nama']=$d['nama_daerah'];
                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_'.$f]=0;
                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_program']=0;
                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_kegiatan']=0;
                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_anggaran']=0;

                    }

                    if(!isset($data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']])){
                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['nama']=$d['uraian_kode_program_daerah'];
                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_'.$f]=0;
                        
                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_kegiatan']=0;

                        $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_anggaran']=0;
                    }



                    $data_return['data'][$f]['jumlah_'.$f]+=$d['jml_'.$f];
                    $data_return['data'][$f]['jumlah_program']+=$d['jml_program'];
                    $data_return['data'][$f]['jumlah_kegiatan']+=$d['jml_kegiatan'];
                    $data_return['data'][$f]['jumlah_anggaran']+=$d['jml_anggaran'];


                    $data_return['data'][$f]['urusan'][$d['id_urusan']]['jumlah_'.$f]+=$d['jml_'.$f];
                    $data_return['data'][$f]['urusan'][$d['id_urusan']]['jumlah_program']+=$d['jml_program'];
                    $data_return['data'][$f]['urusan'][$d['id_urusan']]['jumlah_kegiatan']+=$d['jml_kegiatan'];
                    $data_return['data'][$f]['urusan'][$d['id_urusan']]['jumlah_anggaran']+=$d['jml_anggaran'];


                    $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_program']+=$d['jml_program'];

                    $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_anggaran']+=$d['jml_anggaran'];

                    $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_kegiatan']+=$d['jml_kegiatan'];
                    $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['jumlah_'.$f]+=$d['jml_'.$f];

                     $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_kegiatan']+=$d['jml_kegiatan'];

                     $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_'.$f]+=$d['jml_'.$f];

                      $data_return['data'][$f]['urusan'][$d['id_urusan']]['daerah'][$d['kode_daerah']]['program'][$d['kode_program']]['jumlah_anggaran']+=$d['jml_anggaran'];



                    
                }
            }


        }




        return view('all.pendukung')
        ->with('data_head',$data_return)
        ->with('tahun',$tahun)
        ->with('title','Kegiatan Pendukung')
        ->with('menu_id','2.6');


    }


    public function get_kegiatan_tagging($tahun=2020,Request $request){

        $tahun=static::tahun($tahun);
        $request->request->add(['tahun'=>$tahun]);
        
        $validator=Validator::make($request->all(),[
            'tahun'=>'required|numeric',
            'id_urusan'=>'required|numeric',
            'id_sub_urusan'=>'nullable|numeric',
            'kode_daerah'=>'required|string',
            'kode_program'=>'required|string',
            'id_nspk'=>'nullable|numeric',
            'id_spm'=>'nullable|numeric',
            'id_pn3'=>'nullable|numeric',
            'id_sdgs'=>'nullable|numeric',
        ]);

        if($validator->fails()){

            return array('code'=>500,'data'=>[],'message'=>$validator->errors());

        }else{

        }

        $where='';
        foreach ($request->except('token') as $key => $value) {
                
                $value=(in_array($key,['kode_daerah','kode_program']))?("'".$value."'"):$value;
                $value=(in_array($key,['nspk','spm','pn','sdgs']))?($value?'true':'false'):$value;
                $value=(in_array($key,['id_urusan','id_sub_urusan','id_nspk','id_spm','id_sdgs','id_pn3']))?((int)$value):$value;

                if($where==''){
                    $where.=' where a.'.$key.'='.$value;
                }else{
                    $where.=' and a.'.$key.'='.$value;
                }
        }


    

             
        $query='select a.kode_kegiatan,b.indikator,(case when b.target_awal = null then 0 end) as target_awal,b.target_ahir,b.satuan, a.uraian_kode_kegiatan_daerah as nama, count(DISTINCT(a.kode_kegiatan)) as jml_kegiatan,a.nspk,a.spm,a.sdgs,a.pn,a.kode_program  from program_kegiatan_lingkup_supd_2 as a left join program_kegiatan_lingkup_supd_2_indikator_provinsi as b on  b.id_kegiatan_supd_2 = a.id '.$where."
            GROUP BY a.kode_kegiatan,a.id_urusan,a.kode_daerah,a.id_sub_urusan,a.kode_program,a.kode_kegiatan,a.uraian_kode_kegiatan_daerah,b.indikator,b.target_awal,b.target_ahir,b.satuan,a.nspk,a.spm,a.pn,a.sdgs,a.kode_program
        ";

        $data=DB::select($query);
        $data=json_encode($data);
        $data=json_decode($data,true);


        $data_return=[];
        foreach($data as $d)
        {
            if(!isset($data_return[('k'.$d['kode_kegiatan'])])){
                $data_return[('k'.$d['kode_kegiatan'])]['nama']=$d['nama'];
                $data_return[('k'.$d['kode_kegiatan'])]['indikator']=[];
            }

                $data_return[('k'.$d['kode_kegiatan'])]['nspk']=$d['nspk'];
                $data_return[('k'.$d['kode_kegiatan'])]['spm']=$d['spm'];
                $data_return[('k'.$d['kode_kegiatan'])]['pn']=$d['pn'];
                $data_return[('k'.$d['kode_kegiatan'])]['sdgs']=$d['sdgs'];

            if(($d['indikator']!='')and($d['indikator']!=null)){
                $data_return[('k'.$d['kode_kegiatan'])]['indikator'][]=array(
                    'indikator'=>$d['indikator'],
                    'target_awal'=>$d['target_awal']." ".$d['satuan'],
                    'target_ahir'=>$d['target_ahir']." ".$d['satuan'],
                );

               

            }


        }



        return ($data_return);



    }



    public function kegiatan_pendukung_nspk($tahun=2020){

        $data=\App\Mapper\NSPK::query();
        $data=\App\Mapper\NSPK::map($data);

        // $data=DB::select('select * from program_kegiatan_lingkup_supd_2 where nspk = true ');

        return $data;


    }

     public function kegiatan_pendukung_spm($tahun=2020){

        $data=\App\Mapper\SPM::query($tahun);
        $data=\App\Mapper\SPM::map($data);

        // $data=DB::select('select * from program_kegiatan_lingkup_supd_2 where nspk = true ');

        return $data;


    }
     public function kegiatan_pendukung_pn($tahun=2020){

        $data=\App\Mapper\PN::query($tahun);
        $data=\App\Mapper\PN::map($data);

        // $data=DB::select('select * from program_kegiatan_lingkup_supd_2 where nspk = true ');

        return $data;


    }
     public function kegiatan_pendukung_sdgs($tahun=2020){

        $data=\App\Mapper\SDGS::query($tahun);
        $data=\App\Mapper\SDGS::map($data);

        // $data=DB::select('select * from program_kegiatan_lingkup_supd_2 where nspk = true ');

        return $data;


    }

    public function k_pendukung($tahun=2020){

        $data_head=[];
        return view('all.kegiatan_pendukung')->with('tahun',$tahun);

    }

}


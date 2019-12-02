<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DahboardController extends Controller
{
    //

    public function index(){
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
    	->with('data_pie',$data_pie[0]);

    }

    public static function pc_permute($items, $perms = array( )) {
    	$var_return=[];

	    if (empty($items)) { 
	        print join(' ', $perms) . "\n";
	    }  else {
	        for ($i = count($items) - 1; $i >= 0; --$i) {
	             $newitems = $items;
	             $newperms = $perms;
	             list($foo) = array_splice($newitems, $i, 1);
	             array_unshift($newperms, $foo);
	             static::pc_permute($newitems, $newperms);
	         }
	    }
	}


	public static function query(){
		$query="
    		select count(case when sdgs then 1 end ) as jml_sdgs,count(case when pn then 1 end ) as jml_pn,count(case when spm then 1 end ) as jml_spm,count(case when nspk then 1 end ) as jml_nspk,sum(anggaran) as jml_anggaran,kode_daerah,d.nama as nama_daerah,id_urusan,u.nama as nama_urusan,id_sub_urusan,kode_program,uraian_kode_program_daerah, count(distinct(kode_program)) as jml_program,count(kode_kegiatan) as jml_kegiatan from 
			program_kegiatan_lingkup_supd_2 as a
			left join view_daerah as d on d.id= a.kode_daerah
			left join master_urusan as u on u.id= a.id_urusan
			group by kode_daerah,id_urusan,id_sub_urusan,uraian_kode_program_daerah,d.nama,u.nama,kode_program,anggaran 
			";

		$data=DB::select($query);
    	$data=json_encode($data);
    	$data=json_decode($data,true);

    	return $data;

	}

	public function anggaran(){
    	$query="
    		select count(case when sdgs then 1 end ) as jml_sdgs,count(case when pn then 1 end ) as jml_pn,count(case when spm then 1 end ) as jml_spm,count(case when nspk then 1 end ) as jml_nspk,sum(anggaran) as jml_anggaran,kode_daerah,d.nama as nama_daerah,id_urusan,u.nama as nama_urusan,id_sub_urusan,kode_program,uraian_kode_program_daerah, count(distinct(kode_program)) as jml_program,count(kode_kegiatan) as jml_kegiatan from 
			program_kegiatan_lingkup_supd_2 as a
			left join view_daerah as d on d.id= a.kode_daerah
			left join master_urusan as u on u.id= a.id_urusan
			group by kode_daerah,id_urusan,id_sub_urusan,uraian_kode_program_daerah,d.nama,u.nama,kode_program,anggaran 
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
    	->with('data_pie',$data_pie[0]);

    
	}


	public function tagging(){
		$data=static::query();

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
    		$data_return['data'][$value['kode_daerah']]['jumlah_nspk']+=$value['jml_nspk'];
			$data_return['data'][$value['kode_daerah']]['jumlah_spm']+=$value['jml_spm'];
			$data_return['data'][$value['kode_daerah']]['jumlah_pn']+=$value['jml_pn'];
			$data_return['data'][$value['kode_daerah']]['jumlah_sdgs']+=$value['jml_sdgs'];


            // urusan

    		
    		$data_return['data'][$value['kode_daerah']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['jumlah_sub_urusan']=count($data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan']);

    		$data_return['data'][$value['kode_daerah']]['jumlah_program']+=$value['jml_program'];
    		$data_return['data'][$value['kode_daerah']]['jumlah_anggaran']+=$value['jml_anggaran'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['program'][$value['kode_program']]['jumlah_kegiatan']=+$value['jml_kegiatan'];

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


    		$data_return['data'][$value['kode_daerah']]['jumlah_kegiatan']+=$value['jml_kegiatan'];

    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['nama']=$value['nama_urusan'];
    		$data_return['data'][$value['kode_daerah']]['urusan'][$value['id_urusan']]['sub_urusan'][$value['id_sub_urusan']]['nama']='';


            // program

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

    	return view('all.tagging')
    	->with('data_head',$data_return);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DynamicNested extends Controller
{
    //


    public static function create_factor(){
    	$list_factor=['nspk','spm','pn','sdgs'];
		$results = array(array( ));
		$combination_sql=[];

	    foreach ($list_factor as $element){
	        foreach ($results as $combination){
	            array_push($results, array_merge(array($element), $combination));
	        }
	    }

	    foreach ($results as $key => $value) {
	    	sort($value);
	    	$results2[$key]=$value;
	    }


	    foreach ($results as $key => $value) {
    		$ls=['nspk'=>false,'spm'=>false,'pn'=>false,'sdgs'=>false];
    		$name="kegiatan_pendukung";
    		$n=0;
    		foreach ($value as $i) {
    			$ls[$i]=true;
    			
    			if($name=="kegiatan_pendukung"){
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
    				$tk.="(a.".$k."=".($l?'true':'false').")and";
    				$k_n+=1;
    			}else{

    				$tk.="(a.".$k."=".($l?'true':'false').") THEN 1 END ) as ".$name." ";

    			}
    		}
    		
    		$combination_sql[]=$tk;

	    }
	    foreach ($list_factor as $key => $value) {
    			$combination_sql[]="COUNT(CASE WHEN a.".$value."=true THEN 1 END) as mendukung_".$value;
    		}

	    $select="";

	    foreach ($combination_sql as $key => $value) {
	
	    	if(isset($combination_sql[$key+1])){
	    		$select.=$value.",";
	    	}else{
	    		$select.=$value;

	    	}
	    }

	    return $select;
    }

	public static function query($tahun=2020,$type='semua'){
		$add_select=(static::create_factor());
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
            where a.tahun =
            ".$tahun."
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



			array_push($op,'nspk','spm','sdgs','pn','semua_factor');

			break;
		}


    

    	return array('op'=>$op,'data'=>$data);


	}

    public function createData(Request $request,$tahun=2020){
    	$req=[];

    	foreach ($request->data as $key => $value) {
    		$req[]=explode('|', ($value['value']));
    	}

    	$data=static::query($tahun,$request->type);

    	return \App\Mapper\Init::map($data['data'],$req,$tahun,$data['op'],$request->type);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class MapCtrl extends Controller
{
    //


    public static function queryBuild($data,$tag,$w,$wor=null,$map)
    {

    	$prefix='a.';

    	$list_tranlate=[
    		'nama_program'=>[
    			'select'=>'uraian_kode_program_daerah as nama_program',
    			'group'=>$prefix.'kode_program'
    		],
    		'nama_kegiatan'=>[
    			'select'=>'uraian_kode_kegiatan_daerah as nama_kegiatan',
    			'group'=>$prefix.'kode_kegiatan'
    		],
    		'jumlah_kegiatan'=>[
    			'select'=>'count(DITINCT(CONCAT('.$prefix.'kode_daerah,'.$prefix.'kode_kegiatan))) as jml_kegiatan',
    			'group'=>'kode_kegiatan'
    		],
    		'nama_daerah'=>[
    			'select'=>'daerah.name as nama_daerah',
    			'group'=>$prefix.'kode_daerah'
    		],
    		'nama_bidang'=>[
    			'select'=>'urusan.nama as nama_urusan',
    			'group'=>'urusan.id'
    		],
    		'nama_sub_urusan'=>[
    			'select'=>'sub_urusan.nama as nama_sub_urusan',
    			'group'=>'sub_urusan.id'
    		]
    		,
    		'jumlah_nspk'=>[
    			'select'=>'count(when a.id_nspk is not null then 1 end) as jumlah_nspk',
    			'group'=>''
    		],
    		'taging'=>[
    			'select'=>$prefix.'nspk,'.$prefix.'sdgs,'.$prefix.'pn,'.$prefix.'spm',
    			'group'=>''
    		],
    	];

    	$where=[];

    	// foreach ($w_prefix as $key => $value) {
    	// 	if($where==''){
    	// 		$where.' '.$prefix.$value[0].' '.$value[1].' '.$value[2];
    	// 	}else{
    	// 		$where.' and '.$prefix.$value[0].' '.$value[1].' '.$value[2];
    	// 	}
    	// }

    	foreach ($w as $key => $value) {
    		if(true){
    			if(count($where)==0){
    				$where[]=' where '.$prefix.$value[0].' '.$value[1].' '.$value[2];
    			}else{
    				$where[]=$prefix.$value[0].' '.$value[1].' '.$value[2];

    			}
    		}
    	}

    	$select='';
    	$group=[];
    	$join=[];

    	foreach ($data as $key => $value) {
    		if(count(array_intersect($data,['nama_daerah']))>0){
    			$join[]='left join view_daerah as daerah on '.$prefix.'kode_daerah = daerah.id';
    		}
    	}

    	foreach ($data as $key => $value) {
    		if($select==''){
    				if(strpos( $list_tranlate[$value]['select'], '.' ) !== false){
    					$select.=$list_tranlate[$value]['select'];
    				}else{
    					$select.=$prefix.$list_tranlate[$value]['select'];
    				}

    		}else{
    			if(strpos( $list_tranlate[$value]['select'], '.' ) !== false){
					$select.=' , '.$list_tranlate[$value]['select'];
				}else{
					$select.=' , '.$prefix.$list_tranlate[$value]['select'];
				}
    		}

    		if($list_tranlate[$value]['group']!=''){

	    		if(count($group)<=0){
	    			$group[]='group by '.$list_tranlate[$value]['group'];	
	    		}else{
	    			$group[]=$list_tranlate[$value]['group'];	
	    			
	    		}
    		}	

    	}

    	$table='program_kegiatan_lingkup_supd_2 as a';

    	$query='select '.$select.' from '.$table.' '.implode(' ',$join).' '.implode(' and ',$where).' '.implode(',',$group);
    	dd($query);


    	$data=DB::select($query);

    	dd($data);

    }
}

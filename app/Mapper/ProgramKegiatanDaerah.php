<?php

namespace App\Mapper;

use Illuminate\Database\Eloquent\Model;
use DB;
class ProgramKegiatanDaerah extends Model
{
    //
    public static function query($tahun=2020){
		$data=DB::select(
			
            "select 
            s.nama as nama_sub_urusan,
            count(case when a.sdgs then 1 end ) as jml_sdgs,
            count(case when a.pn then 1 end ) as jml_pn,
            count(case when a.spm then 1 end ) as jml_spm,
            count(case when a.nspk then 1 end ) as jml_nspk,
            sum(a.anggaran) as jml_anggaran,
            a.kode_daerah,
            d.nama as nama_daerah,
            a.id_urusan,
            u.nama as nama_urusan,
            a.id_sub_urusan,
            kode_program,
            a.tahun,
            uraian_kode_program_daerah,
            count(DISTINCT(kode_program)) as jml_program,
            count(DISTINCT(CONCAT(a.kode_daerah,a.kode_kegiatan))) as jml_kegiatan 

            from program_kegiatan_lingkup_supd_2 as a
            left join view_daerah as d on d.id= a.kode_daerah
            left join master_urusan as u on u.id= a.id_urusan
            left join master_sub_urusan as s on s.id=a.id_sub_urusan

            where a.tahun =
            ".$tahun. " 
            
            group by kode_daerah,a.id_urusan,a.id_sub_urusan,a.kode_program,uraian_kode_program_daerah,d.nama,u.nama,s.nama,a.tahun  "
		);

            $data=json_encode($data);
    	$data=json_decode($data,true);

    	return $data;
		

	}



	static function findKey($array, $keySearch)
	{
	    foreach ($array as $key => $item) {
	        if ($key == $keySearch) {
	            echo 'yes, it exists';
	            return true;
	        } elseif (is_array($item) && findKey($item, $keySearch)) {
	            return true;
	        }
	    }
	    return false;
	}

	public static function map($data){
	
		$data_return=array();

		$list_map_key=[
			['Bidang','bidang','DB_id_urusan'],
			['Sub Bidang','bidang','DB_id_urusan','sub_bidang','DB_id_sub_urusan'],

		];

		dd(\App\Mapper\Init::map($data,$list_map_key));

		foreach ($data as $kp => $v) {
			
			$list_map_key=[
			  ['0','bidang',null],
			  ['0','bidang',$v['id_urusan'],['DB_nama'=>'nama_urusan','type'=>'Bidang']],
			  ['0','bidang',$v['id_urusan'],'sub_urusan',$v['id_sub_urusan'],['DB_nama'=>'nama_sub_urusan','type'=>'Sub Urusan']],
			  ['0','bidang',$v['id_urusan'],'sub_urusan',$v['id_sub_urusan'],'program',$v['kode_program'],['DB_nama'=>'uraian_kode_program_daerah','type'=>'Program']],

			];



			foreach ($list_map_key as $k => $array) {
					$key='';
					
					$array1=array_slice($array, 0,-1);
					$option=array_slice($array, -1,1);


					foreach ($array1 as $l => $lp) {
						if(isset($array1[($l+1)])){
							$key.=$lp."|";
						}else{
							$key.=$lp;
						}
					}

					if(!isset($data_return[$key])){
						$data_return[$key]=[
							'jumlah_program'=>0,
							'jumlah_kegiatan'=>0,
							'jumlah_anggaran'=>0,
						];

						if((isset($option[0]))&& (($option[0])!=null) ){

							if(isset($option[0]['type'])){
								if(($option[0]['type']=='Program')||($option[0]['type']=='program')){
									$data_return[$key]['where']=array(
										'id_urusan'=>$v['id_urusan'],
										'id_sub_urusan'=>$v['id_sub_urusan'],
										'kode_daerah'=>$v['kode_daerah'],
										'kode_program'=>$v['kode_program'],
										'tahun'=>$v['tahun'],
									);
								}
							}


							foreach ($option[0] as $ko => $vo) {
								if((strpos($ko, 'DB_') !== false)){
									$data_return[$key][str_replace('DB_','',$ko)]=$v[$vo];
								}else{
									$data_return[$key][$ko]=$vo;

								}
							}
						}
					}

					$data_return[$key]['jumlah_program']+=$v['jml_program'];
					$data_return[$key]['jumlah_kegiatan']+=$v['jml_kegiatan'];	
					$data_return[$key]['jumlah_anggaran']+=$v['jml_anggaran'];	



			}




		}

		$keys = array_map('strlen', array_keys($data_return));
		array_multisort($keys, SORT_DESC, $data_return);

		$data_returntmp=$data_return;
		// dd($data_return);

		$iloop=0;
		foreach ($data_returntmp as $key => $value) {
			$input=explode('|',$key);
			
			
			if((count($input) - 1)>1){
				$m=array_slice($input, 0,-2);
				$d=array_slice($input, -2, 2);
				$key_them=implode('|',$m);
				
				if(!isset($data_return[$key_them][$d[0]])){
					$data_return[$key_them][$d[0]]=[];
				}

				$data_return[$key_them][$d[0]][$d[1]]=$data_return[$key];
				if($iloop==1){
					// dd($key_them);

					// dd($data_return[$key_them]);
				}

				unset($data_return[$key]); 
			}else{

				


			}
				$iloop+=1;

			
		}

		
		return $data_return[0];

		// $value = 3000;

		
		// foreach($data as $k => $v) {
		// 	$list_map_key=[
		// 	  ['daerah',$v['kode_daerah']],
		// 	  ['daerah',$v['kode_daerah'],'bidang',$v['id_urusan']],
		// 	  ['daerah',$v['kode_daerah'],'bidang',$v['id_urusan'],'sub_urusan',$v['id_sub_urusan']]
		// 	];

		// 	foreach ($list_map_key as $k=>$keys) {

		// 	    $data_return=array_replace($data_return, array_merge_recursive($data_return, static::push_value($keys, array(
		// 	    	'nama'=>'nama',
		// 	    	'jumlah_program'=>0,
		// 	    	'jumlah_kegiatan'=>0

		// 	    ))));

			    
		// 	}
		// }



		return $data_return;
	}



	public static function push_value($keys, $value) {
	    $key = array_shift($keys);

	    if (count($keys)) {
	        return array($key => static::push_value($keys, $value));
	    }
	    else {
	        return array($key => $value);
	    }
	}

}

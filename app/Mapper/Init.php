<?php

namespace App\Mapper;

use Illuminate\Database\Eloquent\Model;

class Init extends Model
{
    //
	public static function bluemap($input=[],$dt){

		$data_map=[];
		foreach($input as $key=> $i ){
			$type=array_slice($i,0,1);
			$map=array_slice($i,1);

			foreach ($map as $klp => $value) {
				if((strpos($value, 'DB_') !== false)){
					$val_rpl=str_replace('DB_','',$value);
					if($val_rpl=='kode_program'){
							$ky=str_replace(' ', '_', str_replace(',', '_', str_replace('.', '_', $dt[$val_rpl])));
						$map[$klp]='k_'. (($ky!=null)?$ky:'kegiatan_pendukung');


					}else{
						$map[$klp]=($dt[$val_rpl]!=null)?$dt[$val_rpl]:'kegiatan_pendukung';

					}
				}
			}

			switch ($type[0]) {
				case 'Bidang':
					$option=array(
						'DB_nama'=>'nama_urusan',
						'type'=>$type[0],
						'call_id'=>implode('|',$map)				

					);

					break;
				case 'Sub Urusan':
					$option=array(
						'DB_nama'=>'nama_sub_urusan',
						'type'=>$type[0],		
						'call_id'=>implode('|',$map)				

					);

					break;
				case 'Daerah':
					$option=array(
						'DB_nama'=>'nama_daerah',
						'type'=>$type[0],			
						'call_id'=>implode('|',$map)				

					);

					break;
				case 'Program':
					$option=array(
						'DB_nama'=>'uraian_kode_program_daerah',
						'type'=>$type[0],			
						'call_id'=>implode('|',$map)				

					);

					break;
				case 'NSPK':
					$option=array(
						'DB_nama'=>'mandat',
						'type'=>$type[0],			
						'call_id'=>implode('|',$map)				

					);

					break;

				case 'SPM':
					$option=array(
						'DB_nama'=>'uraian_spm'	,
						'type'=>$type[0],	
						'call_id'=>implode('|',$map)				

					);

					break;
				case 'SDGS':
					$option=array(
						'DB_nama'=>'uraian_sdgs',
						'type'=>$type[0],	
						'call_id'=>implode('|',$map)				

					);

					break;
				case 'PN':
					$option=array(
						'DB_nama'=>'uraian_pn',
						'type'=>$type[0],
						'call_id'=>implode('|',$map)				

					);

				break;
				case 'PP':
					$option=array(
						'DB_nama'=>'uraian_pp',
						'type'=>$type[0],
						'call_id'=>implode('|',$map)				

					);

				break;
				case 'KP':
					$option=array(
						'DB_nama'=>'uraian_kp',
						'type'=>$type[0],
						'call_id'=>implode('|',$map)				

					);

				break;


				
				default:
				$option=array(
											
				);
					# code...
				break;
			}

			if(count($option)>0){
				if(isset($option['DB_name'])){
					unset($option['DB_nama']);
					$option['nama']='Kegiatan Pendukung Lain';
				}
			}



			if(count($data_map)>0){
				$tmp=$data_map[($key-1)];

	
				array_pop($tmp);

				
				
				foreach ($map as  $m) {
					array_push($tmp,$m);
				}

				if(count($option)>0){
					foreach ($option as $o => $ov) {
						if($o=='call_id'){
							$call_id=implode('|',$tmp);
							$call_id=str_replace('0|','',$call_id);
							$option[$o]=$call_id;
						}
					}
				}

				

				array_push($tmp,count($option)==0?null:$option);
				// array_unshift($map,0);

				$data_map[]=$tmp;

			}else{
				array_push($map,count($option)==0?null:$option);
				array_unshift($map,0);
				$data_map[]=$map;
			}


		}


		return $data_map;
	}


    public static function map($data,$map=[],$tahun=2020,$option_program=[],$typ='semua',$id_map=null){
		if(count($map) >0){ $data_return=array();
			$data_global=['nama'=>'Nasional','type'=>'Data '.(($typ=='semua')?'':$typ),'span_typ'=>(($typ=='semua')?'':$typ)];

			if(in_array('anggaran',$option_program)){
				$data_global['Jumlah_Anggaran']=0;

			}

			if(in_array('program',$option_program)){
				$data_global['Jumlah_Program']=0;

			}

			if(in_array('kegiatan',$option_program)){
				$data_global['Jumlah_Kegiatan']=0;

			}

			if(in_array('spm',$option_program)){
				$data_global['Mendukung_SPM']=0;

			}

			if(in_array('nspk',$option_program)){
				$data_global['Mendukung_NSPK']=0;

			}
			if(in_array('pn',$option_program)){
				$data_global['Mendukung_PN']=0;

			}

			if(in_array('sdgs',$option_program)){
				$data_global['Mendukung_SDGS']=0;

			}

			

			if(in_array('semua_factor',$option_program)){
				$data_global["Mendukung_SPM_NSPK"]=0;
				$data_global["Mendukung_PN_NSPK"]=0;
				$data_global["Mendukung_PN_SPM"]=0;
				$data_global["Mendukung_PN_SPM_NSPK"]=0;
				$data_global["Mendukung_SDGS_NSPK"]=0;

				$data_global["Mendukung_SDGS_SPM"]=0;
				$data_global["Mendukung_SDGS_SPM_NSPK"]=0;
				$data_global["Mendukung_SDGS_PN"]=0;
				$data_global["Mendukung_SDGS_PN_NSPK"]=0;
				$data_global["Mendukung_SDGS_PN_SPM"]=0;
				$data_global["Mendukung_SDGS_PN_SPM_NSPK"]=0;


			}

			if(in_array('nspk_factor',$option_program)){
				$data_global["Mendukung_SPM_NSPK"]=0;
				$data_global["Mendukung_PN_NSPK"]=0;
				$data_global["Mendukung_PN_SPM"]=0;
				$data_global["Mendukung_PN_SPM_NSPK"]=0;
				$data_global["Mendukung_SDGS_NSPK"]=0;
				$data_global["Mendukung_SDGS_SPM"]=0;
				$data_global["Mendukung_SDGS_SPM_NSPK"]=0;
				$data_global["Mendukung_SDGS_PN"]=0;
				$data_global["Mendukung_SDGS_PN_NSPK"]=0;
				$data_global["Mendukung_SDGS_PN_SPM"]=0;
				$data_global["Mendukung_SDGS_PN_SPM_NSPK"]=0;
			}



			foreach ($data as $kp => $v) {
				
				$list_map_key=static::bluemap($map,$v);


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
							if(in_array('anggaran',$option_program)){
								$data_return[$key]['Jumlah_Anggaran']=0;

							}
							
							if(in_array('program',$option_program)){
								$data_return[$key]['Jumlah_Program']=0;

							}

							if(in_array('kegiatan',$option_program)){
								$data_return[$key]['Jumlah_Kegiatan']=0;

							}

							if(in_array('spm',$option_program)){
								$data_return[$key]['Mendukung_SPM']=0;

							}

							if(in_array('nspk',$option_program)){
								$data_return[$key]['Mendukung_NSPK']=0;

							}

							if(in_array('pn',$option_program)){
								$data_return[$key]['Mendukung_PN']=0;

							}

							if(in_array('sdgs',$option_program)){
								$data_return[$key]['Mendukung_SDGS']=0;

							}

							

							if(in_array('semua_factor',$option_program)){

								$data_return[$key]["Mendukung_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_PN_NSPK"]=0;
								$data_return[$key]["Mendukung_PN_SPM"]=0;
								$data_return[$key]["Mendukung_PN_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_SPM"]=0;
								$data_return[$key]["Mendukung_SDGS_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]=0;



							}


							
							if(in_array('nspk_factor',$option_program)){

								$data_return[$key]["Mendukung_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_PN_NSPK"]=0;
								$data_return[$key]["Mendukung_PN_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]=0;

							}

							if(in_array('spm_factor',$option_program)){

								$data_return[$key]["Mendukung_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_PN_SPM"]=0;
								$data_return[$key]["Mendukung_PN_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_SPM"]=0;
								$data_return[$key]["Mendukung_SDGS_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]=0;

							}

							if(in_array('pn_factor',$option_program)){

								$data_return[$key]["Mendukung_PN_NSPK"]=0;
								$data_return[$key]["Mendukung_PN_SPM"]=0;
								$data_return[$key]["Mendukung_PN_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]=0;

							}

							if(in_array('sdgs_factor',$option_program)){

								$data_return[$key]["Mendukung_SDGS_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_SPM"]=0;
								$data_return[$key]["Mendukung_SDGS_SPM_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_NSPK"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM"]=0;
								$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]=0;

							}




							

							if((isset($option[0]))&& (($option[0])!=null) ){

								if(isset($option[0]['type'])){
									if(($option[0]['type']=='Program')||($option[0]['type']=='program')){
										$data_return[$key]['where']=array(
											'kode_daerah'=>(string)$v['kode_daerah'],
											'kode_program'=>(string)$v['kode_program'],
											'tahun'=>(int)$v['tahun'],
										);

										if((strpos($key, 'key_dearah') !== false)){
												$data_return[$key]['where']['kode_daerah']=(string)$v['kode_daerah'];

										}

										if((strpos($key, 'key_bidang') !== false)){
												$data_return[$key]['where']['id_urusan']=(int)$v['id_urusan'];

										}

										if((strpos($key, 'key_sub_bidang') !== false)){
												$data_return[$key]['where']['id_sub_urusan']=(int)$v['id_sub_urusan'];

										}
										if((strpos($key, 'key_nspk') !== false)){

												$data_return[$key]['where']['id_nspk']=(int)$v['id_mandat'];

										}
										if((strpos($key, 'key_spm') !== false)){

												$data_return[$key]['where']['id_spm']=(int)$v['id_spm'];
										}

										if((strpos($key, 'key_pn') !== false)){

												$data_return[$key]['where']['id_pn']=(int)$v['id_pn'];
										}

										if((strpos($key, 'key_sdgs') !== false)){
												$data_return[$key]['where']['id_sdgs']=(int)$v['id_sdgs'];
										}


										switch ($typ) {
											case 'nspk':
												$data_return[$key]['where']['nspk']=true;
												$data_return[$key]['where']['id_nspk']='| is not null';
																							
												break;
											case 'spm':
												$data_return[$key]['where']['smp']=true;
												$data_return[$key]['where']['id_spm']='| is not null';

											
												break;
											case 'pn':
												$data_return[$key]['where']['pn']=true;
												$data_return[$key]['where']['id_pn3']='| is not null';

											
												break;
											
											case 'sdgs':
												$data_return[$key]['where']['sdgs']=true;
												$data_return[$key]['where']['id_sdgs']='| is not null';

											
												break;
											
											default:
												# code...
												break;
										}

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

						if(in_array('anggaran',$option_program)){

							$data_return[$key]['Jumlah_Anggaran']+=$v['jml_anggaran'];
							$data_global['Jumlah_Anggaran']+=$v['jml_anggaran'];

						}

						if(in_array('program',$option_program)){

							$data_return[$key]['Jumlah_Program']+=$v['jml_program'];
							$data_global['Jumlah_Program']+=$v['jml_program'];


						}

						if(in_array('kegiatan',$option_program)){

							$data_return[$key]['Jumlah_Kegiatan']+=$v['jml_kegiatan'];	
							$data_global['Jumlah_Kegiatan']+=$v['jml_kegiatan'];	

						}

						if(in_array('spm',$option_program)){

							$data_return[$key]['Mendukung_SPM']+=$v['jml_spm'];	
							$data_global['Mendukung_SPM']+=$v['jml_spm'];	

						}

						if(in_array('nspk',$option_program)){

							$data_return[$key]['Mendukung_NSPK']+=$v['jml_nspk'];	
							$data_global['Mendukung_NSPK']+=$v['jml_nspk'];	

						}
						if(in_array('pn',$option_program)){

							$data_return[$key]['Mendukung_PN']+=$v['jml_pn'];	
							$data_global['Mendukung_PN']+=$v['jml_pn'];	

						}

						if(in_array('sdgs',$option_program)){

							$data_return[$key]['Mendukung_SDGS']+=$v['jml_sdgs'];	
							$data_global['Mendukung_SDGS']+=$v['jml_sdgs'];	

						}

						

						if(in_array('nspk_factor', $option_program)){
							$data_return[$key]["Mendukung_SPM_NSPK"]+=$v["hanya_spm_nspk"];
							$data_return[$key]["Mendukung_PN_NSPK"]+=$v["hanya_pn_nspk"];
							$data_return[$key]["Mendukung_PN_SPM_NSPK"]+=$v["hanya_pn_spm_nspk"];
							$data_return[$key]["Mendukung_SDGS_NSPK"]+=$v["hanya_sdgs_nspk"];
							$data_return[$key]["Mendukung_SDGS_SPM_NSPK"]+=$v["hanya_sdgs_spm_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN_NSPK"]+=$v["hanya_sdgs_pn_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]+=$v["hanya_sdgs_pn_spm_nspk"];
						}

						if(in_array('spm_factor', $option_program)){
							$data_return[$key]["Mendukung_SPM_NSPK"]+=$v["hanya_spm_nspk"];
							$data_return[$key]["Mendukung_PN_SPM"]+=$v["hanya_pn_spm"];
							$data_return[$key]["Mendukung_PN_SPM_NSPK"]+=$v["hanya_pn_spm_nspk"];
							$data_return[$key]["Mendukung_SDGS_SPM"]+=$v["hanya_sdgs_spm"];
							$data_return[$key]["Mendukung_SDGS_SPM_NSPK"]+=$v["hanya_sdgs_spm_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM"]+=$v["hanya_sdgs_pn_spm"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]+=$v["hanya_sdgs_pn_spm_nspk"];
						}

						if(in_array('pn_factor', $option_program)){
							$data_return[$key]["Mendukung_PN_NSPK"]+=$v["hanya_pn_nspk"];
							$data_return[$key]["Mendukung_PN_SPM"]+=$v["hanya_pn_spm"];
							$data_return[$key]["Mendukung_PN_SPM_NSPK"]+=$v["hanya_pn_spm_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN"]+=$v["hanya_sdgs_pn"];
							$data_return[$key]["Mendukung_SDGS_PN_NSPK"]+=$v["hanya_sdgs_pn_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM"]+=$v["hanya_sdgs_pn_spm"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]+=$v["hanya_sdgs_pn_spm_nspk"];
						}

						if(in_array('sdgs_factor', $option_program)){
							$data_return[$key]["Mendukung_SDGS_NSPK"]+=$v["hanya_sdgs_nspk"];
							$data_return[$key]["Mendukung_SDGS_SPM"]+=$v["hanya_sdgs_spm"];
							$data_return[$key]["Mendukung_SDGS_SPM_NSPK"]+=$v["hanya_sdgs_spm_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN"]+=$v["hanya_sdgs_pn"];
							$data_return[$key]["Mendukung_SDGS_PN_NSPK"]+=$v["hanya_sdgs_pn_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM"]+=$v["hanya_sdgs_pn_spm"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]+=$v["hanya_sdgs_pn_spm_nspk"];
						}

						if(in_array('semua_factor',$option_program)){
							$data_global["Mendukung_SPM_NSPK"]+=$v["hanya_spm_nspk"];
							$data_global["Mendukung_PN_NSPK"]+=$v["hanya_pn_nspk"];
							$data_global["Mendukung_PN_SPM"]+=$v["hanya_pn_spm"];
							$data_global["Mendukung_PN_SPM_NSPK"]+=$v["hanya_pn_spm_nspk"];
							$data_global["Mendukung_SDGS_NSPK"]+=$v["hanya_sdgs_nspk"];
							$data_global["Mendukung_SDGS_SPM"]+=$v["hanya_sdgs_spm"];
							$data_global["Mendukung_SDGS_SPM_NSPK"]+=$v["hanya_sdgs_spm_nspk"];
							$data_global["Mendukung_SDGS_PN"]+=$v["hanya_sdgs_pn"];
							$data_global["Mendukung_SDGS_PN_NSPK"]+=$v["hanya_sdgs_pn_nspk"];
							$data_global["Mendukung_SDGS_PN_SPM"]+=$v["hanya_sdgs_pn_spm"];
							$data_global["Mendukung_SDGS_PN_SPM_NSPK"]+=$v["hanya_sdgs_pn_spm_nspk"];

							$data_return[$key]["Mendukung_SPM_NSPK"]+=$v["hanya_spm_nspk"];
							$data_return[$key]["Mendukung_PN_NSPK"]+=$v["hanya_pn_nspk"];
							$data_return[$key]["Mendukung_PN_SPM"]+=$v["hanya_pn_spm"];
							$data_return[$key]["Mendukung_PN_SPM_NSPK"]+=$v["hanya_pn_spm_nspk"];
							$data_return[$key]["Mendukung_SDGS_NSPK"]+=$v["hanya_sdgs_nspk"];
							$data_return[$key]["Mendukung_SDGS_SPM"]+=$v["hanya_sdgs_spm"];
							$data_return[$key]["Mendukung_SDGS_SPM_NSPK"]+=$v["hanya_sdgs_spm_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN"]+=$v["hanya_sdgs_pn"];
							$data_return[$key]["Mendukung_SDGS_PN_NSPK"]+=$v["hanya_sdgs_pn_nspk"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM"]+=$v["hanya_sdgs_pn_spm"];
							$data_return[$key]["Mendukung_SDGS_PN_SPM_NSPK"]+=$v["hanya_sdgs_pn_spm_nspk"];

						}






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
			
			$data_return= $data_return[0];
			foreach ($data_global as $key => $value) {
				$data_return[$key]=$value;
			}

		}else{
			$data_return=[];
		}

		$dr=['data_return'=>$data_return,'tahun'=>$tahun];

		if(isset($id_map)){
			$dr['id_map']=$id_map;
		}


		return view('all.mapper')->with($dr)->render();
	}
}

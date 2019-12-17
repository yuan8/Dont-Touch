<?php

namespace App\Mapper;

use Illuminate\Database\Eloquent\Model;
use DB;
class NSPK extends Model
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
            m.id as id_mandat,
            m.mandat as mandat,
            u.nama as nama_urusan,
            a.id_sub_urusan,
            kode_program,
            uraian_kode_program_daerah,
            count(DISTINCT(kode_program)) as jml_program,
            count(DISTINCT(CONCAT(a.kode_daerah,a.kode_kegiatan))) as jml_kegiatan 

            from program_kegiatan_lingkup_supd_2 as a
            left join view_daerah as d on d.id= a.kode_daerah
            left join master_urusan as u on u.id= a.id_urusan
            left join master_sub_urusan as s on s.id=a.id_sub_urusan
            left join mandat as m on a.id_nspk = m.id
            where a.tahun =
            ".$tahun." and a.id_nspk is not null and a.nspk=true
            group by m.id,kode_daerah,a.id_urusan,a.id_sub_urusan,a.kode_program,uraian_kode_program_daerah,d.nama,u.nama,s.nama "
		
		);

		$data=json_encode($data);
    	$data=json_decode($data,true);

    	return $data;

	}

    public static function map($data){
    	
    	$data_return =[];

    	foreach ($data as $key => $v) {

            if(count($data_return)<=0){
                $data_return['jumlah_kegiatan']=0;
                $data_return['jumlah_program']=0;
                $data_return['jumlah_anggaran']=0;
                $data_return['type']='Kegiatan Pendukung';
                $data_return['nama']='NSPK';

            }

    		if(!isset($data_return['nspk'][(string)$v['id_urusan']])){
    			$data_return['nspk'][(string)$v['id_urusan']]=array(
    				'nama'=>$v['nama_urusan'],
    				'jumlah_anggaran'=>0,
    				'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
    				'call_id_2'=>''.(string)$v['id_urusan'].'',
    				'type'=>'Bidang',
    				'mandat'=>[]
    			);
    		}


            if(!isset($data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']])){
                $data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]=array(
                    'nama'=>$v['nama_sub_urusan'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'type'=>'Sub Urusan',
                    // 'call_id'=>[(string)$v['id_urusan'],'mandat',(string)$v['id_mandat']],
                    'call_id_2'=>''.(string)$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].'',
                    'mandat'=>[],

                );
            }

    		if(!isset($data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][(string)$v['id_mandat']] )){
    			$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][(string)$v['id_mandat']]=array(
    				'nama'=>$v['mandat'],
    				'jumlah_anggaran'=>0,
    				'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
    				'type'=>'Mandat',
    				// 'call_id'=>[(string)$v['id_urusan'],'mandat',(string)$v['id_mandat']],
    				'call_id_2'=>''.(string)$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].',mandat,'.$v['id_mandat'].'',
    				'daerah'=>[],

    			);
    		}

    		if(!isset($data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][(string)$v['id_mandat']]['daerah'][(string) $v['kode_daerah']] )){
    			$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][(string)$v['id_mandat']]['daerah'][(string) $v['kode_daerah']]=array(
    				'nama'=>$v['nama_daerah'],
    				'jumlah_anggaran'=>0,
    				'type'=>'Daerah',

    				// 'call_id'=>[(string)$v['id_urusan'],'mandat',(string)$v['id_mandat'],'daerah',(string) $v['kode_daerah']],
    				'call_id_2'=>''.(string)$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].',mandat,'.$v['id_mandat'].',daerah,'.$v['kode_daerah'].'',


    				'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
    			);
    		}

    		if(!isset($data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][(string)$v['id_mandat']]['daerah'][(string) $v['kode_daerah']]['program'][(string) $v['kode_program']] )){

    			$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][(string)$v['id_mandat']]['daerah'][(string) $v['kode_daerah']]['program'][$v['kode_program']]=array(
    				'nama'=>$v['uraian_kode_program_daerah'],
    				'jumlah_anggaran'=>0,
    				'type'=>'program',
    				// 'call_id'=>[(string)$v['id_urusan'],'mandat',(string)$v['id_mandat'],'daerah',(string) $v['kode_daerah'],'program',(string) $v['kode_program']],
    				'call_id_2'=>''.(string)$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].',mandat,'.$v['id_mandat'].',daerah,'.$v['kode_daerah'].',program,'.$v['kode_program'].'',
                    'where'=>array(
                        'kode_program'=>$v['kode_program'],
                        'nspk'=>true,
                        'kode_daerah'=>$v['kode_daerah'],
                        'id_urusan'=>$v['id_urusan'],
                        'id_nspk'=>$v['id_mandat'],
                        'id_sub_urusan'=>$v['id_sub_urusan']
                    ),
    				'jumlah_kegiatan'=>0,
    			);
    		}

            $data_return['jumlah_program']+=$v['jml_program'];
            $data_return['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['jumlah_anggaran']+=$v['jml_anggaran'];


    		$data_return['nspk'][(string)$v['id_urusan']]['jumlah_anggaran']+=$v['jml_anggaran'];
    		$data_return['nspk'][(string)$v['id_urusan']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['nspk'][(string)$v['id_urusan']]['jumlah_program']+=$v['jml_program'];


            $data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_program']+=$v['jml_program'];




    		
    		$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][$v['id_mandat']]['jumlah_anggaran']+=$v['jml_anggaran'];
    		$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][$v['id_mandat']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][$v['id_mandat']]['jumlah_program']+=$v['jml_program'];


    		
    		$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][$v['id_mandat']]['daerah'][$v['kode_daerah']]['jumlah_anggaran']+=$v['jml_anggaran'];
    		$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][$v['id_mandat']]['daerah'][$v['kode_daerah']]['jumlah_kegiatan']+=$v['jml_kegiatan'];

            $data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][$v['id_mandat']]['daerah'][$v['kode_daerah']]['jumlah_program']+=$v['jml_program'];


    
    		$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][$v['id_mandat']]['daerah'][$v['kode_daerah']]['program'][$v['kode_program']]['jumlah_anggaran']+=$v['jml_anggaran'];

    		$data_return['nspk'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['mandat'][$v['id_mandat']]['daerah'][$v['kode_daerah']]['program'][$v['kode_program']]['jumlah_kegiatan']+=$v['jml_kegiatan'];




    	}

    	return $data_return;
 	
    }
}

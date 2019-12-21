<?php

namespace App\Mapper;

use Illuminate\Database\Eloquent\Model;
use DB;
class SDGS extends Model
{
    //


    public static function query($tahun=2020,$add=''){
        $data=DB::select(
            "select ".($add!=''?$add.',':'')."
            s.nama as nama_sub_urusan,
            count(case when a.sdgs then 1 end ) as jml_sdgs,
            count(case when a.pn then 1 end ) as jml_pn,
            count(case when a.spm then 1 end ) as jml_spm,
            count(case when a.nspk then 1 end ) as jml_nspk,
            sum(a.anggaran) as jml_anggaran,
            a.kode_daerah,
            d.nama as nama_daerah,
            a.id_urusan,
            m.id as id_sdgs,
            m.sdgs as uraian_sdgs,
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
            left join master_sdgs as m on a.id_sdgs = m.id
            where a.tahun =
            ".$tahun." and a.id_sdgs is not null and a.sdgs=true
            group by m.id,kode_daerah,a.id_urusan,a.id_sub_urusan,a.kode_program,uraian_kode_program_daerah,d.nama,u.nama,s.nama,m.sdgs,a.tahun "
        
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
                $data_return['nama']='SDGS';

            }

            if(!isset($data_return['sdgs'][$v['id_sdgs']])){
               $data_return['sdgs'][$v['id_sdgs']]=array(
                    'nama'=>$v['uraian_sdgs'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'call_id_2'=>''.$v['id_sdgs'],
                    'type'=>'SDGS',
                    'urusan'=>[]
                );
            }

            if(!isset($data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']])){
                $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]=array(
                    'nama'=>$v['nama_urusan'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'call_id_2'=>''.$v['id_sdgs'].',urusan,'.(string)$v['id_urusan'].'',
                    'type'=>'Bidang',
                    'sub_urusan'=>[]
                );
            }


            if(!isset($data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']])){
                $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]=array(
                    'nama'=>$v['nama_sub_urusan'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'type'=>'Sub Urusan',
                    // 'call_id'=>[(string)$v['id_urusan'],'sdgs',(string)$v['id_sdgs']],
                    'call_id_2'=>''.$v['id_sdgs'].',urusan,'.(string)$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].'',
                    'sdgs'=>[],

                );
            }

            if(!isset($data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'] )){
                $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan']=array(
                    'nama'=>$v['uraian_sdgs'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'type'=>'sdgs',
                    // 'call_id'=>[(string)$v['id_urusan'],'sdgs',(string)$v['id_sdgs']],
                    'call_id_2'=>''.$v['id_sdgs'].',urusan,'.(string)$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].',sdgs,'.$v['id_sdgs'].'',
                    'daerah'=>[],

                );
            }

            if(!isset($data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][(string) $v['kode_daerah']] )){
                $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][(string) $v['kode_daerah']]=array(
                    'nama'=>$v['nama_daerah'],
                    'jumlah_anggaran'=>0,
                    'type'=>'Daerah',

                    // 'call_id'=>[(string)$v['id_urusan'],'sdgs',(string)$v['id_sdgs'],'daerah',(string) $v['kode_daerah']],
                    'call_id_2'=>''.$v['id_sdgs'].',urusan,'.(string)$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].',daerah,'.$v['kode_daerah'].'',


                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                );
            }

            if(!isset($data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][(string) $v['kode_daerah']]['program'][(string) $v['kode_program']] )){

                $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][(string) $v['kode_daerah']]['program'][$v['kode_program']]=array(
                    'nama'=>$v['uraian_kode_program_daerah'],
                    'jumlah_anggaran'=>0,
                    'type'=>'Program',
                    // 'call_d'=>[(string)$v['id_urusan'],'sdgs',(string)$v['id_sdgs'],'daerah',(string) $v['kode_daerah'],'program',(string) $v['kode_program']],
                    'call_id_2'=>''.$v['id_sdgs'].',urusan,'.(string)$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].',daerah,'.$v['kode_daerah'].',program,'.$v['kode_program'].'',
                    'where'=>array(
                        'kode_program'=>$v['kode_program'],
                        'sdgs'=>true,
                        'kode_daerah'=>$v['kode_daerah'],
                        'id_urusan'=>$v['id_urusan'],
                        'id_sdgs'=>$v['id_sdgs'],
                        'id_sub_urusan'=>$v['id_sub_urusan']
                    ),
                    'jumlah_kegiatan'=>0,
                );
            }

            $data_return['jumlah_program']+=$v['jml_program'];
            $data_return['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['jumlah_anggaran']+=$v['jml_anggaran'];

            $data_return['sdgs'][$v['id_sdgs']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['sdgs'][$v['id_sdgs']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['sdgs'][$v['id_sdgs']]['jumlah_program']+=$v['jml_program'];


            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['jumlah_program']+=$v['jml_program'];


            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_program']+=$v['jml_program'];




            
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_program']+=$v['jml_program'];


            
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['jumlah_kegiatan']+=$v['jml_kegiatan'];

            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['jumlah_program']+=$v['jml_program'];


    
            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['program'][$v['kode_program']]['jumlah_anggaran']+=$v['jml_anggaran'];

            $data_return['sdgs'][$v['id_sdgs']]['urusan'][(string)$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['program'][$v['kode_program']]['jumlah_kegiatan']+=$v['jml_kegiatan'];


        }

        return $data_return;
    
    }
}
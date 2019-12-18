<?php

namespace App\Mapper;

use Illuminate\Database\Eloquent\Model;
use DB;

class PN extends Model
{
    //


    public static function query($tahun=2020){

        $data=DB::select(
               "select 
            s.nama as nama_sub_urusan,
            count(case when a.sdgs then 1 end ) as jml_sdgs,
            count(case when a.pn then 1 end ) as jml_pn,
            count(case when a.spm then 1 end ) as jml_spm,
            count(case when a.pn then 1 end ) as jml_pn,
            sum(a.anggaran) as jml_anggaran,
            a.kode_daerah,
            d.nama as nama_daerah,a.id_urusan,
            m.id as id_pn,
            m.prioritas_nasional as uraian_pn,
            m.kegiatan_prioritas as uraian_kp,
            m.kp as id_kp,
            m.pp as id_pp,
            m.program_prioritas as uraian_pp,


            u.nama as nama_urusan,
            a.id_sub_urusan,
            kode_program,
            uraian_kode_program_daerah,
            count(DISTINCT(kode_program)) as jml_program,
            count(DISTINCT(a.kode_kegiatan)) as jml_kegiatan 
            from program_kegiatan_lingkup_supd_2 as a
            left join view_daerah as d on d.id= a.kode_daerah
            left join master_urusan as u on u.id= a.id_urusan
            left join master_sub_urusan as s on s.id=a.id_sub_urusan
            left join master_pn as m on a.id_pn3 = m.id
            where a.tahun =
            ".$tahun." and a.id_pn3 is not null and a.pn=true
            group by  m.program_prioritas,m.pp,m.prioritas_nasional, m.kegiatan_prioritas, m.kp,m.id,kode_daerah,a.id_urusan,a.id_sub_urusan,a.kode_program,uraian_kode_program_daerah,d.nama,u.nama,s.nama "
        
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
                $data_return['nama']='PN';

            }

            if(!isset($data_return['pn'][$v['id_pn']])){
                $data_return['pn'][$v['id_pn']]=array(
                    'nama'=>$v['uraian_pn'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'call_id_2'=>''.$v['id_pn'].'',
                    'type'=>'Prioritas Nasioanal',
                    'pp'=>[]
                );
            }


            if(!isset($data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']])){
                $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]=array(
                    'nama'=>$v['uraian_pp'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'type'=>'Program Prioritas',
                    'call_id_2'=>''.$v['id_pn'].',pp,'.$v['id_pp'].'',
                    'kp'=>[],

                );
            }

            if(!isset($data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']] )){
                $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]=array(
                    'nama'=>$v['uraian_kp'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'type'=>'Kegiatan Prioritas',
                    'call_id_2'=>''.$v['id_pn'].',pp,'.$v['id_pp'].',kp,'.$v['id_kp'].'',
                    'urusan'=>[],

                );
            }

            if(!isset($data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']] )){
               $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]=array(
                    'nama'=>$v['nama_urusan'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'type'=>'Urusan',
                    'call_id_2'=>''.$v['id_pn'].',pp,'.$v['id_pp'].',kp,'.$v['id_kp'].',urusan,'.$v['id_urusan'],
                    'sub_urusan'=>[],

                );
            }

            if(!isset($data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']] )){

               $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]=array(
                    'nama'=>$v['nama_sub_urusan'],
                    'jumlah_anggaran'=>0,
                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'type'=>'Sub Urusan',
                    'call_id_2'=>''.$v['id_pn'].',pp,'.$v['id_pp'].',kp,'.$v['id_kp'].',urusan,'.$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'],
                    'daerah'=>[],

                );
            }

            if(!isset($data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']] )){
                $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]=array(
                    'nama'=>$v['nama_daerah'],
                    'jumlah_anggaran'=>0,
                    'type'=>'Daerah',

                    'call_id_2'=>''.$v['id_pn'].',pp,'.$v['id_pp'].',kp,'.$v['id_kp'].',urusan,'.$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].',daerah,'.$v['kode_daerah'].'',


                    'jumlah_kegiatan'=>0,
                    'jumlah_program'=>0,
                    'program'=>[],

                );
            }

            if(!isset($data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['program'][ $v['kode_program']] )){

                $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['program'][ $v['kode_program']]=array(
                    'nama'=>$v['uraian_kode_program_daerah'],
                    'jumlah_anggaran'=>0,
                    'type'=>'Program',
                    'call_id_2'=>''.$v['id_pn'].',pp,'.$v['id_pp'].',kp,'.$v['id_kp'].',urusan,'.$v['id_urusan'].',sub_urusan,'.$v['id_sub_urusan'].',daerah,'.$v['kode_daerah'].',program,'.$v['kode_program'].'',
                    'where'=>array(
                        'kode_program'=>$v['kode_program'],
                        'pn'=>true,
                        'kode_daerah'=>$v['kode_daerah'],
                        'id_urusan'=>$v['id_urusan'],
                        'id_pn3'=>$v['id_pn'],
                        'id_sub_urusan'=>$v['id_sub_urusan']
                    ),
                    'jumlah_kegiatan'=>0,
                );
            }

            $data_return['jumlah_program']+=$v['jml_program'];
            $data_return['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['jumlah_anggaran']+=$v['jml_anggaran'];


            $data_return['pn'][$v['id_pn']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['pn'][$v['id_pn']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['pn'][$v['id_pn']]['jumlah_program']+=$v['jml_program'];


            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['jumlah_program']+=$v['jml_program'];




            
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['jumlah_kegiatan']+=$v['jml_kegiatan'];
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['jumlah_program']+=$v['jml_program'];



            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['jumlah_program']+=$v['jml_program'];

            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['jumlah_kegiatan']+=$v['jml_kegiatan'];


             $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_program']+=$v['jml_program'];

            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['jumlah_kegiatan']+=$v['jml_kegiatan'];

            
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['jumlah_anggaran']+=$v['jml_anggaran'];
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['jumlah_kegiatan']+=$v['jml_kegiatan'];

            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['jumlah_program']+=$v['jml_program'];


    
            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['program'][ $v['kode_program']]['jumlah_anggaran']+=$v['jml_anggaran'];

            $data_return['pn'][$v['id_pn']]['pp'][$v['id_pp']]['kp'][$v['id_kp']]['urusan'][$v['id_urusan']]['sub_urusan'][$v['id_sub_urusan']]['daerah'][$v['kode_daerah']]['program'][ $v['kode_program']]['jumlah_kegiatan']+=$v['jml_kegiatan'];




        }

        return $data_return;
    
    }
}

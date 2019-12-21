<?php

namespace App\Mapper;

use Illuminate\Database\Eloquent\Model;

class NSPKDaerah extends Model
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
    	

    }
}

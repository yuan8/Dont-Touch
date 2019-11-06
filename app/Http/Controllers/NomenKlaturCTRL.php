<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NomenKlaturProvinsi;
use App\NomenKlaturKotaKabupaten;
class NomenKlaturCTRL extends Controller
{
    //

    public function getKegiatanProvinsiFromProgram(Request $request){
        if($request->pro){
            $kegitan=NomenKlaturProvinsi::where('kode','like',$request->kode_program.'%')->where('jenis','kegiatan')->get();
            if($kegitan){
                $kegitan=$kegitan->toArray();
            }
            return $kegitan;
        }else{
            $kegitan=NomenKlaturKotaKabupaten::where('kode','like',$request->kode_program.'%')->where('jenis','kegiatan')->get();
            if($kegitan){
                $kegitan=$kegitan->toArray();
            }
            return $kegitan;


        }
    	

    }

    public function getSubKegiatanProvinsiFromKegiatan(Request $request){
    	if($request->pro){
            if($request->kode_kegiatan!=''){

            $sub=NomenKlaturProvinsi::where('kode','like',$request->kode_kegiatan.'%')->where('jenis','sub_kegiatan')->get();

                if($sub){
                    $sub=$sub->toArray();
                }
                
                return $sub;
            }else{
             return [];

            }
        }else{

        	 $sub=NomenKlaturKotaKabupaten::where('kode','like',$request->kode_kegiatan.'%')->where('jenis','sub_kegiatan')->get();

                if($sub){
                    $sub=$sub->toArray();
                }
                
                return $sub;
        }

    	
    }
}
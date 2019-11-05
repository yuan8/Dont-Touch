<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Urusan23;
use App\IndetifikasiKebijakanTahunan;
use App\NomenKlaturProvinsi;
use App\IntegrasiProvinsi;
use Auth;
use App\Satuan;
use App\IntegrasikotaKab;
class FormSink7 extends Controller
{
    //

    public function index($urusan){
    	$data_link=Urusan23::find($urusan);
    	$data = IndetifikasiKebijakanTahunan::where('tahun',session('focus_tahun'))
		->where('id_urusan',$urusan)->paginate(10);




    	return view('form_singkron.form7')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$data);
    }

    public function showIndetifikasiTahunan($urusan,$id){
    	$data_link=Urusan23::find($urusan);
        $satuan=Satuan::all();
    	$data=IndetifikasiKebijakanTahunan::find($id);
        $program_provinsi=NomenKlaturProvinsi::where('kode','ilike',$data_link->nomenklatur_provinsi.'%')->where('jenis','program')->get();
        
    	return view('form_singkron.form7_indetifikasi_tahunan')->with('id_link',$urusan)->with('data_link',$data_link)->with('data',$data)->with('program_provinsi',$program_provinsi)->with('satuans',$satuan);
    }



    public function add_sub_urusan_provinsi(Request $request,$urusan,$id){
        $data_link=Urusan23::find($urusan);
        $data=IndetifikasiKebijakanTahunan::find($id);

        $d=IntegrasiProvinsi::where('id_identifikasi_kebijakan_tahunan',$id)
        ->where('kode_sub_kegiatan',$request->sub_urusan_provinsi)
        ->where('tahun',session('focus_tahun'))
        ->where('id_urusan',$urusan)->first();

        if($d){
            return back();
        }

        IntegrasiProvinsi::create([
            'id_identifikasi_kebijakan_tahunan'=>$id,
            'kode_sub_kegiatan'=>$request->sub_urusan_provinsi,
            'id_user'=>Auth::User()->id,
            'tahun'=>session('focus_tahun'),
            'id_urusan'=>$urusan
        ]);

        return back();
    }


    public function add_sub_urusan_kotakab(Request $request,$urusan,$id){

        $data_link=Urusan23::find($urusan);
        $data=IndetifikasiKebijakanTahunan::find($id);

        $d=IntegrasikotaKab::where('id_identifikasi_kebijakan_tahunan',$id)
        ->where('kode_sub_kegiatan',$request->sub_urusan_provinsi)
        ->where('tahun',session('focus_tahun'))
        ->where('id_urusan',$urusan)->first();
        
        if($d){
            return back();
        }

        IntegrasikotaKab::create([
            'id_identifikasi_kebijakan_tahunan'=>$id,
            'kode_sub_kegiatan'=>$request->sub_urusan_provinsi,
            'id_user'=>Auth::User()->id,
            'tahun'=>session('focus_tahun'),
            'id_urusan'=>$urusan
        ]);

        return back();

    }
}

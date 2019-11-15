<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urusan23;

use DB;
class FormSink5 extends Controller
{
    //

    public function index($urusan){
    	$data_link=Urusan23::find($urusan);
    	$data=DB::connection('pgsql2')->table('perumahan_kegiatan_2')->join('view_daerah','kodedaerah','id')->orderBy('ID','DESC')->where('perumahan_kegiatan_2.id_urusan',$urusan)->paginate(20);

    	return view('form_singkron.form5')->with('id_link',$urusan)->with('data_link',$data_link)
    	->with('datas',$data);
    }

    public function update_jenis_kegiatan($urusan,$id,Request $request){
    	$data=DB::connection('pgsql2')->table('perumahan_kegiatan_2')->where('ID',$id)->first();

    	if($data){
    		$data->NSPK=isset($request->nspk)?1:0;
    		$data->SPM=isset($request->spm)?1:0;
    		$data->PN=isset($request->pn)?1:0;
    		$data->SDGS=isset($request->sdgs)?1:0;

    		$data=(array) $data;
    		$return=DB::connection('pgsql2')->table('perumahan_kegiatan_2')->where('ID',$id)->update($data);


    	}

    	return back();

    }



}

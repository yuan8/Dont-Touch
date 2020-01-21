<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urusan23;
use App\SubUrusan23;
use Validator;
use App\Permasalahan;
use Auth;
use Alert;
use DB;
use App\Provinsi;
use App\Kabupaten;


class FormSink4 extends Controller
{
    //


    public function index($urusan,Request $request){

      

        $where=[];
      if(isset($request->q)){
        $where=[['nama','like','%'.$request->q.'%']];
      }else{
        

      }

      $first = DB::table('provinsi')->select(['id_provinsi as id','nama']);
      if(isset($request->q)){
        $first=$first->where('nama','Ilike','%'.$request->q.'%');
      }

      $daerah = DB::table('kabupaten')
              ->select(['id_kota as id','nama'])
              ->union($first)->orderBy('id','ASC');

      if(isset($request->q)){
        $daerah=$daerah->where('nama','Ilike','%'.$request->q.'%');
      }

      $daerah=$daerah->paginate(10);
      $daerah->appends(['q'=>$request->q]);
             
      $back=$daerah;
      $kota_kab=$daerah->toArray();
      $kota_kab= (array) $kota_kab['data'];
      foreach ($kota_kab as $key => $value){
        $kota_kab[$key]= (array) $kota_kab[$key];
        $kota_kab[$key]['id']=(int) $kota_kab[$key]['id'];
        $kota_kab[$key]['id']=(string) $kota_kab[$key]['id'];

        if(strlen($kota_kab[$key]['id'])>2){
          $level='kota_kabupaten';
          $kota_kab[$key]['level']=2;
          $kota_kab[$key]['provinsi']=substr((int)$kota_kab[$key]['id'], 0, 2);
          $kota_kab[$key]['kota_kabupaten']=$kota_kab[$key]['id'];
          $where=[['kota_kabupaten',$kota_kab[$key]['id']]];

        }else{
          $level='provinsi';
          $kota_kab[$key]['level']=1;
          $kota_kab[$key]['nama']='PROVINSI '.$kota_kab[$key]['nama'];
          $kota_kab[$key]['provinsi']=$kota_kab[$key]['id'];
          $kota_kab[$key]['kota_kabupaten']=0;


          $where=[['provinsi',$kota_kab[$key]['id']],['kota_kabupaten',0]];
        }

        $kota_kab[$key]['permasalahan']=Permasalahan::where($where)->where('tahun',session('focus_tahun'))->where('id_urusan',$urusan)->get()->toArray();
      }


    	$data_link=Urusan23::find($urusan);
        $data=Permasalahan::where('id_urusan',$urusan)->orderBy('id','DESC')->paginate(10);

    	return view('form_singkron.form4')->with('menu_id','s.4')->with('id_link',$urusan)->with('data_link',$data_link)->with('permasalahans',$data)->with('datas',$kota_kab)->with('link',$back);
    }


    public function delete($urusan,$id){
        $permasalahan=Permasalahan::where('id_urusan',$urusan)
        ->where('tahun',session('focus_tahun'))
        ->where('id',$id)->first();
        if($permasalahan){
            $permasalahan->delete();
            return back();
        }
    }

    public function show($urusan,$id){
        $data_link=Urusan23::find($urusan);

         $permasalahan=Permasalahan::where('id_urusan',$urusan)
        ->where('tahun',session('focus_tahun'))
        ->where('id',$id)->first();

        if($permasalahan){
            $daerah=$permasalahan->kota_kabupaten!=0?Kabupaten::where('id_kota',$permasalahan->kota_kabupaten)->first():Provinsi::where('id_provinsi',$permasalahan->provinsi)->first();

            return view('form_singkron.form4_update')->with('menu_id','s.4')->with('id_link',$urusan)
            ->with('data_link',$data_link)->with('data',$permasalahan)->with('daerah',$daerah);            
        }


    }

    public function update($urusan,$id,Request $request){
        $permasalahan=Permasalahan::where('id_urusan',$urusan)
        ->where('tahun',session('focus_tahun'))
        ->where('id',$id)->first();

        if($permasalahan){

            $masalah=[];
            $akar_masalah=[];
            $data_dukung=[];

            if(isset($request->masalah)){
                $masalah=($request->masalah);
            }
            if(isset($request->akar_masalah)){
                $akar_masalah=($request->akar_masalah);
            }  
            if(isset($request->data_dukung)){
                $data_dukung=($request->data_dukung);
            }

            $masalah=json_encode($masalah);
            $akar_masalah=json_encode($akar_masalah);    
            $data_dukung=json_encode($data_dukung);    


            $permasalahan=$permasalahan->update([
                'masalah_pokok'=>$request->masalah_pokok,
                'masalah'=>$masalah,
                'akar_masalah'=>$akar_masalah,
                'data_pendukung'=>$data_dukung,
            ]);

            return back();

        }

    }

    public function create($urusan,$provinsi,$kota_kabupaten){
        
        $daerah=$kota_kabupaten!=0?Kabupaten::where('id_kota',$kota_kabupaten)->first():Provinsi::where('id_provinsi',$provinsi)->first();


    	$data_link=Urusan23::find($urusan);
    	$sub_urusans=SubUrusan23::where('id_urusan',$urusan)->orderBy('nama','ASC')->get();
    	return view('form_singkron.form4_tambah')->with('menu_id','s.4')->with('id_link',$urusan)->with('data_link',$data_link)->with('sub_urusans',$sub_urusans)->with('daerah',$daerah)->with('provinsi',$provinsi)->with('kota_kabupaten',$kota_kabupaten);
    }


    public function store($urusan,Request $request){
        $data_link=Urusan23::find($urusan);
        $validator=Validator::make($request->all(),[
            'masalah.*'=>'required',
        ]);

        if($validator->fails()){

        }else{
            $masalah=[];
            $akar_masalah=[];
            $data_dukung=[];

            if(isset($request->masalah)){
                $masalah=($request->masalah);
            }
            if(isset($request->akar_masalah)){
                $akar_masalah=($request->akar_masalah);
            }  
            if(isset($request->data_dukung)){
                $data_dukung=($request->data_dukung);
            }

            $masalah=json_encode($masalah);
            $akar_masalah=json_encode($akar_masalah);    
            $data_dukung=json_encode($data_dukung);    


            $permasalahan=Permasalahan::create([
                'id_urusan'=>$urusan,
                'provinsi'=>$request->provinsi,
                'kota_kabupaten'=>$request->kota_kabupaten,
                'tahun'=>session('focus_tahun'),
                'masalah_pokok'=>$request->masalah_pokok,
                'masalah'=>$masalah,
                'akar_masalah'=>$akar_masalah,
                'data_pendukung'=>$data_dukung,
                'id_user'=>Auth::User()->id
            ]);

            if($permasalahan){
                Alert::success('Data Berhasil Ditambahkan','success');
                return back();
            }else{
                return abort('500');
            }


        }
    }
}

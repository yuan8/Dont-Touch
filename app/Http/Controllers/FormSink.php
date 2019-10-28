<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Auth;
use App\Urusan23;
use App\Program;
use App\SubUrusan23;
use Validator;
use App\Mandat;
use App\Provinsi;
use App\Kabupaten;
use App\PerdaPerkada;

class FormSink extends Controller
{
    //




    public function Form1Store($urusan,Request $request){


    	$validator=Validator::make($request->all(),[
    		'sub_urusan'=>'required|exists:sub_urusan_23,id',
    		'uu'=>'nullable',
    		'pp'=>'nullable',
    		'perpres'=>'nullable',
    		'permen'=>'nullable',
    		'mandat'=>'nullable',
    	]);


    	if($validator->fails()){
    		return 500;

    	}else{

    	}

    	$uu='[]';
    	$pp='[]';
    	$perpres='[]';
    	$permen='[]';
    	$mandat='[]';

    	if(isset($request->uu)){
    		$uu=$request->uu;
			 $uu=json_encode($uu);
    	}

    	if(isset($request->pp)){
    		$pp=$request->pp;
			$pp=json_encode($pp);
    	}
    	if(isset($request->perpres)){
    		$perpres=$request->perpres;
			$perpres=json_encode($perpres);
    	}
    	if(isset($request->permen)){
    		$permen=$request->permen;
			$permen=json_encode($permen);
    	}
    	if(isset($request->mandat)){
    		$mandat=$request->mandat;
			$mandat=json_encode($mandat);
    	}
	 	
	
		$data=[
			'id_sub_urusan'=>$request->sub_urusan,
			'uu'=>$uu,
      'tahun'=>session('focus_tahun'),
      'id_urusan'=>$urusan,
			'pp'=>$pp,
			'perpres'=>$perpres,
			'permen'=>$permen,
			'mandat'=>$mandat,
			'id_user'=>Auth::User()->id
		];

		$res=Mandat::create($data);
		if($res){
			return back();
		}else{

		}
	
		

    }

  public function Form1TambahMandat($urusan,Request $request){

  	
  	$data_link=Urusan23::find($urusan);
  	$sub_urusans=SubUrusan23::where('id_urusan',$urusan)->get();


    return view('form_singkron.form1_tambah_mandat')->with('sub_urusans',$sub_urusans)->with('id_link',$urusan)->with('data_link',$data_link);

  }

   public function Form1($urusan,Request $request){
		
 		$programs=Program::where('id_bidang_urusan',$urusan)->first();
 		$data_link=Urusan23::find($urusan);

		$data=Mandat::where('id_urusan',$urusan)->where('tahun',session('focus_tahun'))->paginate(10);


		return view('form_singkron.form1')->with('datas',$data)->with('id_link',$urusan)->with('data_link',$data_link)->with('programs',$programs);

    }


    public function form1Penilaian($urusan,Request $request){
		
 		$data_link=Urusan23::find($urusan);
    $data=Mandat::where('id_urusan',$urusan)
    ->where('tahun',session('focus_tahun'))->paginate(10);
		
		return view('form_singkron.form1_penilaian')->with('datas',$data)->with('id_link',$urusan)->with('data_link',$data_link);

    }
    public function form1PerdaPerkada($urusan,Request $request){
		
 		$data_link=Urusan23::find($urusan);
    $provinsi=Provinsi::all();
   
  	
		return view('form_singkron.form1_perdaperkada')->with('id_link',$urusan)->with('data_link',$data_link)->with('provinsis',$provinsi);
    }

   public  function Form1Update(Request $request){
		
		$data=file_get_contents(storage_path('app/f1_.json'));
		$koma=$data;
		if($koma!=""){
			$koma=',';
		}else{
			$koma="";
		}
		$data='['.$data.']';
		$data=json_decode($data,true);
		$data[$request->key]=json_encode($request->f);
		if($data){
			if(file_exists(storage_path('app/f1_.json'))){
				Storage::append('f1_.json', $koma.$data);	

			}else{
				Storage::append('f1_.json',$data);	
			}
		}
		
		return view('form_singkron.form1')->with('datas',$data);

    }


    public function form1PerdaPerkadaFilter($urusan,Request $request){
      $provinsi=$request->provinsi;
      $kotakab=isset($request->kotakab)?$request->kotakab:null;
      return redirect()->route('fs.f1.perda.perkada.perdaerah',['id_link'=>$urusan,'$provinsi'=>$provinsi,'kotakab'=>$kotakab]);

    }


    public function form1PerdaPerkadaPerdaearah($urusan,$provinsi,$kotakab=null){
      $kedaerahan=array(
        'provinsi'=>$provinsi,
        'kotakab'=>$kotakab
      );

      $provinsi=Provinsi::where('id_provinsi',$provinsi)->first();
      $daerah=null;
      $data_link=Urusan23::find($urusan);
      if(($kotakab==null)||($kotakab==0)){
        $daerah=$provinsi->toArray();
        $daerah['id']=$daerah['id_provinsi'];
        $daerah['pro']=1;
      }else{
        $daerah=Kabupaten::where('id_kota',$kotakab)->first()->toArray();
        $daerah['id']=$daerah['id_kota'];
        $daerah['pro']=0;
      }
      $where=[];
      if($daerah['pro']){
        $where['provinsi']=(int)$daerah['id'];
        $where['kota_kabupaten']=null;
      }else{
        $where['kota_kabupaten']=(int)$daerah['id'];
      }



      $data=PerdaPerkada::where('id_urusan',$urusan)->where('tahun',session('focus_tahun'))
      ->where($where)->paginate(10);

      return view('form_singkron.form1_perdaperkada_perdaerah')->with('daerah',$daerah)->with('id_link',$urusan)->with('data_link',$data_link)->with('data_daerah',$kedaerahan)->with('data',$data);

    }

    public function form1PerdaPerkadaPerdaearahTambah($urusan,$provinsi,$kotakab=null){
       $kedaerahan=array(
        'provinsi'=>$provinsi,
        'kotakab'=>$kotakab
      );
      $provinsi=Provinsi::where('id_provinsi',$provinsi)->first();

      $daerah=null;
      $data_link=Urusan23::find($urusan);
      if(($kotakab==null)||($kotakab==0)){
        $daerah=$provinsi->toArray();
        $daerah['id']=$daerah['id_provinsi'];
        $daerah['pro']=1;
      }else{
        $daerah=Kabupaten::where('id_kota',$kotakab)->first()->toArray();
        $daerah['id']=$daerah['id_kota'];
        $daerah['pro']=0;
      }

      $sub_urusans=SubUrusan23::where('id_urusan',$urusan)->get();
      
      $mandat=Mandat::where('id_sub_urusan',$urusan)->get();

      return view('form_singkron.form1_perdaperkada_perdaerah_tambah')->with('daerah',$daerah)->with('id_link',$urusan)->with('sub_urusans',$sub_urusans)->with('data_link',$data_link)->with('data_daerah',$kedaerahan)->with('mandats',$mandat);


    }

    public function form1PerdaPerkadaPerdaearahStore($urusan,$provinsi,$kota_kab,Request $request){

      $perda=isset($request->perda)?$request->perda:[];
      $perkada=isset($request->perkada)?$request->perkada:[];

      $perkada=json_encode($perkada);
      $perda=json_encode($perda);


  

     $data= PerdaPerkada::create([
        'perda'=>$perda,
        'perkada'=>$perkada,
        'id_user'=>Auth::User()->id,
        'tahun'=>session('focus_tahun'),
        'id_mandat'=>$request->mandat,
        'kota_kabupaten'=>$kota_kab==0?null:$kota_kab,
        'provinsi'=>$provinsi,
        'id_urusan'=>$urusan,
      ]);

     if($data){
      return back();
     }

    }



   public  function Form1Delete(Request $request){

   		$data=Mandat::find($request->id);

   		if($data){
   			$data->delete();
   		}

		
		return back();

    }


    public function index(){
    	$urusan=Auth::User()->haveUrusan;

    	return view('form_singkron.index')->with('urusans',$urusan)->with('title','SUPD2 Data Suport Sistem');
    }

}

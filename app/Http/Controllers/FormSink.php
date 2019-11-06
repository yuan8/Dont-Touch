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
use DB;
class FormSink extends Controller
{
    

    public function form1Update($urusan,$id,Request $request){
      $mandat_db=Mandat::find($id);
      if($mandat_db){


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
        $mandat_db->update([
          'id_sub_urusan'=>$request->sub_urusan,
          'uu'=>$uu,
          'pp'=>$pp,
          'permen'=>$permen,
          'perpres'=>$perpres,
          'mandat'=>$mandat,
        ]);

        return back();
      }

    }

    public function form1Edit($urusan,$id,Request $request){
      $data_link=Urusan23::find($urusan);
      $id_link=$urusan;
      $sub_urusans=SubUrusan23::where('id_urusan',$urusan)->get();

      $mandat=Mandat::find($id);

      return view('form_singkron.form1_edit')->with('id_link',$id_link)->with('data_link',$data_link)->with('mandat',$mandat)->with('sub_urusans',$sub_urusans);

    }

    public function form1PerdaPerkadaPerdaearahDelete($urusan,Request $request){
      $perda_perkada=PerdaPerkada::find($request->perda_perkada);
      if($perda_perkada){
        $perda_perkada->delete();
        return back();
      }
    }

    public function form1PerdaPerkadaPerdaearahUpStore($urusan,Request $request){
        if(isset($request->perda_perkada)){
          $perdaperkada=PerdaPerkada::find($request->perda_perkada);
          $perda=isset($request->perda)?$request->perda:[];
          $perkada=isset($request->perkada)?$request->perkada:[];
          $perkada=json_encode($perkada);
          $perda=json_encode($perda);

           $perdaperkada=$perdaperkada->update([
            'tahun'=>session('focus_tahun'),
            'perda'=>$perda,
            'id_mandat'=>$request->mandat,
            'id_urusan'=>$urusan,
            'perkada'=>$perkada,
            'kesesuaian'=>$request->kesesuaian,
            'keterangan'=>$request->keterangan,
            'id_user'=>Auth::User()->id,
            'telah_dinilai'=>1,

          ]);

        }else{

          $perda=isset($request->perda)?$request->perda:[];
          $perkada=isset($request->perkada)?$request->perkada:[];
          $perkada=json_encode($perkada);
          $perda=json_encode($perda);

          $d=PerdaPerkada::create([
            'tahun'=>session('focus_tahun'),
            'perda'=>$perda,
            'id_mandat'=>$request->mandat,
            'id_urusan'=>$urusan,
            'perkada'=>$perkada,
            'provinsi'=>$request->provinsi,
            'kota_kabupaten'=>$request->kota_kabupaten,
            'kesesuaian'=>$request->kesesuaian,
            'telah_dinilai'=>1,

            'keterangan'=>$request->keterangan,
            'id_user'=>Auth::User()->id,
          ]);

          return back();
        }
          return back();


    }


    public function form1EditMandatPerdaerah($urusan,$mandat,$provinsi=null,$kota_kabupaten,$level,Request $request){
      $data_link=Urusan23::find($urusan);
      $id_link=$urusan;

      if($level==1){
        $level='provinsi';
        $daerah=Provinsi::where('id_provinsi',$provinsi)->first()->toArray();
        $daerah['kota_kabupaten']=0;
        $daerah['id_provinsi']=(int) $daerah['id_provinsi'];
        $daerah['provinsi']=(int) $daerah['id_provinsi'];
        $daerah['id_kota']=0;


        $daerah['nama']='PROVINSI '.$daerah['nama'];


      }else{
        $level='kota_kabupaten';
        $daerah=Kabupaten::where('id_kota',$kota_kabupaten)->first()->toArray();
        $daerah['provinsi']=substr((int)$daerah['id_kota'], 0, 2);
        
      }


      $mandat_db=Mandat::find($mandat);
      $perdaperkada=PerdaPerkada::where('id_mandat',$mandat)->where('id_urusan',$urusan)
      ->where($level,$provinsi==0?$kota_kabupaten:$provinsi)
      ->where('tahun',session('focus_tahun'))
      ->first();
      
      return view('form_singkron.form1_tambah_perda_perkada')
        ->with('id_link',$id_link)
        ->with('data_link',$data_link)
        ->with('mandat',$mandat_db)
        ->with('daerah',$daerah)

        ->with('perdaperkada',$perdaperkada);
    

    }

    public function Form1Perdaerah($urusan,Request $request){
      $data_link=Urusan23::find($urusan);
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

      foreach ($kota_kab as $key => $value) {
        $kota_kab[$key]= (array) $kota_kab[$key];
        $kota_kab[$key]['mandat']=[];
        $kota_kab[$key]['id']=(int) $kota_kab[$key]['id'];
        $kota_kab[$key]['id']=(string) $kota_kab[$key]['id'];

        $mandat=Mandat::where('id_urusan',$urusan)->where('tahun',session('focus_tahun'))->with('LinkSubUrusan')->get()->toArray();
      
        if(strlen($kota_kab[$key]['id'])>2){
          $level='kota_kabupaten';
          $kota_kab[$key]['level']=2;
          $where=[['kota_kabupaten',$kota_kab[$key]['id']]];
        }else{
          $level='provinsi';
          $kota_kab[$key]['level']=1;
          $kota_kab[$key]['nama']='PROVINSI '.$kota_kab[$key]['nama'];
          $where=[['provinsi',$kota_kab[$key]['id']],['kota_kabupaten',0]];
        }

        foreach ($mandat as $m) {
           $mx=PerdaPerkada::where('id_urusan',$urusan)->where('tahun',session('focus_tahun'))->where('id_mandat',$m['id'])->where($where)->first();
           if($mx){
           $mx=$mx->toArray();

           }
           $m['perda_perkada']=$mx;

          $kota_kab[$key]['mandat'][]=$m;
        }


      }

      return view('form_singkron.form1_perdaearah')->with('id_link',$urusan)->with('data_link',$data_link)->with('datas',$kota_kab)->with('link',$back);

    }


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
    		  $mandat=($request->mandat);
    	}
	 	
	
      # code...
      $data=[
        'id_sub_urusan'=>$request->sub_urusan,
        'uu'=>$uu,
        'tahun'=>session('focus_tahun'),
        'id_urusan'=>$urusan,
        'pp'=>$pp,
        'perpres'=>$perpres,
        'permen'=>$permen,
        'mandat'=>json_encode([$value]),
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
    	$urusan=Auth::User()->haveUrusan->pluck('id');
      $urusan=Urusan23::whereIn('id',$urusan)->orderBy('nama','DESC')->get();

    	return view('form_singkron.index')->with('urusans',$urusan)->with('title','SUPD2 Data Suport Sistem');
    }

}

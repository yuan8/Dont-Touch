<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BidangUrusan;
use App\Kewenangan;
use App\Urusan23;
use App\SubUrusan23;
use Validator;
use Alert;
use Auth;
use DB;
use App\PelaksanaanLingkupSupd2Pusat;
class FormSink6 extends Controller
{
    //
    public function index($urusan,Request $request){
    	$data_link=Urusan23::find($urusan);
    	$data=PelaksanaanLingkupSupd2Pusat::where('id_urusan',$urusan)
    	->where('tahun',session('focus_tahun'))->with('Program')->paginate(20);

    	return view('form_singkron.form6')->with('menu_id','s.6')->with(['id_link'=>$urusan,'data_link'=>$data_link,'datas'=>$data]);
    }


    public function pusat_create($urusan){
    	$data_link=Urusan23::find($urusan);
    	$program=SubUrusan23::where('id_urusan',$urusan)->get();
    	return view('form_singkron.form6_pusat_tambah')->with('menu_id','s.6')->with(['program'=>$program,'id_link'=>$urusan,'data_link'=>$data_link]);
    }


    public function pusat_store($urusan,Request $request){
    	$request->request->add(['id_urusan'=>$urusan]);    	
    	$validator= Validator::make($request->all(),[
    		'program'=>'required|numeric|exists:master_sub_urusan,id',
    		'id_urusan'=>'required|numeric|exists:master_urusan,id',
    		'indikator'=>'required|string',
    		'data'=>'nullable|array',
    		'data.*'=>'nullable|string'
    	]);

    	if($validator->fails()){
    		Alert::error('','error');
    		return back();
    	}

    	$data='[]';
    	if(isset($request->data)){
    		$data=json_encode($request->data);
    	}

    	$d=PelaksanaanLingkupSupd2Pusat::create([
    		'data'=>$data,
    		'id_sub_urusan'=>$request->program,
    		'id_urusan'=>$urusan,
    		'tahun'=>session('focus_tahun'),
    		'indikator'=>$request->indikator,
    		'id_user'=>Auth::User()->id
    	]);

    	if($d){
    		Alert::success('Data Berhasil Ditambahkan','success');
    		return back();
    	}


    	
    }


    public function pusat_delete($urusan,$id){
    	$data=PelaksanaanLingkupSupd2Pusat::find($id);

    	if($data){
    		$data->delete();
    	}

    	return back();
    }


    public function pusat_show($urusan,$id){
        $data=PelaksanaanLingkupSupd2Pusat::find($id);
        if($data){
             $data_link=Urusan23::find($urusan);
        $program=SubUrusan23::where('id_urusan',$urusan)->get();
        return view('form_singkron.form6_pusat_edit')->with('menu_id','s.6')->with(['program'=>$program,'id_link'=>$urusan,'data_link'=>$data_link,'data'=>$data]);
        }


       
    }

    public function pusat_update($urusan,$id,Request $request){

       $request->request->add(['id_urusan'=>$urusan]);      
        $validator= Validator::make($request->all(),[
            'program'=>'required|numeric|exists:master_sub_urusan,id',
            'id_urusan'=>'required|numeric|exists:master_urusan,id',
            'indikator'=>'required|string',
            'data'=>'nullable|array',
            'data.*'=>'nullable|string'
        ]);

        if($validator->fails()){
            Alert::error('','error');
            return back();
        }

        $data='[]';
        if(isset($request->data)){
            $data=json_encode($request->data);
        }

        $d=PelaksanaanLingkupSupd2Pusat::find($id);

            if($d){

             $d=$d->update([
                'data'=>$data,
                'id_sub_urusan'=>$request->program,
                'id_urusan'=>$urusan,
                'tahun'=>session('focus_tahun'),
                'indikator'=>$request->indikator,
                'id_user'=>Auth::User()->id
             ]);

            if($d){
                Alert::success('Data Berhasil Ditambahkan','success');
                return back();
            }

        }else{

        }
    }


    public function daerah($urusan,Request $request){
    


        $data_link=Urusan23::find($urusan);
        
        if(!isset($request->q)||$request->q==''){
            $model=\App\Daerah::paginate(1);
        }else{
            $model=\App\Daerah::where('nama','ilike','%'.$request->q.'%')->paginate(1);
            $model=$model->appends(['q'=>$request->q]);

        }

        $daerah_show=$model->pluck('id')->toArray();
        $daerah_show= (string) "('".implode("','",$daerah_show)."')";


        $query="
        select *,c.id_urusan as kode_urusan ,d.id as id_pelaksanaan_lingkup_supd_2_daerah,d.tahun as tahun_pelaksanaan from
            (select a.nama as nama_daerah,a.id as kode_d,* from view_daerah as a ,
            (select id as kode_sub_urusan ,id_urusan,nama from master_sub_urusan where id_urusan=".$urusan.")  as b) c 
        left join pelaksanaan_lingkup_supd_2_daerah d on c.id=d.kode_daerah and c.kode_sub_urusan=d.id_sub_urusan  and d.tahun=".session('focus_tahun')." where c.id IN  ".$daerah_show;

      
        

        $data=DB::select($query);

        $data=json_encode($data,true);
        $data=json_decode($data,true);

        $data_return=[];
        $last_data='';
        $last_id=0;
        $last_data_etri_root_key=0;

        $kode_daerah=null;
        $kode_program=null;
        $kode_data=null;


        foreach ($data as $key => $d) {
            

              
            if(!isset($data_return[$d['kode_d']])){
                $data_return[$d['kode_d']]=[];
                $data_return[$d['kode_d']]['nama']=$d['nama_daerah'];
                $data_return[$d['kode_d']]['id']=$d['kode_d'];
                $data_return[$d['kode_d']]['tag_provinsi']=$d['pro'];
            }

            if(!isset($data_return[$d['kode_d']]['have_program'])){
                $data_return[$d['kode_d']]['have_program']=[];
                $data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]=[];
                $data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]['nama']=$d['nama'];
                $data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]['id']=$d['kode_sub_urusan'];
            }else if(!isset($data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']])){
                $data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]['nama']=$d['nama'];
                $data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]['id']=$d['kode_sub_urusan'];
            }else{

            }

            if(!isset($data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]['have_data'])){
                $data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]['have_data']=[];
                if($d['id_pelaksanaan_lingkup_supd_2_daerah']!=null){
                     $data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]['have_data'][$d['id_pelaksanaan_lingkup_supd_2_daerah']]=array(
                        'data'=>json_decode($d['data'],true),
                        'indikator'=>($d['indikator']),

                     );
                }
            }else{
                 if($d['id_pelaksanaan_lingkup_supd_2_daerah']!=null){
                     $data_return[$d['kode_d']]['have_program'][$d['kode_sub_urusan']]['have_data'][$d['id_pelaksanaan_lingkup_supd_2_daerah']]=array(
                        'data'=>json_decode($d['data'],true),
                        'indikator'=>($d['indikator']),
                     );
                }

            }
        }

        return view('form_singkron.form6_daerah')->with('menu_id','s.6')->with(['datas'=>$data_return,'id_link'=>$urusan,'data_link'=>$data_link,'model'=>$model]);

    }



    public function show_program_daerah($urusan,$id_daerah,$id_program){
      
        $program=SubUrusan23::find($id_program);
        $daerah=\App\Daerah::find($id_daerah);
        if($daerah and $program){
            if($program->id_urusan!=$urusan){
                return abort('401');
            }
            
            $data=\App\PelaksanaanLingkupSupd2Daerah::where('id_urusan',$urusan)
            ->where('kode_daerah',$id_daerah)
            ->where('id_sub_urusan',$id_program)
            ->where('tahun',session('focus_tahun'))
            ->orderBy('id','DESC')->get()->toArray();

            $data_pusat=\App\PelaksanaanLingkupSupd2Pusat::where('id_urusan',$urusan)
            ->where('id_sub_urusan',$id_program)
            ->where('tahun',session('focus_tahun'))
            ->orderBy('id','DESC')->get()->toArray();

            

            $data_link=Urusan23::find($urusan);


            return view('form_singkron.form6_daerah_show')->with(
                [
                    'id_link'=>$urusan,
                    'data_link'=>$data_link,
                    'data'=>$data,
                    'data_pusat'=>$data_pusat,
                    'program'=>$program,
                    'daerah'=>$daerah,
                    'menu_id'=>'s.6'
                ]);
        }else{

            return abort('404');
        }



        // dd($data);

    }


    public function delete_program_daerah($urusan,$id){

        $data=\App\PelaksanaanLingkupSupd2Daerah::where('id',$id)
        ->where('id_urusan',$urusan)
        ->where('tahun',session('focus_tahun'))
        ->first();

        if($data){
            $data->delete();
        }else{

        }

        return back();
    }

    public function update_program_daerah($urusan,$id,Request $request){

         $data=\App\PelaksanaanLingkupSupd2Daerah::where('id',$id)
            ->where('id_urusan',$urusan)
            ->where('tahun',session('focus_tahun'))
            ->first();

        if($data){
            $data_indikator='[]';
            if($request->data){
                $data_indikator=[];
                foreach ($request->data as $key => $value) {
                    if($value!="" && $value!=null ){
                        $data_indikator[]=$value;
                    }
                }

                $data_indikator=json_encode($data_indikator);
            }else{

            }

            $data->update([
                'indikator'=>$request->indikator,
                'data'=>$data_indikator
            ]);
        }else{

        }

        return back();
    }


    public function add_program_daerah($urusan,$id_program,$id_daerah,Request $request){

        $data='[]';
        if($request->data){
            $data=json_encode($request->data);
        }

        $data=\App\PelaksanaanLingkupSupd2Daerah::create([
            'id_urusan'=>$urusan,
            'id_sub_urusan'=>$id_program,
            'kode_daerah'=>$id_daerah,
            'tahun'=>session('focus_tahun'),
            'indikator'=>$request->indikator,
            'data'=>$data,
            'id_user'=>Auth::User()->id
        ]);


        return back();

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DBS\FormMainOne;
use Alert;
class FormController extends Controller
{
    //

    public function form1(){
      return view('init.input.form1');
    }

    public function Form1Edit($id){
      $data=FormMainOne::with(['listUu','listPp','listPermen','listPerpres','listPerkada','listPerkada'])->where('id',$id)->first()->toArray();
      if($data){
        return view('init.edit.form1')->with('data',$data);
      }else{
        return abort('404');
      }

    }

    public function Form1Store(Request $request){
      if($request->f){
        $datas=$request->f;
        $main=FormMainOne::create([
          'k_sub_urusan'=>$datas['sub_urusan'],
          'k_mandat'=>$datas['mandat'],
          'k_kesesuaian'=>$datas['kesesuian'],
          'k_keterangan'=>$datas['keterangan'],

        ]);

        foreach ($datas['perda'] as $key => $value) {
          if(str_replace(' ', '', $value)!=''){
            $main->listPerda()->create([
              'nama_perda'=>$value
            ]);
          }
        }

        foreach ($datas['perkada'] as $key => $value) {
          if(str_replace(' ', '', $value)!=''){
            $main->listPerkada()->create([
              'nama_perkada'=>$value
            ]);
          }
        }


        if(isset($datas['uu'])){
          $main->listUu()->sync($datas['uu']);
        }
        
        if(isset($datas['mandat'])){
          $main->listMandat()->sync($datas['mandat']);
        }

        if(isset($datas['perpres'])){
          $main->listPerpres()->sync($datas['perpres']);
        }

        if(isset($datas['permen'])){
          $main->listPermen()->sync($datas['permen']);
        }

        if(isset($datas['pp'])){
          $main->listPp()->sync($datas['pp']);
        }

        Alert::success('Success','Data Berhasil di Tambahkan');
        return back();

      }
    }

    public function From1Update(Request $request){

    }



}

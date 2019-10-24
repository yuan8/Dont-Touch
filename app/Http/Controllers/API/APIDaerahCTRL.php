<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Kabupaten;
class APIDaerahCTRL extends Controller
{
    //

    public function kabupatenFromProvinsiId(Request $request){

        $validator=Validator::make($request->all(),[
          'id_provinsi'=>'required|exists:provinsi,id_provinsi',
        ]);

        if($validator->fails()){
          return array(
            'code'=>200,
            'message'=>'fail',
            'data'=>[]
          );
        }else{
          $return=[];
          $kabupatens=Kabupaten::where('id_kota','like',($request->id_provinsi.'%'))
          ->orderBy('nama','ASC')->get()->toArray();

          $return[]=array('id_kota'=>0,'nama'=>'-- Khusus Provinsi --');
         
            foreach ($kabupatens as $key => $value) {
              $return[]=$value;
            }

            return $return;
        
        }

    }
}

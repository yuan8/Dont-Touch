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
          $kabupatens=Kabupaten::where('id_provinsi',($request->id_provinsi))
          ->orderBy('nama','ASC')->get();
          return $kabupatens;
        }

    }
}

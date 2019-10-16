<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BidangUrusan;
use App\Urusan;

class UrusanCTRL extends Controller
{
    //

    public function index(){
      $urusans=BidangUrusan::all();
      BidangUrusan::create([
        'kode'=>103,
        'nama_bidang_urusan'=>'Bidang Urisan 1'
      ]);
      Urusan::create([
        'kode'=>1,
        'nama_urusan'=>'Bidang Urisan 1'
      ]);

      $urusans=BidangUrusan::all();
      dd($urusans);
    }
}

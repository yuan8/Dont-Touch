<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    
    {   
        $dt=DB::select("
            select kode_daerah , count(*) as jumlah_kegiatan, sum(anggaran) as jumlah_anggaran  FROM program_kegiatan_lingkup_supd_2 GROUP BY kode_daerah
        ");
     



        return view('home')->with('data_provinsi',$dt)->with('title','TINGKAT KEPATUHAN PELAPORAN PER URUSAN');
    }
}

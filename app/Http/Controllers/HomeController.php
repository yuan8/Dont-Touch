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

        $query="select c.id,sum(c.jumlah_kota) as jumlah_daerah,sum(c.jumlah_kegiatan) as jumlah_kegiatan, sum(c.jumlah_kegiatan_provinsi) as jumlah_kegiatan_provinsi from (
    
            select count(a.*) jumlah_kegiatan_provinsi,  a.kode_daerah as id, 1 as jumlah_kota,count(a.*) jumlah_kegiatan from public.program_kegiatan_lingkup_supd_2 as a group by a.kode_daerah
            union 
            select 0 as jumlah_kegiatan_provinsi, b.kode_daerah as id, 1 as jumlah_kota ,count(b.*) as jumlah_kegiatan from program_kegiatan_lingkup_supd_2_kotakab as b group by b.kode_daerah


            ) as c group by c.jumlah_kota,c.jumlah_kegiatan,c.id";


        $dt=DB::select("
            select kode_daerah , count(*) as jumlah_kegiatan, sum(anggaran) as jumlah_anggaran  FROM program_kegiatan_lingkup_supd_2 GROUP BY kode_daerah
        ");
     



        return view('home')->with('data_provinsi',$dt)->with('title','JUMLAH KEGIATAN dan ANGGARAN');
    }
}

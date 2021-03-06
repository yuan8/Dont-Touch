<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('init/{tahun?}', 'DashboardController@landing')->name('home');

Route::get('tt','DashboardController@test');

Route::get('testing-alert', function(){

  $f=json_decode(file_get_contents(public_path('mp\source.json')), true);

  $json=$f['features'];

  
  foreach ($json as $key => $value) {
    if($value['properties']['woe-name']!=null){
      $p=DB::table('provinsi')->where('nama','ilike',('%'.$value['properties']['woe-name'].'%'))->first();
      if($p){
        $json[$key]['properties']['id_daerah']=(string) $p->id_provinsi;
      }else{
        dd($value);
      }
    }

   
  }

  $f['features']=$json;

 $newJsonString = json_encode($f);

  file_put_contents(public_path('mp/ok/geo_indo.json'), stripslashes($newJsonString));

  return 'ok';
  // Alert::success('dd','dd');
  // return view('t');
});

Route::get('/', function(){
  return redirect()->route('home',['tahun'=>2020]);
})->name('index');


Route::get('/generate-data','GenerateData@urusan_23');
Route::get('/generate-data/program','GenerateData@sipd');
Route::get('/generate-data/kegiatan','GenerateData@sipd_kegiatan');

Route::get('/excel', 'ExcelSIPD@read');
Route::get('/profile', 'UserController@profile')->name('profile');


Route::get('/excel-download', 'ExcelSIPD@getExcel');

Route::prefix('/data/{tahun?}')->group(function(){
  Route::get('/kegiatan-supd2', 'KegiatanSupd2Ctrl@index')->name('data.kegiatan_spud2_provinsi_table');
  Route::get('/kegiatan-supd2-chart', 'KegiatanSupd2Ctrl@chart')->name('data.kegiatan_spud2_provinsi_chart');

  Route::get('/', 'DashboardController@index')->name('data.index');
  Route::get('/anggaran', 'DashboardController@anggaran')->name('data.anggaran');
  Route::get('/tagging', 'DashboardController@tagging')->name('data.tagging');
  Route::get('/profile-daerah', 'DashboardController@tingkatan')->name('data.tingkatan');
  Route::get('/profile-urusan', 'DashboardController@tingkatan_urusan')->name('data.tingkatan_urusan');
  Route::get('/nuwas', 'DashboardController@nuws')->name('data.nuwas');
  Route::get('/kegiatan-pendukung', 'DashboardController@k_pendukung')->name('data.pendukung');
  Route::get('/kegiatan-pendukung-2', 'DashboardController@k_pendukung')->name('data.pendukung2');

  Route::get('/mapper','DashboardController@test')->name('data.mapper');

});



Route::prefix('data-nuwas/data/{tahun?}')->group(function(){
  Route::get('/',function(){

    return redirect()->route('n.init',['tahun'=>2020]);
  });

  Route::get('init','NuwasController@index')->name('n.init');
  Route::get('profile-daerah/program-kegiatan','NuwasController@program_kegiatan_table')->name('n.program_kegiatan_table');

    Route::get('profile-kebijakan/','NuwasController@kebijakan')->name('n.kebijakan');
    Route::get('profile-kebijakan/daerah','NuwasController@kebijakanDaerah')->name('n.kebijakanDaerah');



});

Route::prefix('auth')->group(function(){
    Auth::routes();
});



Route::middleware('auth:web')->group(function(){
  Route::get('/home', 'HomeController@index')->name('maps');
});




Route::prefix('admin')->middleware('auth:web')->group(function(){
  Route::get('/', 'AdminCTRL@index')->name('admin.index');
  Route::post('/rubah-tahun', 'AdminCTRL@rubah_tahun')->name('rubah_tahun');
  Route::post('/rubah-tahun/dashboard', 'AdminCTRL@rubah_tahun_dashboard')->name('rubah_tahun_dashboard');

  Route::get('/ts', 'AdminCTRL@ts')->name('ts');



  Route::prefix('form')->group(function(){
    Route::get('/mandat', 'AdminCTRL@madat')->name('admin.form.mandat');


    Route::get('/index', 'AdminCTRL@form')->name('admin.form');
    Route::get('/form-input-1', 'FormController@form1')->name('admin.form1');
    Route::post('form1/store', 'FormController@Form1Store')->name('form_1.store');

    Route::get('form1/edit/{id}', 'FormController@Form1Edit')->name('form_1.edit');
    Route::put('form1/update/{id}', 'FormController@Form1Edit')->name('form_1.update');


    Route::get('/form-input-2', 'FormController@form2')->name('admin.form2');
    Route::post('form2/store', 'FormController@Form1Store')->name('form_1.store');

  });

});



Route::prefix('sinkkron/initilisasi')->middleware('auth:web')->group(function(){
  Route::get('/','FormSink@index')->name('fs.index');

});


Route::prefix('sinkron')->middleware(['auth:web','can:route_access,bidang_urusan_link'])->group(function(){




  Route::get('/bidang/{bidang_urusan_link}/f1/perdaerah','FormSink@Form1Perdaerah')->name('fs.f1.perdaerah');
  Route::get('/bidang/{bidang_urusan_link}/f1','FormSink@form1')->name('fs.f1.index');
  Route::get('/bidang/{bidang_urusan_link}/f1/edit/{id}','FormSink@form1Edit')->name('fs.f1.edit');

  Route::put('/bidang/{bidang_urusan_link}/f1/edit/{id}','FormSink@form1Update')->name('fs.f1.update');

  Route::get('/bidang/{bidang_urusan_link}/f1/tambah-mandat','FormSink@form1TambahMandat')->name('fs.f1.tambah');

  Route::get('/bidang/{bidang_urusan_link}/f1/edit/mandat/perdaerah/{mandat}/{provinsi?}/{kota_kab?}/{level}','FormSink@form1EditMandatPerdaerah')->name('fs.f1.edit_mandat_perdaerah');

  Route::get('/bidang/{bidang_urusan_link}/f1/penilaian','FormSink@form1Penilaian')->name('fs.f1.penilaian');

  Route::get('/bidang/{bidang_urusan_link}/f1/perda-perkada','FormSink@form1PerdaPerkada')->name('fs.f1.perda.perkada');

  Route::post('/bidang/{bidang_urusan_link}/f1/perda-perkada','FormSink@form1PerdaPerkadaFilter')->name('fs.f1.perda.perkada.filter');

  Route::get('/bidang/{bidang_urusan_link}/f1/perda-perkada/{provinsi}/{kota?}','FormSink@form1PerdaPerkadaPerdaearah')->name('fs.f1.perda.perkada.perdaerah');


  Route::get('/bidang/{bidang_urusan_link}/f1/perda-perkada/{provinsi}/{kota?}/tambah','FormSink@form1PerdaPerkadaPerdaearahTambah')->name('fs.f1.perda.perkada.perdaerah.tambah');

  Route::post('/bidang/{bidang_urusan_link}/f1/perda-perkada/up-or-store','FormSink@form1PerdaPerkadaPerdaearahUpStore')->name('fs.f1.perda.perkada.perda.up.or.store');

  Route::post('/bidang/{bidang_urusan_link}/f1/perda-perkada/delete','FormSink@form1PerdaPerkadaPerdaearahDelete')->name('fs.f1.perda.perkada.perda.delete');

  Route::post('/bidang/{bidang_urusan_link}/f1/perda-perkada/{provinsi}/{kota?}/tambah','FormSink@form1PerdaPerkadaPerdaearahStore')->name('fs.f1.perda.perkada.perdaerah.store');



  Route::get('/bidang/{bidang_urusan_link}/f6','FormSink6@index')->name('fs.f6.index');
  Route::get('/bidang/{bidang_urusan_link}/f6/pusat/tambah','FormSink6@pusat_create')->name('fs.f6.pusat_create');

  Route::post('/bidang/{bidang_urusan_link}/f6/pusat/tambah','FormSink6@pusat_store')->name('fs.f6.pusat_store');

  Route::post('/bidang/{bidang_urusan_link}/f6/pusat/tambah','FormSink6@pusat_store')->name('fs.f6.pusat_store');

  Route::delete('/bidang/{bidang_urusan_link}/f6/pusat/delete/{id}','FormSink6@pusat_delete')->name('fs.f6.pusat_delete');

  Route::get('/bidang/{bidang_urusan_link}/f6/pusat/update/{id}','FormSink6@pusat_show')->name('fs.f6.pusat_show');

  Route::put('/bidang/{bidang_urusan_link}/f6/pusat/update/{id}','FormSink6@pusat_update')->name('fs.f6.pusat_update');


  Route::get('/bidang/{bidang_urusan_link}/f6/daerah','FormSink6@daerah')->name('fs.f6.daerah');

  Route::get('/bidang/{bidang_urusan_link}/f6/daerah/show/{id_daerah}/{id_program}','FormSink6@show_program_daerah')->name('fs.f6.show_program_daerah');


  Route::delete('/bidang/{bidang_urusan_link}/f6/daerah/delete/{id}','FormSink6@delete_program_daerah')->name('fs.f6.delete_program_daerah');

  Route::put('/bidang/{bidang_urusan_link}/f6/daerah/update/{id}','FormSink6@update_program_daerah')->name('fs.f6.update_program_daerah');



  Route::put('/bidang/{bidang_urusan_link}/f6/daerah/add/{id_program}/{id_daerah}','FormSink6@add_program_daerah')->name('fs.f6.add_program_daerah');






  Route::get('/bidang/{bidang_urusan_link}/f2','FormSink2@index')->name('fs.f2.index');

  Route::get('/bidang/{bidang_urusan_link}/f2/edit/{id}','FormSink2@show')->name('fs.f2.show');
  Route::put('/bidang/{bidang_urusan_link}/f2/edit/{id}','FormSink2@update')->name('fs.f2.update');

  Route::delete('/bidang/{bidang_urusan_link}/f2/edit/{id}','FormSink2@delete')->name('fs.f2.delete');

  Route::get('/bidang/{bidang_urusan_link}/f2/tambah','FormSink2@create')->name('fs.f2.tambah');

  Route::post('/bidang/{bidang_urusan_link}/f2/tambah','FormSink2@store')->name('fs.f2.store');

  Route::get('/bidang/{bidang_urusan_link}/f3','FormSink3@index')->name('fs.f3.index');

  Route::put('/bidang/{bidang_urusan_link}/f3/edit/indikator/{id}','FormSink3@update_indikator')->name('fs.f3.update_indikator');



  Route::post('/bidang/{bidang_urusan_link}/f3/update/target/{id}','FormSink3@target_update')->name('fs.f3.target_update');


  Route::delete('/bidang/{bidang_urusan_link}/f3/update/target/{id}/{id_target}','FormSink3@target_delete')->name('fs.f3.target_delete');

   Route::delete('/bidang/{bidang_urusan_link}/f3/update/propn/{id}/{id_propn}','FormSink3@propn_delete')->name('fs.f3.propn_delete');




  Route::get('/bidang/{bidang_urusan_link}/f3/tambah-f3/{id_master_pn}','FormSink3@create')->name('fs.f3.tambah');

  Route::get('/bidang/{bidang_urusan_link}/f3/tambah','FormSink3@listPN')->name('fs.f3.tambah.listPN');


  Route::post('/bidang/{bidang_urusan_link}/f3/tambah','FormSink3@store')->name('fs.f3.store');

  Route::put('/bidang/{bidang_urusan_link}/f3/edit/{id}','FormSink3@update')->name('fs.f3.update');

  Route::get('/bidang/{bidang_urusan_link}/f3/edit/{id}','FormSink3@show')->name('fs.f3.show');

  Route::delete('/bidang/{bidang_urusan_link}/f3/delete/{id}','FormSink3@delete')->name('fs.f3.delete');



  Route::get('/bidang/{bidang_urusan_link}/f4','FormSink4@index')->name('fs.f4.index');

  Route::get('/bidang/{bidang_urusan_link}/f4/{provinsi?}/{kota_kabupaten?}/tambah','FormSink4@create')->name('fs.f4.tambah');


  Route::get('/bidang/{bidang_urusan_link}/f4/show/{id}','FormSink4@show')->name('fs.f4.show');


  Route::put('/bidang/{bidang_urusan_link}/f4/show/{id}','FormSink4@update')->name('fs.f4.update');


  Route::delete('/bidang/{bidang_urusan_link}/f4/delete/{id}','FormSink4@delete')->name('fs.f4.delete');

  Route::post('/bidang/{bidang_urusan_link}/f4/tambah','FormSink4@store')->name('fs.f4.store');

  Route::get('/bidang/{bidang_urusan_link}/f5','FormSink5@index')->name('fs.f5.index');

  Route::post('/bidang/{bidang_urusan_link}/f5/update/{id}','FormSink5@update_jenis_kegiatan')->name('fs.f5.update_jenis_kegiatan');


  Route::get('/bidang/{bidang_urusan_link}/f6','FormSink6@index')->name('fs.f6.index');

  Route::get('/bidang/{bidang_urusan_link}/f7','FormSink7@index')->name('fs.f7.index');
  Route::get('/bidang/{bidang_urusan_link}/f7/identifikasi-tahunan/{id}','FormSink7@showIndetifikasiTahunan')->name('fs.f7.show.identifikasi.tahunan');


    Route::post('/bidang/{bidang_urusan_link}/f7/identifikasi-tahunan/','FormSink7@showIndetifikasiTahunan')->name('fs.f7.show.identifikasi.add_sub_provinsi]');



 Route::get('/bidang/{bidang_urusan_link}/f7/integrasi/provinsi','FormSink7@integrasi_provinsi')->name('fs.f7.identifikasi.integrasi_provinsi');
 


 Route::get('/bidang/{bidang_urusan_link}/f7/integrasi/provinsi/{kode_daerah}/tambah/target/{id_target_pusat}','FormSink7@integrasi_provinsi_tambah')->name('fs.f7.identifikasi.integrasi_provinsi_tambah');

 Route::get('/bidang/{bidang_urusan_link}/f7/integrasi/kota-kabupaten','FormSink7@integrasi_kota_kabupaten')->name('fs.f7.identifikasi.integrasi_kota_kabupaten');


  Route::get('/bidang/{bidang_urusan_link}/f8','FormSink8@index')->name('fs.f8.index');
  Route::get('/bidang/{bidang_urusan_link}/f9','FormSink8@index')->name('fs.f9.index');
  Route::get('/bidang/{bidang_urusan_link}/f10','FormSink10@index')->name('fs.f10.index');

  Route::delete('bidang/{bidang_urusan_link?}/f1/delete/','FormSink@form1delete')->name('fs.f1.delete');
  Route::post('bidang/{bidang_urusan_link?}/f1/store','FormSink@Form1Store')->name('fs.form1.store');

});

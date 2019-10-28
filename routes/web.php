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

Route::get('/', function () {
    Alert::success('Success Message', 'Optional Title');
    return view('welcome');
});

 Route::get('/vertion', function(){
    // dd('new vertion');
  // dd(\App\DBS\FormMainOne::all());

});



Route::get('/excel', 'ExcelSIPD@read');
Route::get('/excel-download', 'ExcelSIPD@getExcel');

Auth::routes();
Route::middleware('auth:web')->group(function(){

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/test', function(){
    // $anu=App\DBS\FormMainOne::with('listUu')->get()->toJson();
    // return ($anu);
    dd(shell_exec('chmode -R 777 '.storage_path('')));
    // return HP::GenerateTokenApi();

  });




  Route::get('/generate', function(){
      $prefix_dir=public_path('geojson/');
      $dirr= scandir(public_path('geojson/'));
      foreach ($dirr as $key_file => $valdirr) {
          if($key_file>1){
            $data=file_get_contents($prefix_dir.$valdirr);
            $name_file=explode("_",$valdirr)[1];
            $name_file=explode(".geojson",$name_file)[0];

            $file_mp=DB::table('provinsi')->where('nama_singkat','ILIKE','%'.$name_file.'%')->first();
            if($file_mp){
              $id_file='mp.id'.$file_mp->id_provinsi.'.js';
            }else{

              dd('G_cocok '. $name_file);
            }


            // $data=str_replace('Highcharts.maps["idn"] =','',$data);
            $data=json_decode($data,true);
            $data2=$data['features'];
            foreach ($data2 as $key => $value) {
                  // $name=$data2[$key]['properties']['name'];

                  $name=$data2[$key]['properties']['WAP'];
                  $data2[$key]['properties']=[];
                  $data2[$key]['properties']['type']='map-kota-kab';
                  $data2[$key]['properties']['lat']='';
                  $data2[$key]['properties']['lng']='';
                  $data2[$key]['properties']['file']='#ffddcc';
                  $data2[$key]['properties']['file-opacity']=0.5;

                  if($name=='Kota Sawahlunto'){
                    $name='kota Sawah Lunto';
                  }


                 $db=DB::table('kabupaten')->where('nama','ILIKE','%'.$name.'%')->first();
                 if($db){
                   $data2[$key]['properties']['id_daerah']=$db->id_kabupaten;
                   $data2[$key]['properties']['name']=$name;

                 }else{
                   $name=str_replace('-',' ',$name);
                   $name=str_replace('Raya','',$name);
                   $name=str_replace('Jakarta ','Jakarta',$name);

                   $db=DB::table('kabupaten')->where('nama','like','%'.$name.'%')->first();
                   if($db){
                     $data2[$key]['properties']['id_daerah']=$db->id_kabupaten;
                   }else{
                     dd($name);
                   }


                 }
            }

            $data['features']=$data2;
            $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
            Storage::put('public/file-json-daerah/mp/mp.id0kk.js',stripslashes($newJsonString));

          }
      }


  });



});




Route::prefix('admin')->middleware('auth:web')->group(function(){
  Route::get('/', 'AdminCTRL@index')->name('admin.index');

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




Route::prefix('sinkron')->middleware('auth:web')->group(function(){
  Route::get('/','FormSink@index')->name('fs.index');

  Route::get('/bidang/{bidang_urusan_link}/f1','FormSink@form1')->name('fs.f1.index');
  Route::get('/bidang/{bidang_urusan_link}/f1/tambah-mandat','FormSink@form1TambahMandat')->name('fs.f1.tambah');

  Route::get('/bidang/{bidang_urusan_link}/f1/penilaian','FormSink@form1Penilaian')->name('fs.f1.penilaian');
  Route::get('/bidang/{bidang_urusan_link}/f1/perda-perkada','FormSink@form1PerdaPerkada')->name('fs.f1.perda.perkada');
  Route::post('/bidang/{bidang_urusan_link}/f1/perda-perkada','FormSink@form1PerdaPerkadaFilter')->name('fs.f1.perda.perkada.filter');

   Route::get('/bidang/{bidang_urusan_link}/f1/perda-perkada/{provinsi}/{kota?}','FormSink@form1PerdaPerkadaPerdaearah')->name('fs.f1.perda.perkada.perdaerah');

 Route::get('/bidang/{bidang_urusan_link}/f1/perda-perkada/{provinsi}/{kota?}/tambah','FormSink@form1PerdaPerkadaPerdaearahTambah')->name('fs.f1.perda.perkada.perdaerah.tambah');



  Route::get('/bidang/{bidang_urusan_link}/f6','FormSink6@index')->name('fs.f6.index');
  Route::get('/bidang/{bidang_urusan_link}/f2','FormSink2@index')->name('fs.f2.index');
  Route::get('/bidang/{bidang_urusan_link}/f2/tambah','FormSink2@create')->name('fs.f2.tambah');

    Route::post('/bidang/{bidang_urusan_link}/f2/tambah','FormSink2@store')->name('fs.f2.store');

  Route::get('/bidang/{bidang_urusan_link}/f3','FormSink3@index')->name('fs.f3.index');


  Route::get('/bidang/{bidang_urusan_link}/f4','FormSink4@index')->name('fs.f4.index');

  Route::get('/bidang/{bidang_urusan_link}/f4/tambah','FormSink4@create')->name('fs.f4.tambah');

  Route::post('/bidang/{bidang_urusan_link}/f4/tambah','FormSink4@store')->name('fs.f4.store');

  Route::get('/bidang/{bidang_urusan_link}/f5','FormSink5@index')->name('fs.f5.index');
  Route::get('/bidang/{bidang_urusan_link}/f6','FormSink6@index')->name('fs.f6.index');
  Route::get('/bidang/{bidang_urusan_link}/f7','FormSink7@index')->name('fs.f7.index');
  Route::get('/bidang/{bidang_urusan_link}/f8','FormSink8@index')->name('fs.f8.index');
  Route::get('/bidang/{bidang_urusan_link}/f9','FormSink8@index')->name('fs.f9.index');
  Route::get('/bidang/{bidang_urusan_link}/f10','FormSink10@index')->name('fs.f10.index');









  // Route::get('/test',function(){
  //   $anu=HP::getIdsUrusanHandle(Auth::user());
  //   dd($anu);
  // });
  Route::put('bidang/{bidang_urusan?}/f1/update','FormSink@form1Update')->name('fs.f1.update');
  Route::delete('bidang/{bidang_urusan?}/f1/delete/','FormSink@form1delete')->name('fs.f1.delete');
  Route::post('bidang/{bidang_urusan?}/f1/store','FormSink@Form1Store')->name('fs.form1.store');

});

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('daerah')->group(function(){

    Route::post('kabupaten-from-provinsi-id','API\APIDaerahCTRL@kabupatenFromProvinsiId')->name('api.daerah.kab.id_pro');

});

Route::prefix('all/{tuhun?}')->group(function(){

   Route::post('get-kegiatan','DashboardController@get_kegiatan')->name('api.all.get_kegiatan');
   Route::post('get-kegiatan-tagging','DashboardController@get_kegiatan_tagging')->name('api.all.get_kegiatan_tagging');


});

Route::prefix('form')->middleware('auth:api')->group(function(){
	
  Route::post('get-list-mandat','API\APIForm@getListMandat');

  Route::post('form-data-mandat','API\APIForm@tableMandat');
  Route::post('form-input-mandat','API\APIForm@formMandat');


  Route::post('f5/pkl-sipd-2/provinsi/update/{id}','FormSink5@update_pkl_supd_2');



  Route::post('get-data-form1','API\APIForm@getForm1')->name('api.get.data.form1');
  Route::post('get-data-form2','API\APIForm@getForm2')->name('api.get.data.form2');
  Route::post('get-data-list-from-tb','API\APIForm@getList')->name('api.get.data.list.source');
  Route::post('add-data-master','API\APIForm@addDataMaster')->name('api.post.data.list.add.master');

  Route::post('f5-update','API\APIForm@f5_update_jenis')->name('api.post.f5.update.jenis');



});


Route::prefix('nomenklatur')->middleware('auth:api')->group(function(){
  
    Route::post('program-to-kegiatan-provinsi','NomenKlaturCTRL@getKegiatanProvinsiFromProgram')->name('nomen.program.kegiatan');
    Route::post('kegiatan-to-sub_kegiatan-provinsi','NomenKlaturCTRL@getSubKegiatanProvinsiFromKegiatan')->name('nomen.kegiatan.sub_kegiatan');

});



Route::get('them-tr-f1','API\FormController@Trf1');


Route::post('dynamic/{tahun?}','DynamicNested@createData');



Route::post('kegiatan_pendukung/nspk/{tahun}','DashboardController@kegiatan_pendukung_nspk');
Route::post('kegiatan_pendukung/sdgs/{tahun}','DashboardController@kegiatan_pendukung_sdgs');
Route::post('kegiatan_pendukung/pn/{tahun}','DashboardController@kegiatan_pendukung_pn');
Route::post('kegiatan_pendukung/spm/{tahun}','DashboardController@kegiatan_pendukung_spm');



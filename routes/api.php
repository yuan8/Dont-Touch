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
Route::prefix('form')->middleware('auth:api')->group(function(){
	
  Route::post('get-list-mandat','API\APIForm@getListMandat');

  Route::post('form-data-mandat','API\APIForm@tableMandat');
  Route::post('form-input-mandat','API\APIForm@formMandat');


  Route::post('get-data-form1','API\APIForm@getForm1')->name('api.get.data.form1');
  Route::post('get-data-form2','API\APIForm@getForm2')->name('api.get.data.form2');
  Route::post('get-data-list-from-tb','API\APIForm@getList')->name('api.get.data.list.source');
  Route::post('add-data-master','API\APIForm@addDataMaster')->name('api.post.data.list.add.master');


});

Route::get('them-tr-f1','API\FormController@Trf1');

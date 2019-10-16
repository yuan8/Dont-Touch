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
    return view('welcome');
})->middleware('guest:web');

Auth::routes();
Route::middleware('auth:web')->group(function(){
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/urusan', 'UrusanCTRL@index')->name('urusan.index');


});

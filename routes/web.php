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
});


Route::get('/videos/form','VideoController@uploadForm');
Route::post('/videos/upload','VideoController@upload');

Route::get('/images/adsform','ImageController@adsUploadForm');
Route::post('/images/adsupload','ImageController@adsUpload');

Route::get('/images/promosform','ImageController@promosUploadForm');
Route::post('/images/promosupload','ImageController@promosUpload');

Route::get('/', array('uses'=>'VideoController@getVideos'));
Route::get('watchvideo', array('uses'=>'VideoController@watchVideo'));
Route::get('music',array('uses'=>'MusicController@index'));
Route::get('musicplayer',array('uses'=>'MusicController@playMusic'));
Route::post('addtoplaylist',array('uses'=>'MusicController@addToPlaylist'));

Route::get('postConnection', array('uses'=>'ClientController@postConnection'));
Route::get('checkConnection', array('uses'=>'ClientController@checkConnection'));
Route::get('insertSurvey', array('uses'=>'ClientController@insertSurvey'));


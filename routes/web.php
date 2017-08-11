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


Route::get('/public/videos/form','VideoController@uploadForm');
Route::post('/public/videos/upload','VideoController@upload');
Route::get('/public/videos/list','VideoController@listMovie');

Route::get('/public/images/adsform','ImageController@adsUploadForm');
Route::get('/public/images/adslist','ImageController@adsList');
Route::post('/public/images/adsupload','ImageController@adsUpload');

Route::get('/public/images/promosform','ImageController@promosUploadForm');
Route::post('/public/images/promosupload','ImageController@promosUpload');

Route::get('/test/id3','TestController@testId3');

Route::get('/', array('uses'=>'VideoController@getVideos'));
Route::get('watchvideo', array('uses'=>'VideoController@watchVideo'));
Route::get('music',array('uses'=>'MusicController@index'));
Route::get('musicplayer',array('uses'=>'MusicController@playMusic'));
Route::post('addtoplaylist',array('uses'=>'MusicController@addToPlaylist'));
Route::get('getallmusic',array('uses'=>'MusicController@fetchAllMusic'));

Route::get('postConnection', array('uses'=>'ClientController@postConnection'));
Route::get('checkConnection', array('uses'=>'ClientController@checkConnection'));
Route::get('insertSurvey', array('uses'=>'ClientController@insertSurvey'));


Route::get('/public/music/form','AdminMusicController@musicForm');
Route::post('/public/music/upload','AdminMusicController@musicUpload');
Route::post('/public/music/list','AdminMusicController@musicList');

Route::get('adHits', array('uses'=>'ClientController@adHits'));
Route::get('adPromoHits', array('uses'=>'ClientController@adPromoHits'));



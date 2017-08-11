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
Route::get('/videos/list','VideoController@listMovie');

Route::get('/images/adsform','ImageController@adsUploadForm');
Route::get('/images/adslist','ImageController@adsList');
Route::post('/images/adsupload','ImageController@adsUpload');

Route::get('/images/promosform','ImageController@promosUploadForm');
Route::post('/images/promosupload','ImageController@promosUpload');

Route::get('/test/id3','TestController@testId3');

Route::get('/', array('uses'=>'VideoController@getVideos'));
Route::get('watchvideo', array('uses'=>'VideoController@watchVideo'));
Route::get('audios',array('uses'=>'MusicController@index'));
Route::get('musicplayer',array('uses'=>'MusicController@playMusic'));
Route::post('addtoplaylist',array('uses'=>'MusicController@addToPlaylist'));
Route::get('getallmusic',array('uses'=>'MusicController@fetchAllMusic'));

Route::get('postConnection', array('uses'=>'ClientController@postConnection'));
Route::get('checkConnection', array('uses'=>'ClientController@checkConnection'));
Route::get('insertSurvey', array('uses'=>'ClientController@insertSurvey'));


Route::get('/music/form','AdminMusicController@musicForm');
Route::post('/music/upload','AdminMusicController@musicUpload');
Route::post('/music/list','AdminMusicController@musicList');

Route::get('adHits', array('uses'=>'ClientController@adHits'));
Route::get('adPromoHits', array('uses'=>'ClientController@adPromoHits'));



<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use App\Video;


class VideoController extends Controller
{
    public function uploadForm(){
        return view('video.uploadform');
    }

    public function upload(Request $request){
        $validateVideo = $this->validateVideoUpload(Input::file('file'));
        if($validateVideo){

            try{
                $file = $request->file('file');
                $destinationPath = config('app.VIDEO_UPLOAD_DIR');
                $movieFilename = $this->removeWhiteSpace($file->getClientOriginalName());
                $file->move($destinationPath,$movieFilename);

                $posterFile = $request->file('posterFile');
                $posterFilename = pathinfo(Input::file('file')->getClientOriginalName(), PATHINFO_FILENAME);
                $posterFilename = $this->removeWhiteSpace($posterFilename).".JPG";
                $posterFile->move($destinationPath,$posterFilename);

                $origFileName = $file->getClientOriginalName();
                $movieTitleInput = Input::get('movie-name');
                $viewData = [
                    'movietitle'=>$movieTitleInput,
                    'movieFileName'=>$origFileName
                ];

                $videoModelInstance = new Video();
                $dbData = [
                    'movieTitle'=>$movieTitleInput,
                    'moviePath'=>config('app.VIDEO_UPLOAD_DIR').$movieFilename,
                    'posterPath'=>config('app.VIDEO_UPLOAD_DIR').$posterFilename,
                    'subtitlePath'=>''
                ];
                $saveStatus = $videoModelInstance->saveVideo($dbData);
                if($saveStatus){
                    return view('video.success',array('data'=>$viewData));
                }else{
                    return false;
                }
                
            } catch (Exception $e) {
                Log::error("AppVideo::upload()  " . $e->getMessage());
                $this->data['message'] = Lang::get('messages.image_upload_fail');
                $this->utilObj->renderJson('error', $this->data);
                return false;
            }
            
        }
    }

    private function validateVideoUpload($file){
        
        $mime = $file->getMimeType();
        if($mime == "video/x-flv" || 
            $mime == "video/mp4" || 
            $mime == "application/x-mpegURL" || 
            $mime == "video/MP2T" || 
            $mime == "video/3gpp" || 
            $mime == "video/quicktime" || 
            $mime == "video/x-msvideo" || 
            $mime == "video/x-ms-wmv"){
                return true;
        } else{
            return false;   
        }
    }

    // Client video fetch
    public function getVideos(){
    	$videoList = DB::table('videos')->paginate(10);
    	return view('client.client_videolist')->with('videos',$videoList);
    }

    // Client video viewing
    public function watchVideo(Request $request){

    	$videoID = $request->input('video_id');
		$video = DB::table('videos')->where('id',$videoID )->get();
		$video = sizeof($video)==0 ? NULL : $video;
		return view('client.client_videoplayer')->with('video',$video);
    }

    public function listMovie(){
        $videoDbInstance = new Video();
        $movieList = $videoDbInstance->fetchAllMovies();
        return view('video.index',array('data'=>$movieList));
    }

    private function removeWhiteSpace($str){
        return preg_replace('/\s+/', '', $str);
    }
}

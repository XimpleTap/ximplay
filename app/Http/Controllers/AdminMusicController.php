<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Audio;

class AdminMusicController extends Controller
{
    public function __construct(){
        
    }

    public function musicForm(){
        return view('music.uploadform');
    }

    public function musicList(Request $request){

        $musicUpload = $request->except('_token');
        $requestKeys = array();
        
        $uploadCount = sizeof($musicUpload['music-title']);
        $musicUpload['file'] = array_reverse($musicUpload['file']);
        $uploadMessage = array();

        $j=0;
        $maxCount = 10;
        for($i=0; $i<$uploadCount; $i++){
            if($i>$maxCount-1){
                array_push($uploadMessage,[
                    "message"=>'Maximum number of mp3 files on a single upload is 10. Some files were not uploaded.'
                ]);
            }else{
                $audio = new Audio;
                for($j=0; $j<$uploadCount; $j++){
                    if($this->getMimeType($musicUpload['file'][$j]->getClientOriginalName())==="audio/mpeg"){

                        if($musicUpload['file'][$j]->getClientOriginalName()==$musicUpload['music-file'][$i]){

                            $file = $musicUpload['file'][$j];
                            $origFileName = $file->getClientOriginalName();
                            $destinationPath = config('app.MUSIC_UPLOAD_DIR');
                            $filename = $this->filterWhiteSpace($musicUpload['music-title'][$i]);
                            
                            $file->move($destinationPath,$filename.'.mp3');

                            if($musicUpload['music-album-art'][$i]!=NULL){
                                $base64_str = substr($musicUpload['music-album-art'][$i], strpos($musicUpload['music-album-art'][$i], ",")+1);
                            //decode base64 string

                                $image = base64_decode($base64_str);
                                file_put_contents($destinationPath.'/'.$musicUpload['music-title'][$i].'.jpg',$image);
                                $audio->album_art_path = '/music/'.$musicUpload['music-title'][$i].'.jpg';
                            }else{
                                $audio->album_art_path = '/images/defaultmusic.jpg';
                            }
                            
                        
                            $audio->title = $musicUpload['music-title'][$i];
                            $audio->artist = $musicUpload['music-artist'][$i];
                            $audio->audio_path = '/music/'.$filename.'.mp3';
                            $audio->save();

                            array_push($uploadMessage,[
                                "message"=>$filename.' uploaded successfully!'
                            ]);
                        }
                    }else{
                        $file = $musicUpload['file'][$j];
                        $origFileName = $file->getClientOriginalName();
                        $filename = $this->filterWhiteSpace($origFileName);

                        array_push($uploadMessage,[
                            "message"=>$filename.' uploading failed. This is not an mp3 file.'
                        ]);
                    }

                }
            }
 
        }
        
        $uploadMessage = array_map("unserialize", array_unique(array_map("serialize", $uploadMessage)));
        return view('music.list',array('data'=>$uploadMessage));         
        /*foreach(Input::file('file') as $file){
            $origFileName = $file->getClientOriginalName();
            $destinationPath = config('app.MUSIC_UPLOAD_DIR');
            $filename = $this->filterWhiteSpace($origFileName);
            $getId3 = new \getID3;
            $fileInfo = $getId3->analyze($file->getRealPath());
            $file->move($destinationPath,$filename);  
            $fileLocation = $destinationPath.$filename;
            //TODO: set metadata upon user invoke of edit
            //$this->setMetadata($fileLocation,$origFileName);
        }
        $viewData = Input::file('file');
        return view('music.list',array('data'=>$viewData));*/
    }

    private function filterWhiteSpace($str){
        return preg_replace('/\s+/', '_', $str);
    }

    private function setMetadata($file){
        $TextEncoding = 'UTF-8';
        $getId3 = new \getID3;
        $fileInfo = $getId3->analyze($file);
        
        dump($fileInfo);
        exit();
    }

    private function getMimeType($filename) {
    $idx = explode( '.', $filename );
    $count_explode = count($idx);
    $idx = strtolower($idx[$count_explode-1]);

    $mimet = array( 
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'docx' => 'application/msword',
        'xlsx' => 'application/vnd.ms-excel',
        'pptx' => 'application/vnd.ms-powerpoint',


        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    if (isset( $mimet[$idx] )) {
     return $mimet[$idx];
    } else {
     return 'application/octet-stream';
    }
 }
}

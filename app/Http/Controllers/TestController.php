<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TestController extends Controller
{
    public function testId3(){
        $TextEncoding = 'UTF-8';

        $getId3 = new \getID3;
        $fileInfo = $getId3->analyze('C:\Music\Accel_World_-_Burst_the_Gravity.mp3');
        dump($fileInfo);

        $tagwriter = new \getid3_writetags;
        $tagwriter->filename = 'C:\Music\Accel_World_-_Burst_the_Gravity.mp3';
        dump($tagwriter);

        $tagwriter->tagformats = array('id3v2.3');
        // set various options (optional)
        $tagwriter->overwrite_tags    = true;  // if true will erase existing tag data and write only passed data; if false will merge passed data with existing tag data (experimental)
        $tagwriter->remove_other_tags = false; // if true removes other tag formats (e.g. ID3v1, ID3v2, APE, Lyrics3, etc) that may be present in the file and only write the specified tag format(s). If false leaves any unspecified tag formats as-is.
        $tagwriter->tag_encoding      = $TextEncoding;
        $tagwriter->remove_other_tags = true;
        // populate data array
        $TagData = array(
            'title'                  => array('My Song'),
            'artist'                 => array('The Artist'),
            'album'                  => array('Greatest Hits'),
            'year'                   => array('2004'),
            'genre'                  => array('Rock'),
            'comment'                => array('excellent!'),
            'track'                  => array('11/16'),
            'popularimeter'          => array('email'=>'user@example.net', 'rating'=>128, 'data'=>0),
            'unique_file_identifier' => array('ownerid'=>'user@example.net', 'data'=>md5(time())),
        );
        $tagwriter->tag_data = $TagData;
        // write tags
        if ($tagwriter->WriteTags()) {
            echo 'Successfully wrote tags<br>';
            if (!empty($tagwriter->warnings)) {
                echo 'There were some warnings:<br>'.implode('<br><br>', $tagwriter->warnings);
            }
        } else {
            echo 'Failed to write tags!<br>'.implode('<br><br>', $tagwriter->errors);
        }
    }
}

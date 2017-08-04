<?php
    echo Form::open(array('url' => '/videos/upload','files'=>'false','id'=>'uploadform'));
    echo 'Select the file to upload.';
    echo Form::file('video',array('name'=>'file'));
    echo Form::submit('Upload File');
    echo Form::close();
?>


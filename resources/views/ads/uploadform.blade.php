<?php
    echo Form::open(array('url' => '/images/upload','files'=>'false','id'=>'uploadform'));
    echo 'Select the file to upload.';
    echo Form::file('image',array('name'=>'file'));
    echo Form::submit('Upload File');
    echo Form::close();
?>


{!! Html::style('//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}
{!! Html::script('js/jquery-3.2.1.min.js') !!}
<div align='center' style='margin-top: 5%;'>
<?php
    echo Form::open(array('url' => '/images/promosupload','files'=>'false','id'=>'uploadform'));
    echo 'Select the file to upload.';
    echo Form::file('image',array('name'=>'file','id'=>'imageFile'));
    echo '<br /><br />';
    echo Form::text('endDate','Pick end date',array('id'=>'endDate'));
    echo '<br /><br />';
    echo Form::submit('Upload File');
    echo Form::close();
?>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
    jQuery("#endDate").datepicker();
    jQuery('#imageFile').change(function(){
        var imageProps = $('#imageFile')[0].files[0]; 
    })
</script>
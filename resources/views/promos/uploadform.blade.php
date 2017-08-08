{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::style('css/smoothness.jqueryui.css') !!}
{!! Html::style('css/admin.css') !!}
{!! Html::style('css/materialize.css') !!}

<div class="container">
    <div class="row">
        <div class="input-field col s12 center-align">
                <?php
                    echo Form::open(array('url' => '/images/promosupload','files'=>'false','id'=>'uploadform','class'=>''));
                    echo 'Select the file to upload.';
                    echo  '<div class="input-field inline">';
                        echo Form::file('image',array('name'=>'file[]','id'=>'imageFile','multiple'=>'multiple','class'=>'waves-effect waves-light btn'));
                    echo '</div>';
                    echo '<br /><br />';
                    echo Form::text('endDate','Pick end date',array('id'=>'endDate'));
                    echo '<br /><br />';
                    echo Form::submit('Upload File',array('class'=>'waves-effect waves-light btn'));
                    echo Form::close();
                ?>
        </div>
        <div id='preview' class='s12'></div>
    </div>
</div>


{!! Html::script('js/jquery1.10.2.js') !!}
{!! Html::script('js/jqueryui1.11.2.js') !!}
<script>
    jQuery("#endDate").datepicker();
    jQuery('#imageFile').change(function(){
        $('#preview').html('');

        var imageProps = $('#imageFile')[0].files[0]; 
        var names = [];
        
        //for (var i = 0; i < $(this).get(0).files.length; ++i) {
            //names.push($(this).get(0).files[i].name);
            //console.log($(this).get(0).files[i]);
        //}
        //console.log(names);

        var data = $(this)[0].files; //this file data
            
        $.each(data, function(index, file){ //loop though each file
            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                var fRead = new FileReader(); //new filereader
                fRead.onload = (function(file){ //trigger function on successful read
                return function(e) {
                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                    $('#preview').append(img); //append image to output element
                };
                })(file);
                fRead.readAsDataURL(file); //URL representing the file's data.
            }
        });
    });
</script>


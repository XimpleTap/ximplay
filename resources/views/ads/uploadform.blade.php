{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::style('css/smoothness.jqueryui.css') !!}
{!! Html::style('css/admin.css') !!}
{!! Html::style('css/materialize.css') !!}
{!! Html::style('css/font-icon.css') !!}

<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">Admin</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ url('music/form') }}">Music Uploader</a></li>
            <li><a href="{{ url('videos/form') }}">Movie Uploader</a></li>
            <li><a href="{{ url('images/adsform') }}">Ads Uploader</a></li>
            <li><a href="{{ url('images/promosform') }}">Promo Uploader</a></li>
            <li><a href="{{ url('reports') }}">Reports</a></li>
            <li><a href="{{ url('logout') }}">Logout</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="{{ url('music/form') }}">Music Uploader</a></li>
            <li><a href="{{ url('videos/form') }}">Movie Uploader</a></li>
            <li><a href="{{ url('images/adsform') }}">Ads Uploader</a></li>
            <li><a href="{{ url('images/promosform') }}">Promo Uploader</a></li>
            <li><a href="{{ url('reports') }}">Reports</a></li>
            <li><a href="{{ url('logout') }}">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="input-field col s12 center-align">
                <?php
                    echo Form::open(array('url' => 'images/adsupload','files'=>'false','id'=>'uploadform','class'=>''));
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
{!! Html::script('js/materialize.min.js') !!}
<script>
    jQuery(document).ready(function(){
        $(".button-collapse").sideNav();

        jQuery("#endDate").datepicker();
        jQuery('#imageFile').change(function(){
            var imageProps = $('#imageFile')[0].files[0]; 
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
        })
    });
    
</script>
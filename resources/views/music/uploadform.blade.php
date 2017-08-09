{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::style('css/materialize.css') !!}

<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">Admin</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="/music/form">Music Uploader</a></li>
            <li><a href="/videos/form">Movie Uploader</a></li>
            <li><a href="/images/adsform">Ads Uploader</a></li>
            <li><a href="/images/promosform">Promo Uploader</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="/music/form">Music Uploader</a></li>
            <li><a href="/videos/form">Movie Uploader</a></li>
            <li><a href="/images/adsform">Ads Uploader</a></li>
            <li><a href="/images/promosform">Promo Uploader</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="input-field col s12 center-align">
                <?php
                    echo Form::open(array('url' => '/music/list','files'=>'false','id'=>'uploadform','class'=>''));
                    echo 'Select the file to upload.';
                    echo  '<div class="input-field inline">';
                    echo Form::file('mp3',array('name'=>'file[]','id'=>'imageFile','multiple'=>'multiple','class'=>'waves-effect waves-light btn'));
                    echo '</div>';
                    echo '<br /><br />';
                    echo Form::submit('Upload File',array('class'=>'waves-effect waves-light btn'));
                    echo Form::close();
                ?>
        </div>
        <div id='preview' class='s12'></div>
    </div>
</div>




<script>

</script>
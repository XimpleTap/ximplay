{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::style('css/materialize.css') !!}
{!! Html::script('js/id3-min.js') !!}
{!! Html::script('js/admin.js') !!}

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
                    echo Form::open(array('url' => '/music/list','files'=>'false','id'=>'uploadform','class'=>''));
                    echo 'Select the file to upload.';
                    echo  '<div class="input-field inline">';
                    echo Form::file('mp3',array('name'=>'file[]','id'=>'imageFile','multiple'=>'multiple','class'=>'waves-effect waves-light btn','onchange'=>'detectFileChange(this)','accept'=>'.mp3'));
                    echo '</div>';
                    echo '<br /><br />'; ?>
                        <div class="music-uploads row">
                        </div>
                <?php
                    echo Form::submit('Upload File',array('onclick'=>'disableAll(this)','class'=>'waves-effect waves-light btn'));
                    echo Form::close();
                ?>

        </div>

        <div id='preview' class='s12'></div>
    </div>
</div>
<script>

</script>
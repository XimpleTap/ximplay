{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::style('css/materialize.css') !!}
<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">Admin</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="/public/music/form">Music Uploader</a></li>
            <li><a href="/public/videos/form">Movie Uploader</a></li>
            <li><a href="/public/images/adsform">Ads Uploader</a></li>
            <li><a href="/public/images/promosform">Promo Uploader</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="/public/music/form">Music Uploader</a></li>
            <li><a href="/public/videos/form">Movie Uploader</a></li>
            <li><a href="/public/images/adsform">Ads Uploader</a></li>
            <li><a href="/public/images/promosform">Promo Uploader</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="input-field col s12">
                <?php
                    echo Form::open(array('url' => '/public/videos/upload','files'=>'false','id'=>'uploadform','class'=>''));
                    echo 'Select the file to upload.';
                    echo  '<div class="input-field inline">';
                        echo Form::file('video',array('name'=>'file','class'=>'waves-effect waves-light btn'));
                    echo '</div>';
                    echo "<br />";
                    echo 'Select the movie poster to upload.';
                    echo  '<div class="input-field inline">';
                        echo Form::file('poster',array('name'=>'posterFile','class'=>'waves-effect waves-light btn'));
                    echo '</div>';
                     
                    echo '<div class="col s12">';
                        echo 'Enter Movie Title:';
                        echo '<div class="input-field inline">';
                            echo '<input id="movie-name" name="movie-name" type="text" class="validate">';
                            echo '<label for="movie-name" data-error="wrong" data-success="right">Movie Title</label>';
                        echo '</div>';
                    echo '</div>';
                    echo '<br /><br />';
                    echo Form::submit('Upload File',array('class'=>'waves-effect waves-light btn'));
                    echo Form::close();
                ?>
        </div>
    </div>
</div>




<script>

</script>
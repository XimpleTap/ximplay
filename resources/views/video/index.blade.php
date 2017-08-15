{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::style('css/materialize.css') !!}
<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">Admin</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ url('music/form') }}">Music Uploader</a></li>
            <li><a href="{{ url('videos/form') }}">Movie Uploader</a></li>
            <li><a href="{{ url('images/adsform') }}">Ads Uploader</a></li>
            <li><a href="{{ url('images/promosform') }}">Promo Uploader</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="{{ url('music/form') }}">Music Uploader</a></li>
            <li><a href="{{ url('videos/form') }}">Movie Uploader</a></li>
            <li><a href="{{ url('images/adsform') }}">Ads Uploader</a></li>
            <li><a href="{{ url('images/promosform') }}">Promo Uploader</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="input-field col s12">
            <h5>Uploaded Movies</h5>
            <ul class="collection">
                <?php 
                foreach($data as $movie){
                    echo '<li class="collection-item">';
                    echo $movie->title;
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
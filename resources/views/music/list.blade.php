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
        <div class="input-field col s12">
            <h5>The following files has successfully been uploaded</h5>
            <ul class="collection">
                <?php
                foreach($data as $file){
                    $origFileName = $file->getClientOriginalName();
                    echo '<li class="collection-item">';
                    echo $origFileName;
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>


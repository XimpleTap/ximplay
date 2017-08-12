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
            <a href='public/images/adsform'>Upload Ads</a>
            <hr />
            <ul class="collection with-header">
                <li class="collection-header"><h4>First Names</h4></li>
                <?php
                foreach($data as $ad){
                    echo '<li class="collection-item">';
                    echo basename($ad->image_path);
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
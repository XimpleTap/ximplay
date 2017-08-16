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
            <li><a href="{{ url('reports') }}">Reports</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="{{ url('music/form') }}">Music Uploader</a></li>
            <li><a href="{{ url('videos/form') }}">Movie Uploader</a></li>
            <li><a href="{{ url('images/adsform') }}">Ads Uploader</a></li>
            <li><a href="{{ url('images/promosform') }}">Promo Uploader</a></li>
            <li><a href="{{ url('reports') }}">Reports</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="input-field col s12">
           <a  href="/reports/promohits" class="waves-effect waves-light btn" target="_blank">Export Promo Hits Report</a>
        </div>
        <div class="input-field col s12">
            <a  href="/reports/adhits" class="waves-effect waves-light btn" target="_blank">Export Ad Hits Report</a>
        </div>
    </div>
</div>
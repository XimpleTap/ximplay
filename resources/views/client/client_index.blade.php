<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Ximplay</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/font-icon.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/client.css') }}" rel="stylesheet" type="text/css">
        @yield('css')


    </head>
    <body>

        <div class="container">
        <!-- Page Content goes here -->
            <br>
            <div class="row">
              <div class="col s6">
                <button id="to-music" class="nav-btn btn waves-effect waves-light blue darken-4"><i class="fa fa-music"></i> Music
                    
                </button>
              </div>
              <div class="col s6">
                <button id="to-movies" class="nav-btn btn waves-effect waves-light blue darken-4">Movies <i class="fa fa-tv"></i>
                    
                </button>
               </div>
            </div>
        </div>
        @yield('content')

    </body>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/materialize.min.js') }}"></script>
        <script src="{{ asset('js/video-player.js') }}"></script>
        @yield('js')
</html>

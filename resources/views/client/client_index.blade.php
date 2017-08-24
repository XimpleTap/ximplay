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
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/modal.css') }}" rel="stylesheet" type="text/css">
        @yield('css')


    </head>
    <body>

    <input type='hidden' id='handling_param' value="<?php echo (is_null($segment1 =  Request::segment(1)) ? " " : $segment1);  ?>"/>

        <div class="index-container">
        <!-- Page Content goes here -->
            <div class="custom-nav">
            <div class="left music-nav">
                <button id="to-music" class="nav-btn btn waves-effect waves-light blue darken-4"><i class="fa fa-music"></i> Music
                    
                </button>
            </div>
            <div class="right movie-nav">
                <button id="to-movies" class="nav-btn btn waves-effect waves-light blue darken-4">Movies <i class="fa fa-tv"></i>
                    
                </button>
            </div>
            </div>
            
            
        </div>
        <br>
        <br>
        <div id="surveyModal" class="modal">
            <h5 style="text-align:center; padding:10px">Ximplay Quick Survey</h5>
                <p style="text-align:center;">Brought to you by:</p>
                <img class="company-banner responsive-img" src="{{ asset('banner/company_banner.jpg') }}">
            <div class="row">
                <div class="input-field col s8">
                    <input name="in_name" id="in_name" type="text" class="validate">
                    <label for="in_name">Name</label>
                </div>
                <div class="input-field col s4">
                    <input name="in_age" id="in_age" type="number" class="validate" maxlength="3">
                    <label for="in_age">Age</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input name="in_ea_mn" id="in_ea_mn" type="text" class="validate">
                    <label for="in_ea_mn">Email Address or Mobile Number</label>
                </div>
            </div>

            <div style="text-align:center">
                <a id="proceed" class="waves-effect waves-light btn center" disabled>proceed</a>
            </div>
        </br>
            <div class="row" style="text-align:center" id="div_policy">
                <p>
                  <input type="checkbox" id="policy"/>
                  <label for="policy">I agree that I have read and understood the <a href="#policyModal" class="modal-trigger" >Privacy Policy</a> </label>
                </p>
            </div>
        </div>

        <div id="policyModal" class="modal">
            <h4 style="text-align:center; padding:25px">Privacy Policy</h4>
            
            <div class="row">
                <p style="text-align:justify; padding:10px 10px 10px 10px">
                    After filling up the form, the user should check that he/she agrees with the privacy policy. 
                    If the “PROCEED” button is pressed without checking the agreement, show the user, the privacy policy as seen on the next slide.
                    After filling up the form, the user should check that he/she agrees with the privacy policy. 
                    If the “PROCEED” button is pressed without checking the agreement, show the user, the privacy policy as seen on the next slide.
                    After filling up the form, the user should check that he/she agrees with the privacy policy. 
                    If the “PROCEED” button is pressed without checking the agreement, show the user, the privacy policy as seen on the next slide.
                    After filling up the form, the user should check that he/she agrees with the privacy policy. 
                    If the “PROCEED” button is pressed without checking the agreement, show the user, the privacy policy as seen on the next slide.
                    After filling up the form, the user should check that he/she agrees with the privacy policy. 
                    If the “PROCEED” button is pressed without checking the agreement, show the user, the privacy policy as seen on the next slide.
                    After filling up the form, the user should check that he/she agrees with the privacy policy. 
                    If the “PROCEED” button is pressed without checking the agreement, show the user, the privacy policy as seen on the next slide.
                    
                </p>
            </div>
            <div style="text-align:center">
                <a id="close" class="waves-effect waves-light btn center modal-close" style="display:none">ok</a>
            </div>
            <br>
        </div>

        <div id="promptModal" class="modal">
            <a class="btn-floating btn-small waves-effect waves-light modal-close close-button">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
            <div class="row">
                <p style="text-align:center; padding:125px 10px 10px 10px">
                    Thank you and welcome to Ximplay! <br>
                    You may close this window to proceed or wait, for <span class="timer">5</span> seconds.
                </p>
            </div>
        </div>

        <div id="adPromoModal" class="modal">
            <a class="btn-floating btn-small waves-effect waves-light modal-close close-button">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
            <div class="row center">
                <img class="ad-promo-banner responsive-img">
            </div>
        </div>

        <div id="loaderModal" class="modal">
            <div id="loader">
            </div>
        </div>
        <button id="go-up" onclick="topFunction()" class="right truncate btn waves-effect waves-light blue">
        <i class="fa fa-caret-up"></i>
        </button>
        @yield('content')

    </body>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/materialize.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/initial.js') }}"></script>
        <script>

        $(document).ready(function(){
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            
        });
        function scrollFunction() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                $('.nav-bottom #go-up').show();
            } else {
                $('.nav-bottom #go-up').hide();
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            $('html, body').animate({ scrollTop: 0}, 1200);
        }
        </script>
        @yield('js')
        
</html>

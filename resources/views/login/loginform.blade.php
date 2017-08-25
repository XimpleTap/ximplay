{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::script('js/materialize.js') !!}
{!! Html::style('css/materialize.css') !!}
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <div class="row">
        <div class="input-field col s12">
            <input name="username" id="username" type="text" class="validate">
            <label for="username">Username</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="password" name="password" id="password" class="validate" />
            <label for="password">Password</label>
        </div>
        
    </div>
    <div class="row">
        <pre id='login-warning' style='color:red;'>Incorrect username or password</pre>
        <button class="waves-effect waves-light btn" id="btn-login">Login</button>
        
    </div>
</div>

<script>
    jQuery('#login-warning').hide();
    jQuery('#btn-login').click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var username = jQuery('#username').val();
        var password = jQuery('#password').val();
        var data = {
            'username': username,
            'password':password
        };
        
        jQuery.ajax({
            type: 'POST',
            url: '/ximplay/public/login/authenticate',
            dataType:'json',
            data: data,
            
            success: function(_data){

                if(_data == 'success'){
                    alert(_data);
                    var baseurl = window.location.origin;
                    window.location.replace(baseurl +'/ximplay/public/music/form');
                    //window.location.replace(baseurl +'/music/form');
                }
                else{
                    jQuery('#login-warning').show();
                }
            },
            error: function(_data){
                C
                jQuery('#login-warning').show();
            }

        });
        });
</script>
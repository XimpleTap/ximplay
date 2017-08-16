{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::script('js/materialize.js') !!}
{!! Html::style('css/materialize.css') !!}

<div class="container">
    <?php
        echo Form::open(array('url' => '/login/authenticate','class'=>'col s12'));
        echo '<div class="row">';
            echo '<div class="input-field col s23">';
                echo Form::text('username', '', array('class'=>'validate'));
                echo '<label for="username">Username</label>';
            echo '</div>';
            echo '<div class="input-field col s23">';
                echo Form::password('password', array('class'=>'validate'));
                echo '<label for="password">Password</label>';
            echo '</div>';
        echo '</div>';
        echo Form::submit('Login',array('class'=>'waves-effect waves-light btn'));
        echo Form::close();
    ?>
</div>
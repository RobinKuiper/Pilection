<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ (isset($title)) ? 'Pilection :: '.$title : 'Pilection' }}</title>

    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css') }}
    {{ HTML::style('css/main.css') }}
    {{ HTML::style('css/login.css') }}
    {{ HTML::style('css/zocial/zocial.css') }}
    {{ HTML::style('css/bootstrap-switch/bootstrap-switch.min.css') }}
</head>

<body>

@if(Session::has('message'))
<p class="alert alert-dismissable {{ Session::get('alert_class') }}">{{ Session::get('message') }}</p>
@endif

<div class='container'>
    <div class="row loginContainer">
        <div class="col-md-6 col-md-offset-3">

            <div class="row headerContainer border-green" onclick="location.href='/';" style="cursor:pointer;">
                <div class="col-md-12">
                    <h1><a href="/" title="Pilection" class="white-link">Pilection</a></h1>
                </div>
            </div>

            <div class="row formContainer">
                <div class="col-md-12">

                    <ul class="nav nav-tabs">
                        <li class="{{ $active == 'login' ? 'active' : '' }}"><a href="{{ route('sessions.create') }}" data-target="#login" title="Login" data-toggle="tab">Login</a></li>
                        <li class="{{ $active == 'oauth' ? 'active' : '' }}"><a href="{{ route('oauth.index') }}" data-target="#social" title="Social Login" data-toggle="tab">Social Login</a></li>
                        <li class="{{ $active == 'forgot' ? 'active' : '' }}"><a href="{{ route('passwords.create') }}" data-target="#forgot" title="Forgot Password" data-toggle="tab">Forgot Password</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane {{ $active == 'login' ? 'active' : '' }}" id="login">
                            {{ Form::open(['route' => 'sessions.store', 'role' => 'form']) }}
                            <div class="row margin-bottom-20">
                                <div class="col-md-12 text-center">
                                    <h3>Please Login</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        {{ Form::label('login', 'Username or email') }}
                                        {{ Form::text('login', null, array('class'=>'form-control input-sm', 'placeholder'=>'Username or email address', 'tabindex'=>'1')) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('password', 'Password') }}
                                        {{ Form::password('password', array('class'=>'form-control input-sm', 'placeholder'=>'Password', 'tabindex'=>'2')) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 text-right">
                                    <div class="form-group">
                                        {{ Form::label('remember', 'Stay logged in?') }}
                                        {{ Form::checkbox('remember') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-11 col-md-offset-1">
                                    <div class="form-group">
                                        {{ Form::submit('Login', array('class'=>'btn btn-success btn-lg', 'tabindex'=>'3'))}}
                                        or
                                        {{ link_to(route('users.create'), 'Register') }}
                                    </div>
                                </div>
                            </div>
                            @if(isset($url))
                            {{ Form::hidden('url', $url['intended']) }}
                            @endif
                            {{ Form::close() }}
                        </div>
                        <div class="tab-pane {{ $active == 'oauth' ? 'active' : '' }}" id="social">
                            <div class="row margin-bottom-20">
                                <div class="col-md-12 text-center">
                                    <h3>Social Login</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    {{ link_to(route('oauth.create', 'facebook'), 'Sign in with Facebook', ['class' => 'zocial facebook']) }}
                                </div>

                                <div class="col-md-6">
                                    {{ link_to(route('oauth.create', 'twitter'), 'Sign in with Twitter', ['class' => 'zocial twitter']) }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane {{ $active == 'forgot' ? 'active' : '' }}" id="forgot">
                            {{ Form::open(['route' => 'passwords.store', 'role' => 'form']) }}
                            <div class="row margin-bottom-20">
                                <div class="col-md-12 text-center">
                                    <h3>Forgot Password</h3>
                                    <p style="font-size: 10pt;">Enter the email address associated with your account.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        {{ Form::label('email', 'Email') }}
                                        {{ Form::email('email', null, array('class'=>'form-control input-sm', 'placeholder'=>'Email', 'tabindex'=>'1')) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 col-md-offset-2">
                                    <div class="form-group">
                                        {{ Form::submit('Send Password Reset Mail', array('class'=>'btn btn-primary btn-sm' , 'tabindex'=>'2'))}}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{{ HTML::script('http://code.jquery.com/jquery-latest.min.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.min.js') }}

{{ HTML::script('js/bootstrap-switch/bootstrap-switch.min.js') }}

<script>
    $(function(){
        $("[name='remember']").bootstrapSwitch({
            size: 'small',
            onColor: 'primary',
            onText: 'Yes',
            offText: 'No',
        });
    });
</script>

</body>
</html>
@extends('layouts.master')

@section('head')
{{ HTML::style('css/zocial/zocial.css') }}
{{ HTML::style('css/bootstrap-switch/bootstrap-switch.min.css') }}
@stop

@section('breadcrumbs')
{{ Breadcrumbs::render('login') }}
@stop

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-0 col-md-offset-1">
        {{ Form::open(['route' => 'sessions.store', 'role' => 'form']) }}
        <h2>Please Login</h2>
        <hr class="colorgraph">
        <div class="form-group">
            {{ Form::text('login', null, array('class'=>'form-control input-lg', 'placeholder'=>'Username or email address', 'tabindex'=>'1')) }}
        </div>

        <div class="form-group">
            {{ Form::password('password', array('class'=>'form-control input-lg', 'placeholder'=>'Password', 'tabindex'=>'2')) }}
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                {{ Form::label('remember', 'Stay logged in?') }}
                {{ Form::checkbox('remember') }}
            </div>

        </div>

        <hr class="colorgraph">
        <div class="row">
            <div class="col-xs-6 col-md-6">
                {{ Form::submit('Login', array('class'=>'btn btn-success btn-block btn-lg', 'tabindex'=>'3'))}}
            </div>
            <div class="col-xs-6 col-md-6">
                {{ link_to(route('users.create'), 'Register', ['class' => 'btn btn-primary btn-block btn-lg']) }}
            </div>
        </div>
        </form>
    </div>

    <div class="col-xs-12 col-sm-3 col-md-4 col-sm-offset-0 col-md-offset-0">
        {{ Form::open(['route' => 'sessions.store', 'role' => 'form']) }}
        <h2>Or Login with</h2>
        <hr class="colorgraph">
        <ul class="nav">
            <li class="margin-bottom-10">
                {{ link_to(route('oauth.create', 'facebook'), 'Sign in with Facebook', ['class' => 'zocial facebook']) }}
            </li>
            <li>
                {{ link_to(route('oauth.create', 'twitter'), 'Sign in with Twitter', ['class' => 'zocial twitter']) }}
            </li>
        </ul>

    </div>
</div>
@stop

@section('footer')
{{ HTML::script('js/vendor/bootstrap-switch/bootstrap-switch.min.js') }}

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
@stop
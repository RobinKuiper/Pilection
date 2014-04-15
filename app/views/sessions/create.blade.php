@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('login') }}
@stop

@section('content')
{{ Form::open(['route' => 'sessions.store', 'class' => 'form-signup', 'role' => 'form']) }}
<h2 class="form-signin-heading">Please Login</h2>

<div class="form-group">
    {{ Form::text('login', null, array('class'=>'form-control', 'placeholder'=>'Username or email address')) }}
</div>

<div class="form-group">
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
</div>

<div class="form-group text-right">
    {{ Form::checkbox('remember') }}
    {{ Form::label('remember', 'Remember me ') }}
</div>

<div class="form-group">
    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
    <p>{{ link_to(route('users.create'), 'Register') }} | {{ link_to(route('passwords.create'), 'Forgot Password?') }}</p>
</div>

{{ Form::hidden('url', $url['intended']) }}
{{ Form::close() }}
@stop
@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('register') }}
@stop

@section('content')

@foreach($userProfile as $key => $value)
<li>{{ $key }} : {{ $value }}</li>
@endforeach

{{ Form::open(['route' => 'oauth.store', 'class' => 'form-signup', 'role' => 'form']) }}
<h2 class="form-signup-heading">Please Register</h2>

<div class="form-group">
    {{ Form::text('username', ['class'=>'form-control', 'placeholder'=>'User Name']) }}
    {{ $errors->first('username') }}
</div>

<div class="form-group">
    {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) }}
    {{ $errors->first('password') }}
</div>

<div class="form-group">
    {{ Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Confirm Password']) }}
    {{ $errors->first('password_confirmation') }}
</div>

{{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}

{{ Form::close() }}

@stop
@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('register') }}
@stop

@section('content')

{{ Form::open(['route' => 'oauth.store', 'class' => 'form-signup', 'role' => 'form']) }}
<h2 class="form-signup-heading">Create Profile</h2>

<div class="form-group">
    {{ Form::text('username', $userProfile->username, ['class'=>'form-control', 'placeholder'=>'User Name']) }}
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

{{ Form::hidden('userProfile', json_encode($userProfile)) }}
{{ Form::submit('Create Profile', array('class'=>'btn btn-large btn-primary btn-block'))}}

{{ Form::close() }}

@foreach($userProfile as $key => $value)
<li>{{ $key }} : {{ $value }}</li>
@endforeach

@stop
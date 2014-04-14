@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('forgot-password') }}
@stop

@section('content')
{{ Form::open(['route' => 'passwords.store', 'role' => 'form']) }}
<h2 class="form-signin-heading">Forgot Password</h2>

<div class="form-group">
    {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email')) }}
</div>

{{ Form::submit('Send Reminder', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop
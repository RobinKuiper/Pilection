@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('reset-password') }}
@stop

@section('content')
	{{ Form::open(['url' => 'password/'.$token.'/update', 'role' => 'form']) }}
	    <h2 class="form-signin-heading">Reset Password</h2>
	 
            <div class="form-group">
	    	{{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Email')) }}
	    </div>
            
            <div class="form-group">
	    	{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
	    </div>
            
            <div class="form-group">
	    	{{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Password Confirmation')) }}
	    </div>

            {{ Form::hidden('token', $token) }}
	    {{ Form::submit('Reset Password', array('class'=>'btn btn-large btn-primary btn-block'))}}
	{{ Form::close() }}
@stop
@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('login') }}
@stop

@section('content')
	{{ Form::open(['route' => 'sessions.store', 'class' => 'form-signup', 'role' => 'form']) }}
	    <h2 class="form-signin-heading">Please Login</h2>
	 
	 	<div class="input-group form-group">
	    	{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
	    	<span class="input-group-addon">@</span>
	    	{{ $errors->first('email') }}
	    </div>

	    <div class="form-group">	
	    	{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
	 		{{ $errors->first('password') }}
	 	</div>

	    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
	{{ Form::close() }}
@stop
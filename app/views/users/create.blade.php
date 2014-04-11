@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('register') }}
@stop

@section('content')
	
	{{ Form::open(['route' => 'users.store', 'class' => 'form-signup', 'role' => 'form']) }}
		<h2 class="form-signup-heading">Please Register</h2>

		<div class="form-group">
			{{ Form::text('firstname', null, ['class'=>'form-control', 'placeholder'=>'First Name']) }}
			{{ $errors->first('firstname') }}
		</div>

		<div class="form-group">
			{{ Form::text('lastname', null, ['class'=>'form-control', 'placeholder'=>'Last Name']) }}
			{{ $errors->first('lastname') }}
		</div>
                
                <div class="form-group">
			{{ Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'User Name']) }}
			{{ $errors->first('username') }}
		</div>

		<div class="input-group form-group">
			{{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) }}
			<span class="input-group-addon">@</span>
			{{ $errors->first('email') }}
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
@extends('layouts.master')

@section('content')
<h2 class="margin-bottom-40">Change Profile</h2>

<!-- Nav tabs -->
<ul class="nav nav-tabs margin-bottom-20">
    <li class="active"><a href="#profile" data-toggle="tab">Change Profile</a></li>
    <li><a href="#password" data-toggle="tab">Change Password</a></li>
    <li><a href="#email" data-toggle="tab">Change Email</a></li>
    <li><a href="#settings" data-toggle="tab">Settings</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="profile">
        {{ Form::open(['route' => 'users.update', 'class' => 'form-signup', 'role' => 'form']) }}

        <div class="form-group">
            {{ Form::text('firstname', $user->firstname, ['class'=>'form-control', 'placeholder'=>'First Name']) }}
            {{ $errors->first('firstname') }}
        </div>

        <div class="form-group">
            {{ Form::text('lastname', $user->lastname, ['class'=>'form-control', 'placeholder'=>'Last Name']) }}
            {{ $errors->first('lastname') }}
        </div>

        {{ Form::hidden('change', 'profile') }}
        {{ Form::submit('Change Profile', array('class'=>'btn btn-large btn-primary btn-block'))}}

        {{ Form::close() }}
    </div>
    <div class="tab-pane" id="password">

        {{ Form::open(['route' => 'users.update', 'class' => 'form-signup', 'role' => 'form']) }}

        <div class="form-group">
            {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'New Password']) }}
            {{ $errors->first('password') }}
        </div>

        <div class="form-group">
            {{ Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Confirm New Password']) }}
            {{ $errors->first('password_confirmation') }}
        </div>

        {{ Form::hidden('change', 'password') }}
        {{ Form::submit('Change Password', array('class'=>'btn btn-large btn-primary btn-block'))}}

        {{ Form::close() }}

    </div>
    <div class="tab-pane" id="email">
        {{ Form::open(['route' => 'users.update', 'class' => 'form-signup', 'role' => 'form']) }}

        <div class="input-group form-group">
            {{ Form::email('email', $user->email, ['class'=>'form-control', 'placeholder'=>'Email']) }}
            <span class="input-group-addon">@</span>
            {{ $errors->first('email') }}
        </div>

        {{ Form::hidden('change', 'email') }}
        {{ Form::submit('Change Email', array('class'=>'btn btn-large btn-primary btn-block'))}}

        {{ Form::close() }}
    </div>
    <div class="tab-pane" id="settings">...</div>
</div>
@stop
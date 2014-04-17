@extends('layouts.master')

@section('head')
{{ HTML::style('css/zocial/zocial.css') }}


@stop

@section('breadcrumbs')
{{ Breadcrumbs::render('register') }}
@stop

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-0 col-md-offset-1">
        {{ Form::open(['route' => 'users.store', 'role' => 'form']) }}
        <h2>Please Sign Up <small>It's free and always will be.</small></h2>
        <hr class="colorgraph">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    {{ Form::text('firstname', null, ['class'=>'form-control input-lg', 'placeholder'=>'First Name', 'tabindex'=>'1']) }}
                    {{ $errors->first('firstname') }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    {{ Form::text('lastname', null, ['class'=>'form-control input-lg', 'placeholder'=>'Last Name', 'tabindex'=>'2']) }}
                    {{ $errors->first('lastname') }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::text('username', null, ['class'=>'form-control input-lg', 'placeholder'=>'User Name', 'tabindex'=>'3']) }}
            {{ $errors->first('username') }}
        </div>
        <div class="form-group">
            {{ Form::email('email', null, ['class'=>'form-control input-lg', 'placeholder'=>'Email', 'tabindex'=>'4']) }}
            {{ $errors->first('email') }}
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    {{ Form::password('password', ['class'=>'form-control input-lg', 'placeholder'=>'Password', 'tabindex'=>'5']) }}
                    {{ $errors->first('password') }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    {{ Form::password('password_confirmation', ['class'=>'form-control input-lg', 'placeholder'=>'Confirm Password', 'tabindex'=>'6']) }}
                    {{ $errors->first('password_confirmation') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="info" tabindex="7">I Agree</button>
                    <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
                </span>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9">
                By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
            </div>
        </div>

        <hr class="colorgraph">
        <div class="row">
            <div class="col-xs-6 col-md-6">
                {{ Form::submit('Register', array('class'=>'btn btn-primary btn-block btn-lg', 'tabindex'=>'7'))}}
            </div>
            <div class="col-xs-6 col-md-6">
                {{ link_to(route('sessions.create'), 'Login', ['class' => 'btn btn-success btn-block btn-lg']) }}
            </div>
        </div>
        </form>
    </div>

    <div class="col-xs-12 col-sm-3 col-md-4 col-sm-offset-0 col-md-offset-0">
        {{ Form::open(['route' => 'sessions.store', 'role' => 'form']) }}
        <h2>Or Register with</h2>
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
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
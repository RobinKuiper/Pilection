@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h2 class="form-signin-heading">Add new project</h2>
        </div>
    </div>

    {{ Form::open(['route' => 'projects.store', 'files' => true, 'class' => '', 'role' => 'form']) }}

    <div class='row'>
        <div class='col-md-12'>
            <div class="form-group">
                {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Project name')) }}
                {{ $errors->first('title') }}
            </div>
        </div>
    </div>
        
    <div class='row'>
        <div class='col-md-12'>
            <div class="form-group">
                {{ Form::textarea('body', null, array('class'=>'form-control', 'placeholder'=>'Project info')) }}
                {{ $errors->first('body') }}
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-12'>
            {{ Form::submit('Add project', array('class'=>'btn btn-large btn-primary btn-block'))}}
        </div>
    </div>
    {{ Form::close() }}
@stop

@section('footer')
    {{ HTML::script('http://js.nicedit.com/nicEdit-latest.js') }}
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@stop
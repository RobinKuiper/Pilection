@extends('layouts.master')

@section('content')
    {{ Form::open(['route' => 'systems.store', 'files' => true, 'class' => '', 'role' => 'form']) }}

    <h2 class="form-signin-heading">Add new system</h2>

        <div class="form-group">
            {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'System name')) }}
            {{ $errors->first('title') }}
        </div>

        <div class="form-group">
            {{ Form::textarea('body', null, array('class'=>'form-control', 'placeholder'=>'System info')) }}
            {{ $errors->first('body') }}
        </div>
    
        <div class="form-group">
            {{ Form::label('image', 'Image:') }}
            {{ Form::file('image') }}
            {{ $errors->first('image') }}
        </div>

            {{ Form::submit('Add system', array('class'=>'btn btn-large btn-primary btn-block'))}}

    {{ Form::close() }}
@stop

@section('footer')
    {{ HTML::script('http://js.nicedit.com/nicEdit-latest.js') }}
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@stop
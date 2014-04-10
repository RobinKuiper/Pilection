@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h2 class="form-signin-heading">Add new script</h2>
        </div>
    </div>

    {{ Form::open(['route' => 'scripts.store', 'files' => true, 'class' => '', 'role' => 'form']) }}

    <div class='row'>
        <div class='col-md-12'>
            <div class="form-group">
                {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Script name')) }}
                {{ $errors->first('title') }}
            </div>
        </div>
    </div>
        
    <div class='row'>
        <div class='col-md-12'>
            <div class="form-group">
                {{ Form::textarea('body', null, array('class'=>'form-control', 'placeholder'=>'Script info')) }}
                {{ $errors->first('body') }}
            </div>
        </div>
    </div>
        
    <div class='row'>
        <div class='col-md-12'>
            <div class="form-group">
                {{ Form::textarea('script', null, array('class'=>'form-control', 'placeholder'=>'Script')) }}
                {{ $errors->first('script') }}
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-12'>
            {{ Form::submit('Add script', array('class'=>'btn btn-large btn-primary btn-block'))}}
        </div>
    </div>
    {{ Form::close() }}
@stop

@section('footer')
    {{ HTML::script('http://js.nicedit.com/nicEdit-latest.js') }}
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@stop
@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h2 class="form-signin-heading">Add new system</h2>
        </div>
    </div>

    {{ Form::open(['route' => 'systems.store', 'files' => true, 'class' => '', 'role' => 'form']) }}

    <div class='row'>
        <div class='col-md-12'>
            <div class="form-group">
                {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'System name')) }}
                {{ $errors->first('title') }}
            </div>
        </div>
    </div>
        
    <div class='row'>
        <div class='col-md-12'>
            <div class="form-group">
                {{ Form::textarea('body', null, array('class'=>'form-control', 'placeholder'=>'System info')) }}
                {{ $errors->first('body') }}
            </div>
        </div>
    </div>
        
    <div class='row'>
        <div class='col-md-6'>
            <div class='row'>
                <div class="form-group input-group">
                    <span class="input-group-addon">http://</span>
                    {{ Form::text('download_url', null, array('class'=>'form-control', 'placeholder'=>'Download link')) }}
                    {{ $errors->first('download') }}
                </div>
       
                <div class="form-group input-group">
                    <span class="input-group-addon">http://</span>
                    {{ Form::text('website_url', null, array('class'=>'form-control', 'placeholder'=>'Website link')) }}
                    {{ $errors->first('website') }}
                </div>
            </div>
        </div>
        
        <div class='col-md-6'>
            <div class="form-group">
                {{ Form::label('image', 'Image:') }}
                {{ Form::file('image') }}
                {{ $errors->first('image') }}
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-12'>
            {{ Form::submit('Add system', array('class'=>'btn btn-large btn-primary btn-block'))}}
        </div>
    </div>
    {{ Form::close() }}
@stop

@section('footer')
    {{ HTML::script('http://js.nicedit.com/nicEdit-latest.js') }}
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@stop
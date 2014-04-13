@extends('layouts.master')

@section('content')
<div class='row'>
    <div class='col-md-12'>
        <h2 class="form-signin-heading">Edit system</h2>
    </div>
</div>

{{ Form::open(['url' => $type.'/'.$item->id.'/update', 'files' => true, 'class' => '', 'role' => 'form', 'method' => 'put']) }}

<div class='row'>
    <div class='col-md-12'>
        <div class="form-group">
            {{ Form::text('title', $item->title, array('class'=>'form-control', 'placeholder'=>'System name')) }}
            {{ $errors->first('title') }}
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-md-12'>
        <div class="form-group">
            {{ Form::textarea('body', $item->body, array('class'=>'form-control', 'placeholder'=>'System info')) }}
            {{ $errors->first('body') }}
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-md-5'>
        <div class='row'>
            <div class="form-group input-group">
                <span class="input-group-addon">http://</span>
                {{ Form::text('website_url', $item->website_url, array('class'=>'form-control', 'placeholder'=>'Website
                link')) }}
                {{ $errors->first('website') }}
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon">http://</span>
                {{ Form::text('download_url', $item->download_url, array('class'=>'form-control',
                'placeholder'=>'Download link')) }}
                {{ $errors->first('download') }}
            </div>
        </div>
    </div>

    <div class="col-md-2"></div>

    <div class='col-md-4'>
        <div class="row">
            <div class="form-group">
                {{ Form::label('image', 'Image:') }}
                {{ Form::file('image') }}
                {{ $errors->first('image') }}
            </div>

            <div class="form-group">
                {{ Form::label('grade', 'Grade:') }}
                <select name="grade">
                    @foreach( Grade::all() as $grade )
                    <option value="{{ $grade->id }}"
                    {{ ($item->grade == $grade->id) ? "selected" : "" }}>{{ $grade->grade }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-md-12'>
        {{ Form::submit('Edit system', array('class'=>'btn btn-large btn-primary btn-block'))}}
    </div>
</div>

{{ Form::close() }}
@stop

@section('footer')
{{ HTML::script('http://js.nicedit.com/nicEdit-latest.js') }}
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@stop
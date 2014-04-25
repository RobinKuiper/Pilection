@extends('layouts.master')

@section('head')
{{ HTML::style('css/items/create/main.css') }}
@stop

@section('content')
<div class='row'>
    <div class='col-md-12 margin-bottom-20'>
        <h2>Add new item</h2>
    </div>
</div>

{{ Form::open(['url' => $type.'/store', 'files' => true, 'class' => 'itemForm', 'role' => 'form']) }}
<div class="row">
    <div class="col-md-9">
        <div class='row'>
            <div class='col-md-12'>
                <div class="form-group">
                    {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Item name')) }}
                    {{ $errors->first('title') }}
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
                <div class="form-group">
                    {{ Form::textarea('body', null, array('class'=>'form-control', 'placeholder'=>'Item info')) }}
                    {{ $errors->first('body') }}
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-6'>
                    <div class="form-group input-group">
                        <span class="input-group-addon">http://</span>
                        {{ Form::text('website_url', null, array('class'=>'form-control', 'placeholder'=>'Website Url')) }}
                        {{ $errors->first('website') }}
                    </div>
            </div>

            <div class="col-md-6">
                <div class="form-group input-group">
                    <span class="input-group-addon">http://</span>
                    {{ Form::text('download_url', null, array('class'=>'form-control', 'placeholder'=>'Download Url')) }}
                    {{ $errors->first('download') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {{ Form::submit('Add to '.$type, array('class'=>'btn submit'))}}
        </div>

        <div class="form-group">
            {{ Form::label('tags', 'Tags') }}
            {{ Form::text('tags', null, ['class' => 'form-control', 'placeholder' => 'Tags, comma seperated']) }}
        </div>



        <div class="form-group">
            {{ Form::label('grade_id', 'Grade') }}
            <select name="grade_id" class="btn btn-default">
                @foreach( Grade::all() as $grade )
                <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('type_id', 'Type') }}
            <select name="type_id" class="btn btn-default">
                @foreach( Type::all() as $type )
                <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <div class="file-upload">
                {{ Form::label('image', 'Upload image', ['class' => '']) }}
                {{ Form::file('image', ['class' => 'file-upload']) }}
                {{ $errors->first('image') }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop

@section('footer')
{{ HTML::script('http://js.nicedit.com/nicEdit-latest.js') }}
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@stop
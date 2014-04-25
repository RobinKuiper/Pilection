@extends('layouts.master')

@section('head')
{{ HTML::style('css/items/edit/main.css') }}
@stop

@section('content')
<div class='row'>
    <div class='col-md-12 margin-bottom-20'>
        <h2>Edit "{{ $item->title }}"</h2>
    </div>
</div>

{{ Form::open(['url' => $type.'/'.$item->id.'/update', 'files' => true, 'class' => 'itemForm', 'role' => 'form', 'method' => 'put']) }}
<div class="row">
    <div class="col-md-9">
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
            <div class='col-md-6'>
                <div class="form-group input-group">
                    <span class="input-group-addon">http://</span>
                    {{ Form::text('website_url', $item->website_url, array('class'=>'form-control', 'placeholder'=>'Website Url')) }}
                    {{ $errors->first('website') }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group input-group">
                    <span class="input-group-addon">http://</span>
                    {{ Form::text('download_url', $item->download_url, array('class'=>'form-control', 'placeholder'=>'Download Url')) }}
                    {{ $errors->first('download') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {{ Form::submit('Update', array('class'=>'btn submit'))}}
        </div>

        <div class="form-group">
            {{ Form::label('tags', 'Tags') }}
            {{ Form::text('tags', implode(', ', $item->tagNames()), ['class' => 'form-control', 'placeholder' => 'Tags, comma seperated']) }}
            {{ Form::hidden('old_tags', implode(', ', $item->tagNames())) }}
        </div>

        <div class="form-group">
            {{ Form::label('grade_id', 'Grade') }}
            <select name="grade_id" class="btn btn-default">
                @foreach( Grade::all() as $grade )
                <option value="{{ $grade->id }}" {{ ($item->grade == $grade->id) ? 'selected' : '' }}>{{ $grade->grade }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('type_id', 'Type') }}
            <select name="type_id" class="btn btn-default">
                @foreach( Type::all() as $type )
                <option value="{{ $type->id }}" {{ ($item->type == $type->id) ? 'selected' : '' }}>{{ $type->type }}</option>
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
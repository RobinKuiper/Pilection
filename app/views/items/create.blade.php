@extends('layouts.master')

@section('head')
<style>
    form{
        background-color: #f9f9f9;
        padding: 30px;
    }

    .file-upload {
        overflow: hidden;
        display: inline-block;
        position: relative;
        text-align: center;
    }

    .file-upload input {
        position: absolute;
        top: 0;
        left: 0;
        margin: 0;
        font-size: 70px;

        /* Loses tab index in webkit if width is set to 0 */
        opacity: 0;
        filter: alpha(opacity=0);
    }

    .itemForm input, .file-upload{
        padding: 9px;
        border: solid 1px #E5E5E5;
        outline: 0;
        font: normal 13px/100% Verdana, Tahoma, sans-serif;
        width: 200px;
        background: #FFFFFF;
    }

    .itemForm textarea{
        height: 350px;
        line-height: 150%;
    }

    .itemForm input, .itemForm textarea, .file-upload{
        box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
        -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
        -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;

        background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #eeeeee), to(#FFFFFF));
        background: -moz-linear-gradient(top, #FFFFFF, #eeeeee 1px, #FFFFFF 25px);
    }

    .itemForm input:hover, .itemForm textarea:hover,
    .itemForm input:focus, .itemForm textarea:focus, .file-upload {
        border-color: #C9C9C9;
    }

    .itemForm .submit {
        width: auto;
        padding: 9px 15px;
        background: #617798;
        border: 0;
        font-size: 14px;
        color: #FFFFFF;
    }

    .itemForm .submit:hover {
        border-color: #C9C9C9;
        background-color: #222222;
    }

    label{

    }
</style>
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
            {{ Form::label('grade', 'Grade') }}
            <select name="grade" class="btn btn-default">
                @foreach( Grade::all() as $grade )
                <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
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
{{ HTML::script('js/nicEdit/nicEdit-latest.js') }}
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@stop
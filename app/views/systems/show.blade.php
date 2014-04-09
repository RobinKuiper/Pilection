@extends('layouts.master')

@section('content')
<div class='row bottom-margin'>
    <div class='col-md-1'>
        <span>{{ HTML::image($system->path.$system->image, $system->title, ['width' => '100px', 'max-height' => '100px']) }}</span>
    </div>
    <div class='col-md-4'>
        <h2>{{ $system->title }}</h2>
    </div>
    
    @if( Auth::check() )
    <div class='col-md-1'>
        {{ link_to("systems/$system->id/edit", 'Edit', ['class' => 'btn btn-primary']) }}
    </div>
    <div class='col-md-1'>
        {{ Form::open(['route' => ['systems.destroy', $system->id], 'class' => '', 'role' => 'form', 'method' => 'delete']) }}
            {{ Form::submit('Remove', array('class'=>'btn btn-danger'))}}
        {{ Form::close() }}
    </div>
    @endif
</div>

<div class='row bottom-margin'>
    <div class='col-md-8'>
        <article>{{ $system->body }}</article>
    </div>
</div>

<div class='row bottom-margin'>
    @if( !empty($system->download) )
    <div class='col-md-1'>
        {{ link_to($system->download, 'Download', ['class' => 'btn btn-success']) }}
    </div>
    @endif
    
    @if( !empty($system->website) )
    <div class='col-md-1'>
        {{ link_to($system->website, 'Website', ['class' => 'btn btn-primary']) }}
    </div>
    @endif
</div>

<div class="row bottom-margin">
    <div class="col-md-2">
        <p>{{ link_to('/', '<< All systems...') }}</p>
    </div>
</div>
@stop
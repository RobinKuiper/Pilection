@extends('layouts.master')

@section('content')
<div class='row bottom-margin'>
    <div class='col-md-1'>
        <span>{{ HTML::image("upload/systems/images/$system->image", $system->title, ['width' => '100px', 'max-height' => '100px']) }}</span>
    </div>
    <div class='col-md-1'>
        <h2>{{ $system->title }}</h2>
    </div>
</div>

<div class='row bottom-margin'>
    <div class='col-md-8'>
        <article>{{ $system->body }}</article>
    </div>
    <!--<div class='col-md-2'>
        {{ link_to($system->url, 'Website') }}
    </div>-->
</div>

<div class='row bottom-margin'>
    <div class='col-md-1'>
        {{ link_to($system->download, 'Download', ['class' => 'btn btn-success']) }}
    </div>
    <div class='col-md-1'>
        {{ link_to($system->website, 'Website', ['class' => 'btn btn-primary']) }}
    </div>
</div>

<div class="row bottom-margin">
    <div class="col-md-2">
        <p>{{ link_to('/', '<< All systems...') }}</p>
    </div>
</div>
@stop
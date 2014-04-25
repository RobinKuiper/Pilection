@extends('layouts/master')

@section('content')
<div class="row margin-bottom-20">
    <div class="col-md-12">
        <h2>Request a feature</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <p>Please add your feature request to the comments below, thanks!</p>
    </div>
</div>

<div id="disqus_thread"></div>
@stop

@section('footer')
{{ HTML::script('js/disqus.js') }}
@stop
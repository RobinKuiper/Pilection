@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('script', $item) }}
@stop

@section('content')
<div class='row bottom-margin'>
    <div class='col-md-4'>
        <h2>{{ $item->title }}</h2>
    </div>
    
    @if( Auth::check() )
    <div class='col-md-1'>
        {{ link_to("scripts/$item->id/edit", 'Edit', ['class' => 'btn btn-primary']) }}
    </div>
    <div class='col-md-1'>
        {{ Form::open(['route' => ['scripts.destroy', $item->id], 'class' => '', 'role' => 'form', 'method' => 'delete']) }}
            {{ Form::submit('Remove', array('class'=>'btn btn-danger'))}}
        {{ Form::close() }}
    </div>
    @endif
</div>

<div class='row bottom-margin'>
    <div class='col-md-4'>
        <p>Views: {{ $item->viewcount }}</p>
    </div>
</div>

<div class='row bottom-margin'>
    <div class='col-md-8'>
        <article>{{ $item->body }}</article>
    </div>
</div>

<div class='row bottom-margin'>
    <div class='col-md-8'>
        <article>{{ $item->script }}</article>
    </div>
</div>

<div id="disqus_thread"></div>

@stop

@section('footer')
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'rpios'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
@stop
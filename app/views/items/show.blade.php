@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('item', $item, $type) }}
@stop

@section('content')
<div class='row margin-bottom-40'>
    <div class='col-md-1'>
        <span>{{ HTML::image($item->path.$item->image, $item->title, ['width' => '100px', 'max-height' => '100px']) }}</span>
    </div>
    <div class='col-md-4'>
        <h2>{{ $item->title }}</h2>
    </div>

    @if( Auth::check() && Auth::user()->id == $item->user_id )
    <div class='col-md-1'>
        <a href="{{ $item->id }}/edit" class="btn btn-primary">
            <span class="glyphicon glyphicon-edit"></span>
            Edit
        </a>

    </div>
    <div class='col-md-1'>
        {{ Form::open(['url' => $type.'/'.$item->id.'/destroy', 'class' => '', 'role' => 'form', 'method' => 'delete']) }}
        <button type="submit" class="btn btn-danger">
            <span class="glyphicon glyphicon-remove"></span>
            Remove
        </button>
        {{ Form::close() }}
    </div>
    @endif
</div>

<div class='row margin-bottom-40'>
    <div class='col-md-12'>
        <p>Views: {{ $item->viewcount }}</p>
    </div>
</div>

<div class='row margin-bottom-40'>
    <div class='col-md-12'>
        <article>{{ $item->body }}</article>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="rating"></div>
    </div>
</div>

<div class='row margin-bottom-40'>
    <div class='col-md-12'>
        <p>
            Tags:
            @foreach($item->tags as $tag)
            {{ link_to('tags/'.$tag->tag, $tag->tag) }},
            @endforeach
        </p>
    </div>
</div>


<div class='row margin-bottom-40'>
    @if( !empty($item->download_url) )
    <div class='col-md-1'>
        {{ link_to($item->download_url, 'Download', ['class' => 'btn btn-success']) }}
    </div>
    @endif

    @if( !empty($item->website_url) )
    <div class='col-md-1'>
        {{ link_to($item->website_url, 'Website', ['class' => 'btn btn-primary']) }}
    </div>
    @endif
</div>

<div id="disqus_thread"></div>

@stop

@section('footer')
{{ HTML::script('js/vendor/raty/jquery.raty.js') }}

<script>
    $('#rating').raty({
        half: true,
        readOnly: {{ ($item->voted) ? 'true' : 'false' }},
    path: '{{ url('js/vendor/raty') }}',
        score: {{ $item->rating }},
    size: 24,
        starHalf: 'star-half-big.png',
        starOff: 'star-off-big.png',
        starOn: 'star-on-big.png',
        click: function(score, evt) {
        var id = {{ $item->id }}, type = '{{ $type }}';
    $.get( '/ajax/getRating', { id: id, score: score, type: type }, function( data ) {
        alert(data);
    });
    }
    });
</script>

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
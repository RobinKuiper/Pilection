@extends('layouts/master')

@section('content')
<div class="jumbotron">
    <h1>Welcome, {{ (isset(Auth::user()->username)) ? Auth::user()->username : 'Geeks' }}! ;)</h1>

    <p>On this website you will find a collection of Raspberry Pi resources.</p>

    <p><a href="about" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
</div>

<div class="row">

    <div class="col-md-3">
        <h3>Latest Systems</h3>

        <div class="list-group">
            @foreach ($items['systems']['latest'] as $item)
            <a class="list-group-item" href="/systems/{{ $item->id }}" title="{{ $item->title }}">
                {{ $item->title }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-3">
        <h3>Latest Scripts</h3>

        <div class="list-group">
            @foreach ($items['scripts']['latest'] as $item)
            <a class="list-group-item" href="/scripts/{{ $item->id }}" title="{{ $item->title }}">
                {{ $item->title }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-3">
        <h3>Latest Projects</h3>

        <div class="list-group">
            @foreach ($items['projects']['latest'] as $item)
            <a class="list-group-item" href="/projects/{{ $item->id }}" title="{{ $item->title }}">
                {{ $item->title }}
            </a>
            @endforeach
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-3">
        <h3>Top Systems</h3>

        <div class="list-group">
            @if( count($items['systems']['top']) > 0)
            @foreach ($items['systems']['top'] as $item)
            <a class="list-group-item" href="/systems/{{ $item['item']['id'] }}" title="{{ $item['item']['title'] }}">
                <span class="badge">{{ $item['rating'] }}</span>
                {{ $item['item']['title'] }}
            </a>
            @endforeach
            @endif
        </div>
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-3">
        <h3>Top Scripts</h3>
        <ul class="list-group">
            @if( count($items['scripts']['top']) > 0)
            @foreach ($items['scripts']['top'] as $item)
            <a class="list-group-item" href="/scripts/{{ $item['item']['id'] }}" title="{{ $item['item']['title'] }}">
                <span class="badge">{{ $item['rating'] }}</span>
                {{ $item['item']['title'] }}
            </a>
            @endforeach
            @endif
        </ul>
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-3">
        <h3>Top Projects</h3>
        <ul class="list-group">
            @if( count($items['projects']['top']) > 0)
            @foreach ($items['projects']['top'] as $item)
            <a class="list-group-item" href="/projects/{{ $item['item']['id'] }}" title="{{ $item['item']['title'] }}">
                <span class="badge">{{ $item['rating'] }}</span>
                {{ $item['item']['title'] }}
            </a>
            @endforeach
            @endif
        </ul>
    </div>

</div>
@stop

@section('footer')
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'rpios'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script');
        s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
@stop
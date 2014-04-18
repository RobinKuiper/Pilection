@extends('layouts/master')

@section('content')
<div class="jumbotron">
    <h1>Welcome, {{ (isset(Auth::user()->username)) ? Auth::user()->username : 'Geeks' }}! ;)</h1>

    <p>On this website you will find a collection of Raspberry Pi resources.</p>

    <p><a href="about" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
</div>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th colspan="5">Latest Systems</th>
    </tr>
    </thead>
    <tbody>
    @if(count($items['systems']['latest']) > 0)
    @foreach($items['systems']['latest'] as $item)
    @if ($item->image == null)
    {? $path = 'images/' ?}
    {? $item->image = 'system_default.png' ?}
    @else {? $path = 'upload/items/images/' ?}
    @endif
    <tr>
        <td>
            <a href='{{ $item->type }}/{{ $item->id }}' title='{{ $item->title }}'>{{ HTML::image($path . $item->image,
                $item->title, ['width' => '100px', 'max-height' => '100px']) }}</a>
        </td>
        <td>
            <h3> {{ link_to("$item->type/$item->id", $item->title) }} </h3>

            <p> {{ Str::words($item->body, 50, $end = '...') }} </p>
        </td>
        <td>
            <div id="{{ $item->id }}" class="rating" data-score="{{ Rating::getRatingForItem($item->id) }}"
                 data-type="{{ $item->type }}" data-voted="{{ Rating::voted($item->id) }}"></div>
        </td>
        <td><span class="glyphicon glyphicon-eye-open"></span> {{ Views::getViews($item->id, $item->type) }}</td>
        <td>{{ link_to("systems/$item->id#disqus_thread", '0 comments') }}</td>
    </tr>
    @endforeach
    @else
    <tr>
        <td>There aren't any systems currently. {{ link_to(route('items.create', 'systems'), 'Create') }} one!</td>
    </tr>
    @endif
    </tbody>
</table>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th colspan="5">Latest Scripts</th>
    </tr>
    </thead>
    <tbody>
    @if(count($items['scripts']['latest']) > 0)
    @foreach($items['scripts']['latest'] as $item)
    @if ($item->image == null)
    {? $path = 'images/' ?}
    {? $item->image = 'system_default.png' ?}
    @else {? $path = 'upload/items/images/' ?}
    @endif
    <tr>
        <td>
            <a href='{{ $item->type }}/{{ $item->id }}' title='{{ $item->title }}'>{{ HTML::image($path . $item->image,
                $item->title, ['width' => '100px', 'max-height' => '100px']) }}</a>
        </td>
        <td>
            <h3> {{ link_to("$item->type/$item->id", $item->title) }} </h3>

            <p> {{ Str::words($item->body, 50, $end = '...') }} </p>
        </td>
        <td>
            <div id="{{ $item->id }}" class="rating" data-score="{{ Rating::getRatingForItem($item->id) }}"
                 data-type="{{ $item->type }}" data-voted="{{ Rating::voted($item->id) }}"></div>
        </td>
        <td><span class="glyphicon glyphicon-eye-open"></span> {{ Views::getViews($item->id, $item->type) }}</td>
        <td>{{ link_to("systems/$item->id#disqus_thread", '0 comments') }}</td>
    </tr>
    @endforeach
    @else
    <tr>
        <td>There aren't any scripts currently. {{ link_to(route('items.create', 'scripts'), 'Create') }} one!</td>
    </tr>
    @endif
    </tbody>
</table>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th colspan="5">Latest Projects</th>
    </tr>
    </thead>
    <tbody>
    @if(count($items['projects']['latest']) > 0)
    @foreach($items['projects']['latest'] as $item)
    @if ($item->image == null)
    {? $path = 'images/' ?}
    {? $item->image = 'system_default.png' ?}
    @else {? $path = 'upload/items/images/' ?}
    @endif
    <tr>
        <td>
            <a href='{{ $item->type }}/{{ $item->id }}' title='{{ $item->title }}'>{{ HTML::image($path . $item->image,
                $item->title, ['width' => '100px', 'max-height' => '100px']) }}</a>
        </td>
        <td>
            <h3> {{ link_to("$item->type/$item->id", $item->title) }} </h3>

            <p> {{ Str::words($item->body, 50, $end = '...') }} </p>
        </td>
        <td>
            <div id="{{ $item->id }}" class="rating" data-score="{{ Rating::getRatingForItem($item->id) }}"
                 data-type="{{ $item->type }}" data-voted="{{ Rating::voted($item->id) }}"></div>
        </td>
        <td><span class="glyphicon glyphicon-eye-open"></span> {{ Views::getViews($item->id, $item->type) }}</td>
        <td>{{ link_to("systems/$item->id#disqus_thread", '0 comments') }}</td>
    </tr>
    @endforeach
    @else
    <tr>
        <td>There aren't any projects currently. {{ link_to(route('items.create', 'projects'), 'Create') }} one!</td>
    </tr>
    @endif
    </tbody>
</table>

@stop

@section('footer')
@section('footer')
{{ HTML::script('js/raty/jquery.raty.js') }}

<script>
    $('.rating').raty({
        half: true,
        path: '{{ url('js/raty') }}',
        readOnly: function(){
        return $(this).attr('data-voted');
    },
    score: function(){
        return $(this).attr('data-score');
    },
    click: function(score, evt) {
        var id = $(this).attr('id'), type = $(this).attr('data-type');
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
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
@stop
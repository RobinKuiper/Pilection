@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render($breadcrumb, Str::title($title)) }}
@stop

@section('content')
<div class="row margin-bottom-40">
    <div class="col-md-2">
        <h2>{{ Str::title($title) }}</h2>
    </div>

    <div class="col-md-10 text-right">
        @if(Auth::check() && isset($type))
        {{ link_to($type.'/create', 'Post new', ['class' => 'btn btn-success']) }}
        @endif
    </div>
</div>

@if(count($items) > 0)
    @foreach($items as $item)

        @if ($item->image == null)
            {? $path = 'images/' ?}
            {? $item->image = 'system_default.png' ?}
        @else {? $path = 'upload/items/images/' ?}
        @endif

        <div class="row border-bottom margin-bottom-10 padding-bottom-10">
            <div class="col-md-2">
                <a href='{{ $item->type }}/{{ $item->id }}' title='{{ $item->title }}'>{{ HTML::image($path . $item->image,
                    $item->title, ['width' => '100px', 'max-height' => '100px']) }}</a>
            </div>

            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-10">
                        <h3>{{ link_to("$item->type/$item->id", $item->title) }}</h3>
                    </div>

                    <div class="col-md-2">
                        <div id="{{ $item->id }}" class="rating" style="padding-bottom: 4px;" data-score="{{ Rating::getRatingForItem($item->id) }}"
                             data-type="{{ $item->type }}" data-voted="{{ Rating::voted($item->id) }}"></div>
                        <span class="icons"><span class="glyphicon glyphicon-eye-open"></span> {{ Views::getViews($item->id, $item->type) }}</span>
                        <span class="icons"><span class="glyphicon glyphicon-comment"></span> {{ link_to("systems/$item->id#disqus_thread", '0') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>{{{ Str::words($item->body, 50, $end = '...') }}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="row">
        <div class="col-md-12">
            <p>There aren't any {{ $type }} currently. {{ link_to($type.'/create', 'Create') }} one!</p>
        </div>
    </div>
@endif
@stop

@section('footer')
{{ HTML::script('js/vendor/raty/jquery.raty.js') }}

<script>
    $('.rating').raty({
        half: true,
        path: '{{ url('js/vendor/raty') }}',
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
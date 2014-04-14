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

<div class="row margin-bottom-20">
    @if(Route::currentRouteName() != 'items.index')
    <span style="font-weight: 900;">Type: </span>
    <a href="#" class="filter btn btn-default" data-filter=".systems">Systems</a>
    <a href="#" class="filter btn btn-default" data-filter=".scripts">Scripts</a>
    <a href="#" class="filter btn btn-default" data-filter=".projects">Projects</a>
    @endif

    @if(Route::currentRouteName() != 'tags.index')
    <span style="font-weight: 900;">Tag: </span>
    <a href="#" class="filter btn btn-default" data-filter="all">Show All</a>
    @foreach(Tag::all() as $tag)
    <a href="#" class="filter btn btn-default" data-filter=".{{ $tag->tag }}">{{ $tag->tag }}</a>
    @endforeach
    @endif

    @if(Route::currentRouteName() != 'grades.index')
    <span style="font-weight: 900;">Grade: </span>
    @foreach(Grade::all() as $grade)
    <a href="#" class="filter btn btn-default" data-filter=".{{ $grade->grade }}">{{ $grade->grade }}</a>
    @endforeach
    @endif

    <!--<span style="font-weight: 900;">Sort: </span>
    <a class="sort btn btn-default" href="#" data-sort="Default">Default</a>
    <a class="sort btn btn-default" href="#" data-sort="myorder:asc">Asc</a>
    <a class="sort btn btn-default" href="#" data-sort="myorder:desc">Desc</a>
    <a class="sort btn btn-default" href="#" data-sort="random">Random</a>-->
</div>

<!--
<div class="sort" data-sort="default">Default</div>
<div class="sort" data-sort="myorder:asc">Ascending</div>
<div class="sort" data-sort="myorder:desc">Descending</div>
<div class="sort" data-sort="random">Random</div>
-->

<div id="MixIt">
@if(count($items) > 0)
    @foreach($items as $item)

        @if ($item->image == null)
            {? $path = 'images/' ?}
            {? $item->image = 'system_default.png' ?}
        @else {? $path = 'upload/items/images/' ?}
        @endif

        {? $tags = '' ?}
        @foreach(Tag::getTagsByItem($item->id) as $tag)
            {? $tags .= $tag->tag.' ' ?}
        @endforeach

        {? $grades = '' ?}
        @foreach(Grade::getGradeByItem($item->id) as $grade)
            {? $grades .= $grade->grade.' ' ?}
        @endforeach

        <div data-myorder="{{ $item->id }}" class="mix {{ $item->type }} {{ $tags }} {{ $grades }} row border-bottom margin-bottom-10 padding-bottom-10">
            <div class="col-md-2">
                <a href='{{ route('items.show', [$item->type, $item->title]) }}' title='{{ $item->title }}'>{{ HTML::image($path . $item->image,
                    $item->title, ['width' => '100px', 'max-height' => '100px']) }}</a>
            </div>

            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-10">
                        <h3>{{ link_to(route('items.show', [$item->type, $item->title]), $item->title) }}</h3>
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
</div>
@stop

@section('footer')
{{ HTML::script('js/vendor/raty/jquery.raty.js') }}
<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>

<script>
    // On document ready:

    $(function(){

        // Instantiate MixItUp:

        $('#MixIt').mixItUp();

    });
</script>

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
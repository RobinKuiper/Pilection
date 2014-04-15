@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render($breadcrumb, Str::title($title)) }}
@stop

@section('content')

<div class="row margin-bottom-20">
    <div class="col-md-4">
        <h2>{{ Str::title($title) }}</h2>
    </div>

    <div class="col-md-8 text-right">
        @if(Auth::check() && isset($type))
        {{ link_to($type.'/create', 'Post new', ['class' => 'btn btn-success']) }}
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Filters</div>
            </div>
            <div class="panel-body">
                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#" class="filter" data-filter="all">Show All</a></li>
                    </ul>
                </nav>

                @if(Route::currentRouteName() != 'items.index')
                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li style="font-weight: 900">Type</li>
                        <li><a href="#" class="filter" data-filter=".systems">Systems</a></li>
                        <li><a href="#" class="filter" data-filter=".scripts">Scripts</a></li>
                        <li><a href="#" class="filter" data-filter=".projects">Projects</a></li>
                    </ul>
                </nav>
                @endif

                @if(Route::currentRouteName() != 'tags.index')
                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li style="font-weight: 900">Tag</li>
                        @foreach(Tag::all() as $tag)
                        <li><a href="#" class="filter" data-filter=".{{ $tag->tag }}">{{ $tag->tag }}</a></li>
                        @endforeach
                    </ul>
                </nav>
                @endif

                @if(Route::currentRouteName() != 'grades.index')
                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li style="font-weight: 900">Grade</li>
                        @foreach(Grade::all() as $grade)
                        <li><a href="#" class="filter" data-filter=".{{ $grade->grade }}">{{ $grade->grade }}</a></li>
                        @endforeach
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="well well-sm">
            <strong>Category Title</strong>
            <div class="btn-group">
                <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                        class="glyphicon glyphicon-th"></span>Grid</a>
            </div>
        </div>
        <div id="MixIt" class="row list-group">
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


            <div class="item col-md-3 mix {{ $type }} {{ $tags }} {{ $grades }}">
                <div class="thumbnail">
                    <div class="caption">
                        <h4 class="group inner list-group-item-heading">{{ link_to(route('items.show', [$item->type, $item->title]), $item->title) }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="{{ $item->id }}" class="rating" style="padding-bottom: 4px;" data-score="{{ Rating::getRatingForItem($item->id) }}"
                                     data-type="{{ $item->type }}" data-voted="{{ Rating::voted($item->id) }}"></div>
                            </div>
                            <div class="col-md-6">
                                <span class="glyphicon glyphicon-eye-open"></span>{{ Views::getViews($item->id, $item->type) }}
                                <span class="glyphicon glyphicon-comment"></span>{{ link_to("systems/$item->id#disqus_thread", '0') }}
                            </div>
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
    </div>
</div>


@stop

@section('footer')
{{ HTML::script('js/vendor/raty/jquery.raty.js') }}
{{ HTML::script('http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js') }}

<script>
    $(function(){
        $('#MixIt').mixItUp({
            animation: {
                enable: true,
            }
        });
    });

    $('#list').on('click', function(){
        event.preventDefault();
        $('#MixIt .item').addClass('list-group-item');
    });

    $('#grid').on('click', function(){
        event.preventDefault();
        $('#MixIt .item').removeClass('list-group-item');
        $('#MixIt .item').addClass('grid-group-item');
    });
</script>

<script>
    $('#list').click(function(event){
        event.preventDefault();
        $('#MixIt .item').addClass('list-group-item');});
    $('#grid').click(function(event){
        event.preventDefault();
        $('#MixIt .item').removeClass('list-group-item');
        $('#MixIt .item').addClass('grid-group-item');
    });


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
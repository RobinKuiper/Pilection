@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render($breadcrumb, Str::title($title)) }}
@stop

@section('head')
<style>
    #filters{ display: none; }

    #MixIt .item{
        cursor: pointer;
    }

    #MixIt .item:hover{
        background-color: #eeeeee;
    }
</style>
@stop

@section('content')

<div class="row margin-bottom-20">
    <div class="col-md-2">
        <h2><!--{{ Str::title($title) }}-->Database</h2>
    </div>

    <div class="col-md-10 text-center">
        @if(Auth::check() && isset($type))
        {{ link_to($type.'/create', 'Post new', ['class' => 'btn btn-success']) }}
        @elseif(Config::get('app.advertising'))
        <div class="padding-top-10">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Pilection_Items_top_2 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-2044382203546332"
                 data-ad-slot="5503479607"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        @endif
    </div>
</div>

<style>
    #filters li a.active{ background-color: #eeeeee; }
    #tags a.active{ background-color: #222222; color: #ffffff !important; }
</style>

<div class="row">
    <div class="col-md-2" id="filters">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Filters</div>
            </div>
            <div class="panel-body">
                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="margin-bottom-10 margin-top-10" style="font-weight: 900">Type</li>
                        @foreach($types as $type)
                        <li><a href="#" class="filter" data-filter=".{{ $type->type }}">{{ $type->type }}</a></li>
                        @endforeach
                    </ul>
                </nav>

                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="margin-bottom-10 margin-top-10" style="font-weight: 900">Grade</li>
                        @foreach($grades as $grade)
                        <li><a href="#" class="filter" data-filter=".{{ $grade->grade }}">{{ $grade->grade }}</a></li>
                        @endforeach
                    </ul>
                </nav>

                <nav id="tags">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="margin-bottom-10 margin-top-10" style="font-weight: 900">Tag</li>

                        @foreach($tags as $tag)
                        <a href="#" class="filter" data-filter=".{{ $tag->tag }}" rel="{{ $tag->itemcount($tag->id) }}">[{{ $tag->tag }}]</a>
                        @endforeach

                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="items">
        <div class="row list margin-bottom-10 padding-bottom-10" style="background-color: #f9f9f9; padding-top: 5px; font-size: 10pt">
            <div class="title col-md-4">Title</div>

            <div class="hidden-info col-md-2">Posted at</div>
            <div class="hidden-info col-md-2">User</div>

            <div class="info col-md-2">Rating</div>

            <div class="info col-md-2"></div>
        </div>

        <style>
            .item{
                display: none;
            }

            .{{ $filter }} {
                display: block;
            }

            .glyphicon-chevron-down{
                color: #cccccc;
                margin-left: 40px;
            }

            .item:hover .glyphicon-chevron-down{
                color: #222222 !important;
            }
        </style>

        <div id="MixIt" class="row">
            @if(count($items) > 0)
                @foreach($items as $item)
                    <div class="row list padding-top-10 padding-bottom-10 item border-top {{ $item->type->type }} {{ $itemTags[$item->id] }} {{ $item->grade->grade }}">
                        <div class="title col-md-4">{{ link_to(route('items.show', [$item->type->type, $item->slug]), $item->title) }}</div>

                        <div class="hidden-info col-md-2">{{ date("d-m-Y H:i", strtotime($item->created_at)) }}</div>
                        <div class="hidden-info col-md-2">{{ link_to(route('users.show', $item->user->username), $item->user->username) }}</div>

                        <div class="info col-md-2">
                            <span id="{{ $item->id }}" class="rating" style="padding-bottom: 4px;" data-score="{{ Rating::getRatingForItem($item->id) }}"
                                 data-type="{{ $item->type }}" data-voted="{{ Rating::voted($item->id) }}"></span>
                        </div>

                        <div class="info col-md-2 text-right">
                            <span class="icons"><span class="glyphicon glyphicon-comment"></span> {{ link_to("systems/$item->slug#disqus_thread", '0') }}</span>
                            <span class="icons"><span class="glyphicon glyphicon-eye-open"></span> {{ count($item->views) }}</span>
                            <div class="glyphicon glyphicon-chevron-down" style="margin-left: 40px; color: #cccccc"></div>
                        </div>
                    </div>

                    <div class="row item-body" style="display: none; padding: 10px;">
                        <div class="col-md-12">
                            {{ HTML::image($item->image->url(), $item->title, ['width' => '100px', 'max-height' => '100px', 'style' => 'float:left; margin: 10px;']) }}

                            {{ $item->body }}
                        </div>
                    </div>

                @endforeach
            @else
            <div class="row">
                <div class="col-md-12">
                    <p>There aren't any {{ (isset($type)) ? $type : 'items' }} currently. {{ (isset($type)) ? link_to($type.'/create', 'Create') . ' one!' : '' }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div id="disqus_thread"></div>

@stop

@section('footer')
{{ HTML::script('js/raty/jquery.raty.js') }}
{{ HTML::script('js/mixitup/jquery.mixitup.min.js') }}
{{ HTML::script('js/tagcloud/jquery.tagcloud.js') }}

<script>
    $.fn.tagcloud.defaults = {
        size: {start: 12, end: 17, unit: 'px'},
        color: {start: '#428bca', end: '#222222'}
    };

    $(function () {
        $('#tags a').tagcloud();
    });
</script>

<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'pilection'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>

<script>
    $(function(){
        $('#MixIt .item').on('click', function(e){
            if(e.target.localName == 'div'){
                var __this = $(this).next('.item-body');
                $('.item-body').not(__this).slideUp();
                $(this).next('.item-body').slideToggle();
            }
        });
    });


    $(function(){
        $('#MixIt .item').addClass('mix');
        $('#items').removeClass('col-md-12');
        $('#items').addClass('col-md-10');

        $('#filters').show();
        $('#changeLayout').show();

        $('#MixIt').mixItUp({
            animation: {
                enable: true,
            },
            controls: {
                toggleFilterButtons: true,
                toggleLogic: 'and'
            },
            load: {
                filter: '{{ (isset($filter)) ? '.'.$filter : 'all' }}'
            }
        });

    });
</script>

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
            $('#' + id).fadeOut(500, function(){
                $(this).html('Thanks!').fadeIn(1000);
            });
        });
    }
    });
</script>

<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'pilection'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
@stop
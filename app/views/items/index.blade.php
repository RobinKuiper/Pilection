@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render($breadcrumb, Str::title($title)) }}
@stop

@section('head')
{{ HTML::style('css/items/index/main.css') }}
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
                        <li><a href="#" class="filter" data-filter=".{{ $type->slug }}">{{ $type->type }}</a></li>
                        @endforeach
                    </ul>
                </nav>

                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="margin-bottom-10 margin-top-10" style="font-weight: 900">Grade</li>
                        @foreach($grades as $grade)
                        <li><a href="#" class="filter" data-filter=".{{ $grade->slug }}">{{ $grade->grade }}</a></li>
                        @endforeach
                    </ul>
                </nav>

                <nav id="tags">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="margin-bottom-10 margin-top-10" style="font-weight: 900">Tag</li>

                        @foreach($tags as $tag)
                        <a href="#" class="filter" data-filter=".{{ $tag->slug }}" rel="{{ $tag->count }}">[{{ $tag->name }}]</a>
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

        <div id="MixIt" class="row">
            @if(count($items) > 0)
                @foreach($items as $item)
                    <div class="row list padding-top-10 padding-bottom-10 item border-top {{ $item->type->slug }} {{ implode(' ', $item->tagNames()) }} {{ $item->grade->slug }}">
                        <div class="title col-md-4">{{ link_to(route('items.show', [$item->type->slug, $item->slug]), $item->title) }}</div>

                        <div class="hidden-info col-md-2">{{ date("d-m-Y H:i", strtotime($item->created_at)) }}</div>
                        <div class="hidden-info col-md-2">{{ link_to(route('users.show', $item->user->username), $item->user->username) }}</div>

                        <div class="info col-md-2">
                            <span id="{{ $item->id }}" class="rating" style="padding-bottom: 4px;" data-score="{{ Rating::getRatingForItem($item->id) }}"
                                 data-type="{{ $item->type_id }}" data-voted="{{ Rating::voted($item->id) }}"></span>
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
{{ HTML::script('js/disqus.js') }}
{{ HTML::script('js/items/index/main.js') }}

<script>
var filter = '{{ (isset($filter)) ? '.'.$filter : 'all' }}';
</script>
@stop

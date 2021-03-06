@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('item', $item, $type) }}
@stop

@section('content')
<div class='row margin-bottom-40'>
    <div class="col-md-9">
        <div class="row border-bottom margin-bottom-40 padding-bottom-10">
            <div class='col-md-2'>
                <span>{{ HTML::image($item->image->url(), $item->title, ['width' => '100px', 'max-height' => '100px']) }}</span>
            </div>
            <div class='col-md-10'>
                <div class="row">
                    <div class='col-md-6'>
                        <h2>{{ $item->title }}</h2>
                        <p>Posted by {{ link_to(route('users.show', User::find($item->user_id)->username), User::find($item->user_id)->username) }}
                        at {{ date("d-m-Y H:i", strtotime($item->created_at)) }}</p>
                        <span class="icons"><span class="glyphicon glyphicon-comment"></span> {{ link_to("$item->type/$item->slug#disqus_thread", '0') }}</span>
                        <span class="icons"><span class="glyphicon glyphicon-eye-open"></span> {{ count($item->views) }}</span>
                        <span class="icons" id="rating" data-score="{{ $item->rating }}"
                              data-type="{{ $item->type_id }}" data-voted="{{ $item->voted }}"></span>
                        <span>{{ Rating::countRatings($item->id) }}</span>
                        <span id="rating_callback" style="display: none"></span>
                    </div>

                    <div class="col-md-2">
                        <span class="share" data-title="{{ $item->title }}" data-text="{{ Str::words($item->body, 10, $end = '...') }}"
                              data-image="{{ $item->image->url() }}"></span>
                    </div>

                    <div class="col-md-4">
                        @if( Auth::check() && Auth::user()->id == $item->user_id )
                            {{ Form::open(['url' => $type.'/'.$item->id.'/destroy', 'class' => '', 'role' => 'form', 'method' => 'delete']) }}
                            <a href="{{ $item->id }}/edit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-edit"></span>
                                Edit
                            </a>

                            <button type="submit" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                                Remove
                            </button>
                            {{ Form::close() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <article>{{ $item->body }}</article>
        </div>

        @if(Config::get('app.advertising'))
        <div class="row margin-top-40 text-center">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Pilection_itemShow_belowBody2 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-2044382203546332"
                 data-ad-slot="6701011209"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        @endif
    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Navigation</div>
            </div>
            <div class="panel-body">
                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="http://wiki.pilection.eu/index.php/{{ $item->slug }}/Installation">Install Guide</a></li>
                        @if( !empty($item->website_url) )
                        <li>{{ link_to($item->website_url, 'Website') }}</li>
                        @endif
                        @if( !empty($item->download_url) )
                        <li>{{ link_to($item->download_url, 'Download') }}</li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>

        @if(Config::get('app.advertising'))
        <div class="margin-bottom-20">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Pilection_itemShow_sidebar -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:260px;height:60px"
                 data-ad-client="ca-pub-2044382203546332"
                 data-ad-slot="7767445208"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">Tags</div>
            <div class="panel-bod">
                <nav>
                    <ul class="nav nav-pills nav-stacked">
                        @foreach($item->tagNames() as $tag)
                        <li>{{ link_to('tag/'.$tag, $tag) }}</li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div id="disqus_thread"></div>

@stop

@section('footer')
{{ HTML::script('js/raty/jquery.raty.js') }}
{{ HTML::script('js/carrot/share-button/share.min.js') }}
{{ HTML::script('js/disqus.js') }}
{{ HTML::script('js/items/show/main.js') }}
@stop

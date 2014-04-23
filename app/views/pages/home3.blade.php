@extends('layouts/master')

@section('head')
<style>
    .list-group-item{ border:none; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{ border-top-color: transparent; border-radius: 0; }
</style>
@stop

@section('content')
<div class="jumbotron">
    <h1>Welcome, {{ (isset(Auth::user()->username)) ? Auth::user()->username : 'Geeks' }}! ;)</h1>

    <p>On this website you will find a collection of Raspberry Pi resources.</p>

    <p><a href="about" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="row border-bottom margin-bottom-20">
            <div class="col-md-12">
                <h2>Pilection.eu launched</h2>
                <p>Posted by {{ link_to(route('users.show', 'RobinKuiper'), 'RobinKuiper') }}
                    at {{ date("d-m-Y H:i", '1398101939') }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>The first version of <a href="http://pilection.eu" title="Pilection">Pilection</a> is launched today!<br>
                    We will try to keep track of <a href="http://raspberrypi.org" title="Raspberry Pi">Raspberry Pi</a> resources, but we need your help, please submit any OS, script, software, etc designed for the Pi, so we can keep a nice collection here.</p>

                <p>Whenever you think something is interesting, you can login to your account and create a new item.<br>
                    Not willing to register? No problem, you can submit a item <a href="#" title="#">here</a>, and we will post it!</p>

                <p>Like we said, this is the first version, so there will be more features in the future.</p>

                <p>Found any bugs/issues? Please report them here: <a href="https://bitbucket.org/recodenl/pilection/issues" title="Pilection Issue Tracker">Pilection Issue Tracker</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="margin-bottom-20">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Pilection_home -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:360px;height:80px"
                 data-ad-client="ca-pub-2044382203546332"
                 data-ad-slot="7907046009"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" style="font-weight: 900">
                <a href="http://www.reddit.com/r/raspberry_pi" target="_blank">
                    <img src="http://www.redditstatic.com/about/assets/reddit-logo.png" style="height: 40px;">
                </a>
                <a href="http://www.raspberrypi.org" target="_blank">
                    <img src="http://84.77.221.113/weather/raspberry_logo.png" style="height: 40px">
                </a>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#new" data-toggle="tab">Latest</a></li>
                <li><a href="#hot" data-toggle="tab">Hot</a></li>
                <li><a href="#top" data-toggle="tab">Top</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="new">
                    <ul class="list-group">
                        @foreach($reddit['new']->data->children as $item)
                        <li class="list-group-item" style="padding: 15px;">{{ link_to($item->data->url, $item->data->title, ['target' => '_blank']) }} <small style="float: right">{{ link_to('http://reddit.com'.$item->data->permalink, $item->data->num_comments . ' comment(s)') }}</small></li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane" id="hot">
                    <ul class="list-group">
                        @foreach($reddit['hot']->data->children as $item)
                        <li class="list-group-item" style="padding: 15px;">{{ link_to($item->data->url, $item->data->title, ['target' => '_blank']) }} <small style="float: right">{{ link_to('http://reddit.com'.$item->data->permalink, $item->data->num_comments . ' comment(s)') }}</small></li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane" id="top">
                    <ul class="list-group">
                        @foreach($reddit['top']->data->children as $item)
                        <li class="list-group-item" style="padding: 15px;">{{ link_to($item->data->url, $item->data->title, ['target' => '_blank']) }} <small style="float: right">{{ link_to('http://reddit.com'.$item->data->permalink, $item->data->num_comments . ' comment(s)') }}</small></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



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
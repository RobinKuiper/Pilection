<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ (isset($title)) ? 'Pilection :: '.Str::title($title) : 'Pilection' }}</title>

    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css') }}
    {{ HTML::style('css/main.css') }}
    {{ HTML::style('css/master.css') }}

    @yield('head')
</head>

<body>

<header>
    <nav class="navbar navbar-inverse border-green" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" title="Pilection" class="navbar-brand">
                    {{ HTML::image('favicon.ico', 'Pilection') }}
                    Pilection
                    <sup style="position: absolute; top: 37px; left: 70px; font-size: 7pt;">Beta</sup>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class='{{{ (isset($active) && $active == 'systems') ? 'active' : '' }}}'>{{ Link_to('systems', 'Systems') }}</li>
                    <li class='{{{ (isset($active) && $active == 'software') ? 'active' : '' }}}'>{{ Link_to('software', 'Software') }}</li>
                    <li class='{{{ (isset($active) && $active == 'scripts') ? 'active' : '' }}}'>{{ Link_to('scripts', 'Scripts') }}</li>
                    <li class='{{{ (isset($active) && $active == 'projects') ? 'active' : '' }}}'>{{ Link_to('projects', 'Projects') }}</li>
                </ul>
                {{ Form::open(['route' => 'search.store', 'class' => 'navbar-form navbar-left', 'role' => 'search']) }}
                <div class="form-group">
                    {{ Form::text('q', null, ['id' => 'search', 'class' => 'form-control', 'placeholder' => 'Search']) }}
                    {{ Form::hidden('title', Input::old('title'), ['id' => 'title']) }}
                </div>
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                    Search
                </button>
                {{ Form::close() }}
                <ul class='nav navbar-nav'>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tags <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach(Tag::all() as $tag)
                            <li>{{ link_to('tags/'.$tag->tag, $tag->tag) }}</li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class='nav navbar-nav'>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grades <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach(Grade::all() as $grade)
                            <li>{{ link_to('grade/'.$grade->grade, $grade->grade) }}</li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class='{{{ (isset($active) && $active == 'home') ? 'active' : '' }}}'>{{ Link_to('/', 'Home') }}</li>
                    <li class='{{{ (isset($active) && $active == 'about') ? 'active' : '' }}}'>{{ Link_to('about', 'About') }}</li>
                    @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px; padding-bottom: 0px;">
                            <img src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?s=32" style="margin-right: 5px">
                            {{ Auth::user()->username }}
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="margin-top: 5px;">
                            <li>{{ link_to(route('users.index'), 'Profile') }}</li>
                            <li>{{ link_to(route('users.edit', 'profile'), 'Edit Profile') }}</li>

                            <li class="divider"></li>
                            <li>{{ Link_to(route('sessions.destroy'), 'Logout') }}</li>
                        </ul>
                    </li>
                    @else
                    <li class='{{{ (isset($active) && $active == 'register') ? 'active' : '' }}}'>{{ Link_to('register', 'Register') }}</li>
                    <li class='{{{ (isset($active) && $active == 'login') ? 'active' : '' }}}'>{{ Link_to('login', 'Login') }}</li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>

@if(Session::has('message'))
<p class="alert alert-dismissable {{ Session::get('alert_class') }}">{{ Session::get('message') }}</p>
@endif

@yield('breadcrumbs')

<div class='container'>
    @yield('content')
</div>

{{ HTML::script('http://code.jquery.com/jquery-latest.min.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.min.js') }}

<script>
    $( "#search" ).autocomplete({
        source: '{{ route('ajax.gettags') }}',
        minLength: 2,
        select: function( event, ui ){
        window.location.replace("/" + ui.item.type + "/" + ui.item.slug);
        //console.log("/" + ui.item.type + "/" + ui.item.value);
    }
    });
</script>
@yield('footer')
</body>
</html>
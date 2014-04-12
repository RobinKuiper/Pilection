<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('css/main.css') }}

		@yield('header')
	</head>

	<body>

		<header>
			<nav class="navbar navbar-inverse" role="navigation">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      {{ link_to('/', 'Pilection', ['class' => 'navbar-brand']) }}
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class='{{{ (isset($active) && $active == 'systems') ? 'active' : '' }}}'>{{ Link_to('systems', 'Systems') }}</li>
                                    <li class='{{{ (isset($active) && $active == 'scripts') ? 'active' : '' }}}'>{{ Link_to('scripts', 'Scripts') }}</li>
                                    <li class='{{{ (isset($active) && $active == 'projects') ? 'active' : '' }}}'>{{ Link_to('projects', 'Projects') }}</li>
                                </ul>
                                {{ Form::open(['route' => 'search.store', 'class' => 'navbar-form navbar-left', 'role' => 'search']) }}
                                    <div class="form-group">
                                        {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Search']) }}
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
                                <ul class="nav navbar-nav navbar-right">
                                    <li class='{{{ (isset($active) && $active == 'home') ? 'active' : '' }}}'>{{ Link_to('/', 'Home') }}</li>
                                    <li class='{{{ (isset($active) && $active == 'about') ? 'active' : '' }}}'>{{ Link_to('about', 'About') }}</li>                               
                                    @if (Auth::check())
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }} <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>{{ link_to('profile', 'Profile') }}</li>
                                            <li>{{ link_to('#', 'Settings') }}</li>
                                            <li class="divider"></li>
                                            <li>{{ Link_to('logout', 'Logout') }}</li>
                                        </ul>
                                    </li>
                                    @else
                                    <li class='{{{ (isset($active) && $active == 'register') ? 'active' : '' }}}'>{{ Link_to('register', 'Register') }}</li>
                                    <li class='{{{ (isset($active) && $active == 'login') ? 'active' : '' }}}'>{{ Link_to('login', 'Login') }}</li>
                                    @endif
                                </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
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
                @yield('footer')
	</body>
</html>
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
			      {{ link_to('/', 'RPiOS', ['class' => 'navbar-brand']) }}
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li class="active">{{ Link_to('/', 'Systems') }}</li>
			        <li>{{ Link_to('#', 'About') }}</li>
			      </ul>
			      <form class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Search</button>
			      </form>
			      <ul class="nav navbar-nav navbar-right">
			      	@if (Auth::check())
			      		<li>{{ Link_to('create', 'Add System') }}</li>
			      		<li>{{ Link_to('logout', 'Logout') }}</li>
			      	@else
				        <li>{{ Link_to('register', 'Register') }}</li>
				        <li>{{ Link_to('login', 'Login') }}</li>
				    @endif
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</header>

			@if(Session::has('message'))
				<p class="alert alert-dismissable {{ Session::get('alert_class') }}">{{ Session::get('message') }}</p>
			@endif
                        <div class='container'>
                            @yield('content')
                        </div>
                        
                        @yield('footer')
	</body>
</html>
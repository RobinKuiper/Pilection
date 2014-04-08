<!doctype html>
<html>
	<head>
		<meta charset="utf-8">

		@yield('header')
	</head>

	<body>
		<header>
			<h1>RPIOS</h1>
			@if (Auth::check())
				<p>
					{{ link_to('create', 'Add system') }}
					{{ link_to('logout', 'Logout') }}
				</p>
			@else
				<p>{{ link_to('login', 'Login') }}</p>
			@endif
		</header>
		<hr>

		<div class="container">
			@yield('content')
		</div>

		<hr>
		<footer>
			<p>Copyright RPIOS.
		</footer>

		@yield('footer')
	</body>
</html>
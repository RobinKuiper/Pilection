@extends('layouts.master')

@section('content')
	<h2>All Systems</h2>

	@foreach($systems as $system)
		<li>{{ link_to("systems/$system->id", $system->title) }}</li>
	@endforeach
@stop
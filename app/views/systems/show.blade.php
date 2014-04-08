@extends('layouts.master')

@section('content')
	<h2>{{ $system->title }}</h2>

	<article>{{ $system->body }}</article>

	<p>{{ link_to('/', 'Go back') }}</p>
@stop
@extends('layouts.master')

@section('content')
	<h2>Add system</h2>

	{{ Form::open(['route' => 'systems.store']) }}
		<div>
			{{ Form::label('title', 'Name:') }}
				{{ Form::text('title') }}
		</div>

		<div>
			{{ Form::label('body', 'Body:') }}
				{{ Form::textarea('body') }}
		</div>

		<div>
			{{ Form::submit('Add system') }}
		</div>

	{{ Form::close() }}
@stop
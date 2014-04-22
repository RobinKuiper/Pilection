{{ Form::open(['route' => 'test.post', 'files' => true, 'role' => 'form']) }}

{{ Form::file('file') }}

{{ Form::text('test', null) }}

{{ Form::submit() }}

{{ Form::close() }}
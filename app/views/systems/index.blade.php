@extends('layouts.master')

@section('content')
	<h2>All Systems</h2>

	<table class="table table-striped table-hover">
		<tbody>
			@foreach($systems as $system)
				<tr>
                                    <td width='120px'>
                                        {{HTML::image("upload/systems/images/$system->image", $system->title, ['width' => '100px', 'max-height' => '100px']);}}
                                    </td>
                                    <td>
                                        <h3> {{ link_to("systems/$system->id", $system->title) }} </h3>
                                        <p> {{ Str::words($system->body, 50, $end = '...') }} </p>
                                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
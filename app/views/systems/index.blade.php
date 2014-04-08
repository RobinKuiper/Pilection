@extends('layouts.master')

@section('content')
	<h2>All Systems</h2>

	<table class="table table-striped table-hover">
		<tbody>
			@foreach($systems as $system)
				<tr>
					<td>
						{{ link_to("systems/$system->id", $system->title) }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('projects') }}
@stop

@section('content')
	<h2>All Projects</h2>

	<table class="table table-striped table-hover">
		<tbody>
			@foreach($projects as $project)
				<tr>
                                    <td>
                                        <h3> {{ link_to("projects/$project->id", $project->title) }} </h3>
                                        <p> {{ Str::words($project->body, 50, $end = '...') }} </p>
                                    </td>
                                    <td>{{ link_to("projects/$project->id#disqus_thread", '0 comments') }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop

@section('footer')
    <script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'rpios'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>
@stop
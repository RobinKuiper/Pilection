@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('scripts') }}
@stop

@section('content')
	<h2>All Scripts</h2>

	<table class="table table-striped table-hover">
		<tbody>
			@foreach($items as $item)
				<tr>
                                    <td>
                                        <h3> {{ link_to("scripts/$item->id", $item->title) }} </h3>
                                        <p> {{ Str::words($item->body, 50, $end = '...') }} </p>
                                    </td>
                                    <td>{{ link_to("scripts/$item->id#disqus_thread", '0 comments') }}</td>
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
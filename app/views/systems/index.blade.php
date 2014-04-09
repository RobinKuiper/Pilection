@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('systems') }}
@stop

@section('content')
	<h2>All Systems</h2>

	<table class="table table-striped table-hover">
		<tbody>
			@foreach($systems as $system)
                                @if ($system->image == null) 
                                    {? $path = 'images/' ?}
                                    {? $system->image = 'system_default.png' ?}
                                @else {? $path = 'upload/systems/images/' ?}
                                @endif
				<tr>
                                    <td>
                                        <a href='systems/{{ $system->id }}' title='{{ $system->title }}'>{{ HTML::image($path . $system->image, $system->title, ['width' => '100px', 'max-height' => '100px']) }}</a>
                                    </td>
                                    <td>
                                        <h3> {{ link_to("systems/$system->id", $system->title) }} </h3>
                                        <p> {{ Str::words($system->body, 50, $end = '...') }} </p>
                                    </td>
                                    <td>{{ link_to("systems/$system->id#disqus_thread", '0 comments') }}</td>
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
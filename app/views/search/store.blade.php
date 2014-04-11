@extends('layouts.master')

@section('content')
	<h2>Search results</h2>

	<table class="table table-striped table-hover">
		<tbody>
			@foreach($items as $item)
                                @if ($item->image == null) 
                                    {? $path = 'images/' ?}
                                    {? $item->image = 'system_default.png' ?}
                                @else {? $path = 'upload/items/images/' ?}
                                @endif
				<tr>
                                    <td>
                                        <a href='{{ $item->type }}/{{ $item->id }}' title='{{ $item->title }}'>{{ HTML::image($path . $item->image, $item->title, ['width' => '100px', 'max-height' => '100px']) }}</a>
                                    </td>
                                    <td>
                                        <h3> {{ link_to("$item->type/$item->id", $item->title) }} </h3>
                                        <p> {{ Str::words($item->body, 50, $end = '...') }} </p>
                                    </td>
                                    <td><span class="glyphicon glyphicon-eye-open"></span> {{ Views::getViews($item->id, 'system') }}</td>
                                    <td>{{ link_to("systems/$item->id#disqus_thread", '0 comments') }}</td>
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
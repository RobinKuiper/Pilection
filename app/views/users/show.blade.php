@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('user', $user) }}
@stop

@section('content')
<div class="row margin-bottom-20">
    <div class="col-md-6"><h2>{{ $user->username }}</h2></div>

    <div class="col-md-6"><h2>Items</h2></div>
</div>

<div class="row">
    <div id="profile-info" class="col-md-6">

        @if($settings->show_name == 1)
        <p>Naam: {{{ Str::title($user->firstname.' '.$user->lastname) }}}</p>
        @endif

        @if($settings->show_email == '1')
        <p>Email: {{{ $user->email }}}</p>
        @endif

        <p>Member since: {{ date($settings->own->date_format, strtotime($user->created_at)) }} </p>

        @if($settings->show_lastlogin == '1')
        <p>Last login: {{ ($user->lastlogin == '0000-00-00 00:00:00') ? 'never' : date($settings->own->date_format, strtotime($user->lastlogin)) }}</p>
        @endif

        <p>Profile views: {{ $user->views }}</p>

    </div>

    <div id="items" class="col-md-6">
        @if(count($items) > 0)
            @foreach($items as $item)
                @if ($item->image == null)
                    {? $path = 'images/' ?}
                    {? $item->image = 'system_default.png' ?}
                @else {? $path = 'upload/items/images/' ?}
                @endif
                <a href='{{ $item->type }}/{{ $item->id }}' title='{{ $item->title }}'>
                    <div class="image-border">
                        {{ HTML::image($path . $item->image, $item->title, ['width' => '100px', 'max-height' => '100px']) }}
                    </div>
                </a>
            @endforeach
        @else
            <p>This user hasn't posted anything yet.</p>
        @endif
    </div>
</div>
@stop

@section('footer')
<script>
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
@stop
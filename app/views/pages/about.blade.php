@extends('layouts/master')

@section('head')
{{ HTML::style('http://fonts.googleapis.com/css?family=Joti+One') }}
{{ HTML::style('css/pages/about/main.css') }}
@stop

@section('content')
<h2>About</h2>

<div class="line"></div>

<div>
    <h3>
        <span>"</span>
        Collecting all Pi!
        <span>"</span>
    </h3>
</div>

<div class="line"></div>

<div class="row margin-top-40">
    <div class="col-md-12">
        <p>I build this website after I saw some people on {{ link_to('http://www.reddit.com', 'Reddit') }} asking for a collection of Raspberry Pi OS's.
        <br>The main purpose is to collect as many Pi resources as possible.</p>

        <p>When you are {{ link_to(Route('users.create'), 'registered') }} and {{ link_to(Route('sessions.create'), 'logged in') }} you can add items to the database. Everything Pi related is accepted!
        <br>You may also {{ link_to('#', 'submit') }} an item without {{ link_to(Route('users.create'), 'registering') }}, we will put it in the database then</p>

        <p>Please report issues here: {{ link_to('https://bitbucket.org/recodenl/pilection/issues', 'Bug tracker') }}
        <br>Missing a feature? Request it {{ link_to(Route('pages.request'), 'here') }}!</p>
    </div>
</div>
@stop
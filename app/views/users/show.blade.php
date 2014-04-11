@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user', $user) }}
@stop

@section('content')
    <h2>{{ $user->username }}</h2>
@stop
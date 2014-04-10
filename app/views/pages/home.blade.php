@extends('layouts/master')

@section('content')
<div class="jumbotron">
  <h1>Welcome, Geeks! ;)</h1>
  <p>On this website you will find a collection of Raspberry Pi resources.</p>
  <p><a href="about" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
</div>

<div class="row">
    
    <div class="col-md-4">
        <h3>Latest Systems</h3>
        <ul class="list-group">
            @foreach ($items['systems']['latest'] as $item)
                <li class="list-group-item">
                    {{ link_to("systems/$item->id", $item->title) }}
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="col-md-4">
        <h3>Latest Scripts</h3>
        <ul class="list-group">
            @foreach ($items['scripts']['latest'] as $item)
                <li class="list-group-item">
                    {{ link_to("scripts/$item->id", $item->title) }}
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="col-md-4">
        <h3>Latest Projects</h3>
        <ul class="list-group">
            @foreach ($items['projects']['latest'] as $item)
                <li class="list-group-item">
                    {{ link_to("projects/$item->id", $item->title) }}
                </li>
            @endforeach
        </ul>
    </div>
    
</div>

<div class="row">
    
    <div class="col-md-4">
        <h3>Top Systems</h3>
        <ul class="list-group">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
    </div>
    
    <div class="col-md-4">
        <h3>Top Scripts</h3>
        <ul class="list-group">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
    </div>
    
    <div class="col-md-4">
        <h3>Top Projects</h3>
        <ul class="list-group">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
    </div>
    
</div>
@stop
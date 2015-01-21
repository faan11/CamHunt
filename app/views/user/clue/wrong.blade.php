@extends('layout.base')


@section("head")
{{ HTML::style('/app/css/clueok.css') }}    

<title> {{Lang::get("game.title")}} - {{Lang::get("clue.wrong")}}</title>
@stop

@section("body")
<div class="container">

<div class="alert alert-success" role="alert">
    {{Lang::get("clue.wrong")}}
</div>

<div class="well" role="alert">
    {{Lang::get("clue.actual")}}
</div>
    
<div class="panel panel-danger">
  <!-- Default panel contents -->
  <div class="panel-heading">{{$progress->count+1}}° {{$clue->title}}</div>
  <div class="panel-body">
      {{$clue->description}}
  </div>
</div>
</div>
@stop
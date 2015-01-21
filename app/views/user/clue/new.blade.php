@extends('layout.base')


@section("head")
{{ HTML::style('/app/css/clueok.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("clue.found")}}</title>
@stop

@section("body")
<div class="container">

<div class="alert alert-success" role="alert">
    {{Lang::get("clue.found")}}
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">{{$progress->count+1}}° {{$clue->title}}</div>
  <div class="panel-body">
      {{$clue->description}}
  </div>
</div>
</div>
@stop
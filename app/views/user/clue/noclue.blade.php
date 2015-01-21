@extends('layout.base')


@section("head")
{{ HTML::style('/app/css/clue.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("clue.empty")}}</title>
@stop

@section("body")
<div class="container">


<div class="panel panel-danger">
  <!-- Default panel contents -->
  <div class="panel-heading">{{Lang::get("clue.empty")}}</div>
  <div class="panel-body">
      {{Lang::get("clue.empty.advice")}}
  </div>
</div>
</div>
@stop
@extends('layout.user')


@section("head")
{{ HTML::style('/app/css/clue.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("login.welcome")}}</title>
@stop

@section("container")
<div class="alert alert-success" role="alert">
    {{Lang::get("login.welcome")}}
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">1° {{$clue->title}}</div>
  <div class="panel-body">
      {{$clue->description}}
  </div>
</div>
@stop

@extends('layout.user')


@section("head")
{{ HTML::style('/app/css/clue.css') }}
<title> {{Lang::get("game.title")}} - {{Lang::get("clue.actual")}}</title>
@stop

@section("container")
<div class="well" >
    <h4>{{Lang::get("clue.actual")}}</h4>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">{{$progress->count+1}}° {{$clue->title}}</div>
  <div class="panel-body">
      {{$clue->description}}
  </div>
</div>
@stop

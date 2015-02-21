@extends('layout.user')


@section("head")
{{ HTML::style('/app/css/clueok.css') }}    

<title> {{Lang::get("game.title")}} - {{Lang::get("clue.wrong")}}</title>
@stop

@section("container")

<div class="alert alert-danger alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Lang::get("clue.wrong")}}
</div>

<!--
<div class="well" role="alert">
    {{Lang::get("clue.actual")}}
</div>
-->
    
<div class="panel panel-warning">
  <!-- Default panel contents -->
  <div class="panel-heading">{{$progress->count+1}}° {{$clue->title}}</div>
  <div class="panel-body">
      {{$clue->description}}
  </div>
</div>
@stop

@extends('layout.user')


@section("head")
{{ HTML::style('/app/css/logbanned.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("user.banned")}}</title>
@stop

@section("container")
<div class="alert alert-danger" role="alert">
   {{Lang::get("user.banned")}}
</div>
@stop

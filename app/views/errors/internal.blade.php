@extends('layout.base')


@section("head")
{{ HTML::style('/app/css/errors.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("errors.internal")}}</title>
@stop

@section("body")

<div class="container">

    <div class="alert alert-danger" role="alert">
   {{Lang::get("errors.internal")}}
    </div>

</div>



@stop
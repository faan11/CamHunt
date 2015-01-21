@extends('layout.base')


@section("head")
{{ HTML::style('/app/css/errors.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("errors.notfound")}}</title>
@stop

@section("body")

<div class="container">

    <div class="alert alert-danger" role="alert">
   {{Lang::get("errors.notfound")}}
    </div>
    
</div>



@stop
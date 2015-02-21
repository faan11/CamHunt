@extends('layout.user')


@section("head")
{{ HTML::style('/app/css/errors.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("errors.internal")}}</title>
@stop

@section("container")

    <div class="alert alert-danger" role="alert">
   {{Lang::get("errors.register.denied")}}
    </div>




@stop

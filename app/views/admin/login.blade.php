@extends('layout.base')


@section("head")
{{ HTML::style('/app/css/login.css') }}
<title> {{Lang::get("game.title")}} - {{Lang::get("user.names")}}</title>
@stop

@section("body")

<div class="container">

    <form class="form-signin" action="/admin/login" method="POST">
        <h2 class="form-signin-heading">{{Lang::get('login.signin')}}</h2>
        <label for="inputEmail" class="sr-only">{{Lang::get('login.email')}}</label>
        <input type="email" id="inputEmail" name="username" class="form-control" placeholder="{{Lang::get('login.email')}}" required="" autofocus="">
        <label for="inputPassword" class="sr-only">{{Lang::get('login.password')}}</label>     
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="{{Lang::get('login.password')}}" required="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <br>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{Lang::get('login.signin')}}</button>
    </form>
    
    @if ($error==1)
    <br>
    <div class="alert alert-danger" role="alert">
        {{Lang::get("login.wrong")}}
    </div>
    @endif
    
</div>
@stop
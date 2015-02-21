@extends('layout.user')


@section("head")
{{ HTML::style('/app/css/login.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("user.names")}}</title>
@stop

@section("container")


    <form class="form-signin" action="/user/login" method="POST">
        <h2 class="form-signin-heading">{{Lang::get('login.signin')}}</h2>
        <label for="inputEmail" class="sr-only">{{Lang::get('login.email')}}</label>
        <input name="username" type="email" id="inputEmail" class="form-control" placeholder="{{Lang::get('login.email')}}" required="" autofocus="">
        <label for="inputPassword" class="sr-only">{{Lang::get('login.password')}}</label>     
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="{{Lang::get('login.password')}}" required="">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{Lang::get('login.signin')}}</button>
        
        <input type="hidden" name="_token" value="{{csrf_token()}}" >
    </form>

@if ($error==1)
<br>
<div class="alert alert-danger" role="alert">
    {{Lang::get("login.wrong")}}
</div>
@endif 
@if ($error==2)
<br>
<div class="alert alert-danger" role="alert">
    {{Lang::get("login.exists")}}
</div>
@endif 
@stop

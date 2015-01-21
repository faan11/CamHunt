@extends('layout.base')


@section("head")
{{ HTML::style('/app/css/login.css') }}

<title> {{Lang::get("game.title")}} - {{Lang::get("user.names")}}</title>
@stop

@section("body")

<div class="container">

    <form class="form-signin" action="register/op" method="POST">
        <h2 class="form-signin-heading">{{Lang::get('login.signup')}}</h2>
        <label for="inputEmail" class="sr-only">{{Lang::get('login.email')}}</label>
        <input name="username" type="email" id="inputEmail" class="form-control" placeholder="{{Lang::get('login.email')}}" required="" autofocus="">
        <label for="inputPassword" class="sr-only">{{Lang::get('login.name')}}</label>  
        <input name="name"  id="name" class="form-control" placeholder="{{Lang::get('login.name')}}" required="" autofocus="">
        <label for="inputPassword" class="sr-only">{{Lang::get('login.surname')}}</label>  
        <input name="surname"  id="surname" class="form-control" placeholder="{{Lang::get('login.surname')}}" required="" autofocus="">
        <label for="inputPassword" class="sr-only">{{Lang::get('login.password')}}</label>     
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="{{Lang::get('login.password')}}" required="">
        <br>
        <button class="btn btn-lg btn-primary btn-block" value="1" name="register" type="submit">{{Lang::get('login.register')}}</button>
        
        <input type="hidden" name="_token" value="{{csrf_token()}}" >
    </form>

</div>
@if ($error==1)
<br>
<div class="alert alert-danger" role="alert">
    {{Lang::get("login.register.wrong")}}
</div>
@endif 

@stop
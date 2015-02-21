@extends("layout.abase")


@section("head")
{{HTML::style('app/css/admin/users.css')}}
<title> {{Lang::get("game.title")}} - {{Lang::get("user.names")}}</title>
@stop

@section("content")

<table class="table table-striped table-responsive table-hover" style="text-align:center">
<th>
    <td>id</td>
    <td>Email</td>
    <td>Nome</td>
    <td>Cognome</td>
</th>


@foreach($users as $user)
<tr>
    <td></td>
    <td>{{$user->id}}</td>
    <td>{{$user->username}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->surname}}</td>
</tr>
@endforeach
</table>
@stop


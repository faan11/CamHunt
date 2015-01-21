@extends("layout.abase")


@section("head")
{{HTML::style('app/css/admin/users.css')}}
<title> {{Lang::get("game.title")}} - {{Lang::get("user.names")}}</title>
@stop

@section("content")
<nav>
    <ul class="pager">
        <li><a href="progress/reset">{{Lang::get("game.progress.all")}}</a></li>
        <li><a href="game/reset">{{Lang::get("game.reset.all")}}</a></li>
    </ul>
</nav>
<table class="table table-striped table-responsive table-hover" style="text-align:center">
<th>
    <td>{{Lang::get("user.names")}}</td>
    <td style="min-width:350px">{{Lang::get("game.percentage")}}</td>
    <td>{{Lang::get("game.found")}}</td>
    <td>{{Lang::get("game.position")}}</td>
    <td>{{Lang::get("game.button")}}</td>
</th>

@if ($count==0)
<h3>{{Lang::get("clue.empty")}}</h3>
@else
@foreach($users as $user)
<tr>
    <td>{{$user->uid}}</td>
    <td>{{$user->email}}</td>
    <td>

        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="{{($user->count*100)/$count}}" aria-valuemin="0" aria-valuemax="100" style="text-align:center;color:black;width:{{($user->count*100)/$count}}%">
                {{ round(($user->count*100)/$count,2) }}%
            </div>
        </div>
    </td>
    <td>{{$user->count}} {{Lang::get("game.separator")}} {{$count}} </td>
    
    <td>{{$user->position}}</td>
    <td style="font-size:0.5em">
        <a href="user/progress/reset/{{$user->uid}}">
            <button type="button" class="btn btn-default btn-sm btn-danger">
                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> {{Lang::get("game.progress.reset")}} 
            </button>
        </a> 
        <a href="user/delete/{{$user->uid}}">
            <button type="button" class="btn btn-default btn-sm btn-danger">
                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> {{Lang::get("user.delete")}} 
            </button>
        </a>
        @if ($user->ban==0)
        <a href="user/ban/{{$user->uid}}">
            <button type="button" class="btn btn-default btn-sm btn-danger">
                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> {{Lang::get("user.ban")}} 
            </button>
        </a>
        @endif
        
        @if ($user->ban==1)
        <a href="user/unban/{{$user->uid}}">
            <button type="button" class="btn btn-default btn-sm btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{Lang::get("user.unban")}} 
            </button>
        </a>
        @endif
    </td>
</tr>
@endforeach
</table>
@endif

@stop


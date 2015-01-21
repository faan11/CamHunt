@extends("layout.abase")

@section("head")
{{HTML::script("/app/js/admin/prizes.js")}}

<title>{{Lang::get("game.title")}} {{Lang::get("prize.names")}} </title>
@stop


@section("content")
<nav>
    <ul class="pager">
        <li><a href="#" id="piz" >{{Lang::get("prize.add")}}</a></li>
        <li><a href="/admin/prizes/delete/last">{{Lang::get("prize.delete.last")}}</a></li>
        <li><a href="/admin/prizes/del/all">{{Lang::get("prize.delete.all")}}</a></li>
    </ul>
</nav>

<div style="margin:10px">
@if (isset($pradd))
@if ($pradd==0)
<div class="alert alert-success alert-dismissible" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>    
    {{Lang::get("prize.add.ok")}}</div>
@else
<div class="alert alert-danger alert-dismissible" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     {{Lang::get("prize.add.fail")}}</div>
@endif
@endif

@if (isset($prmod))
@if ($prmod==0)
<div class="alert alert-success alert-dismissible " role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{Lang::get("prize.mod.ok")}}</div>
@else
<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Lang::get("prize.mod.fail")}}</div>
@endif
@endif

@if (isset($prdel))
@if ($prdel==0)
<div class="alert alert-success alert-dismissible" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{Lang::get("prize.del.ok")}}</div>
@else
<div class="alert alert-danger alert-dismissible" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{Lang::get("prize.del.fail")}}</div>
@endif
@endif
</div>

<table class="table table-bordered table-striped table-hover" style="text-align:center" >
<th>
    <td style="width:10%"><b>{{Lang::get("prize.position")}}</b></td>
    <td><b>{{Lang::get("prize.name")}}</b></td>
    <td style="width:300px" ><b>{{Lang::get("prize.winner")}}</b></td>
    <td style="width:150px"><center><b>{{Lang::get("prize.actions")}}</b></center></td>
</th>  
@foreach ($prizes as $prize)
<tr>
    <td> </td>
    <td> {{$prize->position}}</td>
    <td> {{$prize->description}} </td>
    
    <td> {{$prize->winner or "-"}} </td>
    <td>
        <a  href="#" class="przmod" data-text="{{$prize->description}}" data-id="{{$prize->id}}" ><span class="glyphicon glyphicon-pencil btn btn-default btn-lg last" aria-hidden="true"/></a>
    </td>
</tr>
@endforeach
</table>
@stop

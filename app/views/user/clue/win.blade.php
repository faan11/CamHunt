@extends('layout.base')


@section("head")
{{ HTML::style('/app/css/clue.css') }}


<title> {{Lang::get("game.title")}} - {{Lang::get("clue.win")}}</title>
@stop

@section("body")
<div class="container">


    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">{{Lang::get("clue.win")}}</div>
        <div class="panel-body">
            {{Lang::get("clue.win.position") }} {{$progress->end}}°. {{Lang::get("clue.win.prize") }} {{$prize["name"]}}
        </div>
    </div>
    <h3> {{Lang::get("prize.rank")}}</h3>
        @if (isset($rank)&&count($rank)!=0)
        <table class="table table-bordered table-striped table-hover" style="text-align:center" >
            <th>
            <td style="width:300px" ><b>{{Lang::get("prize.winner")}}</b></td>
            <td><b>{{Lang::get("prize.name")}}</b></td>
            </th>  
            @foreach ($rank as $srank)
            <tr>
                <td> {{$srank->position}}</td>

                <td> {{$srank->winner}} </td>

                <td> {{$srank->description or "-"}} </td>

            </tr>

            @endforeach
        </table>
        @endif
</div>
</div>
@stop
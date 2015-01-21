@extends("layout.abase")

@section("head")
{{HTML::style('/app/css/admin/clues.css')}}
<title>{{Lang::get("game.title")}} {{Lang::get("user.names")}} </title>
@stop


@section("content")
<nav>
    <ul class="pager">
        <li><a href="clues/add">{{Lang::get("clue.add")}}</a></li>
        
        <li><a href="clues/delall">{{Lang::get("clue.delete.all")}}</a></li>
        <li><a href="clues/zip/svg/download">{{Lang::get("clue.download.svg")}}</a></li>
        <li><a href="clues/zip/png/download">{{Lang::get("clue.download.png")}}</a></li>
    </ul>
</nav>
<table class="table " style="text-align:center" >

    
@foreach ($clues as $clue)
    <th >
    <td><b>{{Lang::get("clue.qrcode")}}</b></td>
    <td><b>{{Lang::get("clue.title")}}</b></td>
    <td><b>{{Lang::get("clue.description")}}</b></td>
    <td><b>{{Lang::get("clue.gps")}}</b></td>
    <td><b>{{Lang::get("clue.link")}}</b></td>
    <td><center><b>{{Lang::get("clue.actions")}}</b></center></td>
</th>
<tr>
    <td> <h3>{{$clue->id}}</td>
    <td> <img style="float:left" src="data:image/png;base64, {{$clue->qrcode}}" class="img-responsive img-thumbnail" alt="Responsive image"></td>
    <td>{{$clue->title}}</td>
    <td>{{$clue->description}}</td>
    <td>{{$clue->gpsx}},{{$clue->gpsy}}</td>
    <td>{{$basepath}}{{$clue->hash}}</td>
    <td>
        <a href="clues/modify/{{$clue->id}}" ><span class="glyphicon glyphicon-pencil btn btn-default btn-lg last" aria-hidden="true"/></a>
        <a href="clues/download/{{$clue->id}}"><span class="glyphicon glyphicon-arrow-down btn btn-default btn-lg last" aria-hidden="true"/></a>
    
        <a href="clues/delete/{{$clue->id}}"><span class="glyphicon glyphicon-minus btn btn-default btn-lg last" aria-hidden="true"/></a>
    </td>
        

</tr>
@endforeach
</table>
@stop

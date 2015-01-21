@extends("layout.abase")

@section("head")
{{HTML::style('/app/css/admin/modclues.css')}}


<title>{{Lang::get("game.title")}} {{Lang::get("clue.modify")}} </title>
@stop


@section("content")
<form action="../modify" method="POST">
    <input type="hidden" name="id" value="{{$clue->id}}" >
    <h3>{{Lang::get("clue.title")}}</h3>
    <input type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1"  name="title" value="{{$clue->title}}">

    <h3>{{Lang::get("clue.name")}}</h3>
    <textarea class="form-control" rows="6" placeholder="Clue description" name="description" aria-describedby="basic-addon1">{{$clue->description}}</textarea>

    <h3>{{Lang::get("clue.gps")}}</h3>
    X:<input class="form-control"  placeholder="X" name="gx" aria-describedby="basic-addon1" value="{{$clue->gpsx}}">
    <br>
    Y:<input class="form-control"  placeholder="Y" name="gy" aria-describedby="basic-addon1" value="{{$clue->gpsy}}">
    
    <button class="btn btn-default btn-sm" type="submit"  aria-expanded="false">
        <span class="
              glyphicon glyphicon-pencil"></span>
        {{Lang::get("clue.submit")}}
    </button>
    
    <a href="/admin/clues">
        <button class="btn btn-default btn-sm" type="button"  aria-expanded="false">
            <span class="
               glyphicon glyphicon-arrow-left"></span>
            {{Lang::get("clue.back")}}
        </button>
    </a>
</form>

@if (isset($messages))
@foreach ($messages as $message)
<br>
<div class="alert alert-danger" role="alert">
    {{$message}}
</div> 
@endforeach
@endif
@stop

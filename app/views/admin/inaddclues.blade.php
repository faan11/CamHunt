@extends("layout.abase")

@section("head")
{{HTML::style('/app/css/admin/addclues.css')}}

<title>{{Lang::get("game.title")}} {{Lang::get("clue.add")}} </title>
@stop


@section("content")
<form class="form-signin"  action="new" method="POST">
    <h3>{{Lang::get("clue.title")}}</h3>
    <input type="text"  name="title" class="form-control" placeholder="title" aria-describedby="basic-addon1"></input>

    <h3>{{Lang::get("clue.name")}}</h3>
    <textarea class="form-control"  name="description" rows="6" placeholder="Clue description" aria-describedby="basic-addon1"></textarea>
    <h3>{{Lang::get("clue.gps")}}</h3>
    
    X:<input class="form-control"  placeholder="X" name="gx" aria-describedby="basic-addon1" ></input>
    <br>
    Y:<input class="form-control"  placeholder="Y" name="gy" aria-describedby="basic-addon1" ></input>

    <button class="btn btn-default btn-sm" type="submit"  aria-expanded="false">
        <span class="
              glyphicon glyphicon-plus"></span>
        {{Lang::get("clue.submit")}}
    </button>
    
    <a href="/admin/clues">
        <button class="btn btn-default btn-sm" type="button"  aria-expanded="false">
            <span class="
                  glyphicon glyphicon-pencil"></span>
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

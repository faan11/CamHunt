@extends("layout.base")

@section("body")
<div class="container">
    @yield("container")
    <hr>
 <center>In caso di problemi rivolgersi allo stand di informatica.
    @if (Auth::user()->check())
    
    <br>
    <br>
        <a style="margin-top: -10px" class="btn btn-default" href="/user/logout" role="button">Logout</a>
        
    @endif
    </center>
    
</div>
@stop

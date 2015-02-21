@extends("layout.base")


@section("body")
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/admin/home">{{Lang::get("game.title")}} </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        @if (isset($adm))
        <li class="active">
        @else
        <li>
        @endif
        <a href="/admin/home">{{Lang::get("admin.name")}}</a></li>
        
        @if (isset($cl))
        <li class="active">
        @else
        <li>
        @endif
            <a href="/admin/clues">{{Lang::get("clue.names")}} <span class="sr-only">(current)</span></a>
        </li>
        
        @if (isset($us))
        <li class="active">
        @else
        <li>
        @endif
        <a href="/admin/users">{{Lang::get("user.names")}}</a></li>
        @if (isset($pr))
        <li class="active">
        @else
        <li>
        @endif
        <a href="/admin/prizes">{{Lang::get("prize.names")}}</a></li>
        @if (isset($reg))
	<li class="active" >
	@else
	<li>
	@endif
		<a href="/admin/reguser">Utenti registrati</a>
	</li>   
        
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="/admin/logout">Logout</a></li>

        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    @yield("content")
@stop

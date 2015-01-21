@extends("layout.abase")

@section("head")
{{HTML::script("/core/js/jquery.plugin.min.js")}}
{{HTML::script("/core/js/jquery.countdown.js")}}
{{HTML::script("/core/js/jquery.countdown.js")}}
{{HTML::style("/core/css/bootstrap-switch.css")}}
{{HTML::script("/core/js/bootstrap-switch.js")}}
{{--
{{HTML::script("/core/js/bootstrap-datetimepicker.min.js")}}
{{HTML::style("/core/css/bootstrap-datetimepicker.css")}}
{{HTML::style("/core/css/bootstrap-colorpicker.min.css")}}
{{HTML::script("/core/js/bootstrap-colorpicker.min.js")}}
--}}
{{HTML::script("/app/js/admin/home.js")}}

{{HTML::style("/core/css/jquery.countdown.css")}}

<title>{{Lang::get("game.title")}}  </title>
@stop


@section("content")



<div class="well">
    <input type="checkbox" name="registration" {{ $config->registration_active ? 'checked' : '' }}>
    <font size="4">&nbsp;{{Lang::get("game.registration")}}</font>
</div>

 <div class="well">
    <input type="checkbox" name="match" {{$config->match_active?'checked':'' }}>
    <font size="4">&nbsp;{{Lang::get("game.match")}} </font>
</div>
<hr>
@stop

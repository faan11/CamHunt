<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
     return Response::view('errors.internal', array(), 500);
});

App::missing(function($exception)
{
    return Response::view('errors.missing', array(), 404);
});
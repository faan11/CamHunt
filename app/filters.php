<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/



App::before(function($request)
{
    //xls defend.
    Common::globalXssClean();
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('admin.auth', function()
{
    if (!Auth::admin()->check()){
        return Redirect::to(Game::BASEURL."/admin");
    }
});


Route::filter('user.auth', function()
{
    if (!Auth::user()->check()){
       
        return Redirect::to(Game::BASEURL."/user");
    }
    if (Auth::user()->get()->ban==1){
        return View::make('user.banned');
    }
});


Route::filter('image', function($response)
{
    $response->header('Content-Type', 'image/jpeg');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

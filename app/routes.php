<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
/**
 * Route home redirect to user.
 */
DB::connection()->disableQueryLog();
# see optimize in laravel.
# add name and surname.

Route::group(array('prefix' => Game::BASEURL), function(){
    
    Route::get('/', function() {
        return Redirect::to(Game::BASEURL."/user");
    });

    require __DIR__."/routes_users.php";

    require __DIR__."/routes_admins.php";

});
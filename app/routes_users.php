<?php

Route::get('/user', function() {

    if (!\Configz::canPlay()){
        return View::make("user.login.denied");
    }
    if (Auth::user()->check()) {
    return Redirect::to(Game::BASEURL."/user/clue");
    }
    $login = array("error" => 0);
    return View::make('user.login', $login);
});

Route::get('/user/register', function() {
    // check game.
    if (!\Configz::canRegister()){
        return View::make("user.register.denied");
    }
    if (Auth::user()->check()) {
        return Redirect::to(Game::BASEURL."/user/clue");
    }
    
    $login = array("error" => 0);
    return View::make('user.register', $login);
});


Route::get('/user/register/error', function() {
    // check game.
    if (!\Configz::canRegister()){
        return View::make("user.register.denied");
    }
    
    if (Auth::user()->check()) {
        return Redirect::to(Game::BASEURL."/user/clue");
    }
    
    $login = array("error" => 1);
    return View::make('user.register', $login);
});

/**
 * user error.
 */
Route::get('user/error', function() {
    if (!\Configz::canPlay()){
        return View::make("user.login.denied");
    }
    if (Auth::user()->check()) {
        return Redirect::to(Game::BASEURL."/user/clue");
    }
    $login = array("error" => 1);
    return View::make('user.login', $login);
});
/**
 * The hidden page of login.
 */
Route::get('user/exist', function() {
    if (!\Configz::canPlay()){
        return View::make("user.login.denied");
    }
    if (Auth::user()->check()) {
    return Redirect::to(Game::BASEURL."/user/clue");
    }
    $login = array("error" => 2);
    return View::make('user.login', $login);
});


Route::get('user/exist', function() {
    if (!\Configz::canPlay()){
        return View::make("user.login.denied");
    }
    if (Auth::user()->check()) {
        return Redirect::to(Game::BASEURL."/user/clue");
    }
    $login = array("error" => 2);
    return View::make('user.register', $login);
});

Route::post('/user/login', array("before" => "csrf", function() {
    if (!\Configz::canPlay()){
        return View::make("user.login.denied");
    }
    // IF USER WAS LOGGED RETURN IN CURRENT CLUES.
    if (Auth::user()->check()) {
        return Redirect::to(Game::BASEURL."/user/clue");
    }
    // get data .
    $validator = Validator::make(
        Input::all(), array(
        'username' => 'required|max:40',
        'password' => 'required|max:64'
        )
    );
    if ($validator->fails()){
        return Redirect::to(Game::BASEURL."/user/error");
    }
    
    $post = Input::only('username', 'password');

    // username password <--
    $username = $post["username"];
    $password = $post["password"];

    // LOGIN.
    $logusr = Auth::user()->attempt(array(
    'username' => $username,
    'password' => $password
    ));
    // CHECK EXECUTION LOGIN.
    if ($logusr == true) {
    // OK REDIRECT TO CLUE.
    // AUTO LOGIN.

    return Redirect::to(Game::BASEURL."/user/clue");
    } else {
    // ERROR DURING LOGIN EXECUTION, MAY YOU WRONG THE CREDENTIALS.
    return Redirect::to(Game::BASEURL."/user/error");
    }
}));


Route::post('/user/register/op',function(){
    // ADD NEW USER.
    if (!\Configz::canRegister()){
        return View::make("user.register.denied");
    }
    if (Auth::user()->check()) {
        return Redirect::to(Game::BASEURL."/user/clue");
    }
    // get data .
    $validator = Validator::make(
        Input::all(), array(
        'username' => 'required|max:40|email',
        'name'=>'required|max:100',
        'surname'=>'required|max:100',
        'password' => 'required|max:64'
        )
    );

    if ($validator->fails()){
        return Redirect::to(Game::BASEURL."/user/register/error");
    
    }
    
    $post = Input::only('username', 'password',"name","surname");
    
    $username = $post["username"];
    $password = $post["password"];
    $name = $post["name"];
    $surname = $post["surname"];
    
    if (!is_null(DB::table('users')->where("username", '=', $username)->first())) { // if user exists.
        return Redirect::to(Game::BASEURL."/user/register/error");
    }

    
    $user = new User;
    $user->username = $username;
    $user->password = Hash::make($password);
    $user->name = $name;
    $user->surname = $surname;
    $user->save();
    
    $result = Auth::user()->loginUsingId($user->id);
    return Redirect::to(Game::BASEURL."/user/register");
});


Route::get('/user/clue', array("before" => "user.auth", function() {
    // GET CURRENT ALGORITHM
    if (!\Configz::canPlay()){
        return View::make("user.login.denied");
    }
    if (Clue::count() == 0) {
        return View::make('user.clue.noclue');
    }

    // GET CURRENT LOGGED USER .
    $u = Auth::user()->get();

    // GET CURRENT CLUE.
    return ClueController::getCurrentClue($u);
    }
 ));

Route::get("/user/clue/{hash}", array("before" => "user.auth", function($hash) {
    // CHECK CLUE COUNT
    if (!\Configz::canPlay()){
        return View::make("user.login.denied");
    }
    if (Clue::count() == 0) {
        return View::make('user.clue.noclue');
    }

    // GET CURRENT LOGGED USER .
    $u = Auth::user()->get();
    // go to next clue.
    return ClueController::goToNextClue($u, $hash);
}));     


//Route::get('/user/clue/{id}', function($id=0) {
//    //return View::make('clue.index');
//});

Route::get('/user/logout', array("before" => "user.auth",function() {
    Auth::user()->logout();
    return Redirect::to(Game::BASEURL."/user");
}));

<?php

Route::get('/admin/reguser', array("before" => "admin.auth", function() {
    $user = \User::all();
    return View::make('admin.inreg',array("users"=>$user,"reg"=>1));
}));


Route::post("/admin/game/regop",array("before"=>"admin.auth",function(){
     
    
    $validator = Validator::make(
        Input::all(),
        array(
            'st' => 'required'
        )
    );
    
    if ($validator->fails()){
        return Redirect::to(Game::BASEURL."/admin/home/error");
    }
    $post = Input::only('st');
    $var = ($post["st"]=="true")?1:0;
    DB::table("config")->update(array("registration_active"=>$var));
    return Redirect::to(Game::BASEURL."/admin/home");
    
}));

Route::post("/admin/game/op",array("before"=>"admin.auth",function(){    
    
    $validator = Validator::make(
        Input::all(),
        array(
            'st' => 'required'
        )
    );
    
    if ($validator->fails()){
        return Redirect::to(Game::BASEURL."/admin/home/error");
    }
    $post = Input::only('st');
    $var = ($post["st"]=="true")?1:0;
    DB::table("config")->update(array("match_active"=>$var));
    return Redirect::to(Game::BASEURL."/admin/home");
}));





/**
 * 
 */
Route::get('/admin/home/error', array("before" => "admin.auth", function() {
    $config = Configz::all()[0];
    return View::make('admin.home',array("config"=>$config,"adm"=>1,"err"=>1));
}));

/**
 * 
 * 
 * 
 * 
 * 
 */
Route::get('/admin/home', array("before" => "admin.auth", function() {
    $config = Configz::all()[0];
    return View::make('admin.home',array("config"=>$config,"adm"=>1,"err"=>1));
}));

/**
 * Admin prizes
 * 
 * 
 * 
 */
/**
 * 
 * Pages
 */
Route::get('/admin/prizes', array("before" => "admin.auth", function() {
    $prizes = DB::select("select prizes.id,prizes.position,prizes.description,users.username as winner from (prizes left join clues_progress on (clues_progress.end=prizes.position) )  left join  users on (users.id=clues_progress.uid)   order by prizes.position asc; ");
    return View::make('admin.prizes.all',array("pr"=>1,"prizes"=>$prizes));
}));

Route::get('/admin/prizes/add/success', array("before" => "admin.auth", function() {
    $prizes = DB::select("select prizes.id,prizes.position,prizes.description,users.username as winner from (prizes left join clues_progress on (clues_progress.end=prizes.position) )  left join  users on (users.id=clues_progress.uid)   order by prizes.position asc; ");
    return View::make('admin.prizes.all',array("pr"=>1,"pradd"=>"0","prizes"=>$prizes));
}));


Route::get('/admin/prizes/add/failed', array("before" => "admin.auth", function() {
    $prizes = DB::select("select prizes.id,prizes.position,prizes.description,users.username as winner from (prizes left join clues_progress on (clues_progress.end=prizes.position) )  left join  users on (users.id=clues_progress.uid)   order by prizes.position asc;");
    return View::make('admin.prizes.all',array("pr"=>1,"pradd"=>"1","prizes"=>$prizes));
}));

Route::get('/admin/prizes/modify/success', array("before" => "admin.auth", function() {
    $prizes = DB::select("select prizes.id,prizes.position,prizes.description,users.username as winner from (prizes left join clues_progress on (clues_progress.end=prizes.position) )  left join  users on (users.id=clues_progress.uid)   order by prizes.position asc; ");
    return View::make('admin.prizes.all',array("pr"=>1,"prmod"=>"0","prizes"=>$prizes));
}));

Route::get('/admin/prizes/modify/failed', array("before" => "admin.auth", function() {
    $prizes = DB::select("select prizes.id,prizes.position,prizes.description,users.username as winner from (prizes left join clues_progress on (clues_progress.end=prizes.position) )  left join  users on (users.id=clues_progress.uid)   order by prizes.position asc; ");
    return View::make('admin.prizes.all',array("pr"=>1,"prmod"=>"1","prizes"=>$prizes));
}));

Route::get('/admin/prizes/delete/success', array("before" => "admin.auth", function() {
    $prizes = DB::select("select prizes.id,prizes.position,prizes.description,users.username as winner from (prizes left join clues_progress on (clues_progress.end=prizes.position) )  left join  users on (users.id=clues_progress.uid)   order by prizes.position asc; ");
    return View::make('admin.prizes.all',array("pr"=>1,"prdel"=>"0","prizes"=>$prizes));
}));

Route::get('/admin/prizes/delete/failed', array("before" => "admin.auth", function() {
    $prizes = DB::select("select prizes.id,prizes.position,prizes.description,users.username as winner from (prizes left join clues_progress on (clues_progress.end=prizes.position) )  left join  users on (users.id=clues_progress.uid)   order by prizes.position asc; ");
    return View::make('admin.prizes.all',array("pr"=>1,"prdel"=>"1","prizes"=>$prizes));
}));
/**
 * pages without view.
 * 
 */

/**
 * add new prizes
 */
Route::post('/admin/prizes/new',array("before" => "admin.auth",  function() {
    // CHECK INPUT.
    $post = Input::only('description');
    
    $validator = Validator::make(
        Input::all(),
        array(
            'description' => 'required'
        )
    );
    
    /**
     * Validator fails.
     */
    if ($validator->fails())
    {
        $messages = $validator->messages()->all();
        return Redirect::to(Game::BASEURL."/admin/prizes/add/failed");
    }
    
    DB::beginTransaction();
    $prize = new Prize;
    $prize->position         = Prize::max("position")+1;
    $prize->description      = $post["description"];
    $prize->save();
    DB::commit();
    
    // create qr code.
    return Redirect::to(Game::BASEURL."/admin/prizes/add/success");
}));

/**
 * modify data.
 */

Route::post('/admin/prizes/mod',array("before" => "admin.auth",  function() {
    
     $validator = Validator::make(
        Input::all(),
        array(
            'id'=>'required|integer|exists:prizes',
            'description'=>'required'
        )
    );
    
    /**
     * Validator fails.
     */
    if ($validator->fails())
    {
            return Redirect::to(Game::BASEURL."/admin/prizes/modify/failed");
    }
    
    $post = Input::only('id','description');
    // find the clue.
    //@improve
    $prize                     = Prize::findOrFail($post["id"]);
    $prize->description        = $post["description"];
    $prize->save();
   
    return Redirect::to(Game::BASEURL."/admin/prizes/modify/success");
}));


/**
 * delete prize
 */
Route::get('/admin/prizes/delete/last',array("before" => "admin.auth",  function() {
    if (Prize::count()==0){
        return Redirect::to(Game::BASEURL."/admin/prizes/delete/failed");
    }
    // destroy clue.
    DB::beginTransaction();
    // 
    Prize::where("position","=",Prize::max("position"))->delete();
    //
    DB::commit();
    return Redirect::to(Game::BASEURL."/admin/prizes/delete/success");
}));

Route::get('/admin/prizes/delete/all',array("before" => "admin.auth",  function() {
    if (Prize::count()==0){
        return Redirect::to(Game::BASEURL."/admin/prizes/delete/failed");
    }
    // destroy clue.
    DB::beginTransaction();
    // 
    Prize::truncate();
    ClueProgress::truncate();
    History::truncate();
    
    DB::commit();
    return Redirect::to(Game::BASEURL."/admin/prizes/delete/success");
}));
/**
 * Admin routes
 *
 * /clues -> indizi
 * /clues/modify -> modifica indizi
 *
 */

Route::get('/admin/clues', array("before" => "admin.auth", function() {
    $clues = DB::select(" select clues.*,clues_data.* from clues,clues_data where (clues_data.id=clues.id) ");
    return View::make('admin.inclues',array("cl"=>1,"basepath"=>URL::to('/')."/user/clue/","clues"=>$clues));
}));


/**
 * 
 * 
 * @improve select only specific field with Clue::find.
 */
Route::get('/admin/clues/modify/{id}',array("before" => "admin.auth",  function($id) {
    $mod =array("clue"=>Clue::findOrFail($id));
    return View::make('admin.inmodclues',$mod);
}));

/**
 * 
 * 
 * 
 * 
 */
Route::get('/admin/clues/add', array("before" => "admin.auth", function() {

    return View::make('admin.inaddclues');
}));


/**
 * 
 * Add data with error
 * 
 * 
 * 
 */
Route::get('/admin/clues/add/error', array("before" => "admin.auth", function() {
    return View::make('admin.inaddclues',array("error"=>1));
}));
/**
 * 
 * 
 * @param String $title Clue title
 * @param String $description Clue description
 * @param Float $gx
 * @param Float $gy
 * 
 */
Route::post('/admin/clues/new',array("before" => "admin.auth",  function() {
    // CHECK INPUT.
    $post = Input::only('title', 'description','gx','gy');
    
    $validator = Validator::make(
        Input::all(),
        array(
            'title' => 'required|max:30',
            'description'=>'required',
            'gx'=>'required|numeric',
            'gy'=>'required|numeric',
        )
    );
    
    /**
     * Validator fails.
     */
    if ($validator->fails())
    {
        $messages = $validator->messages()->all();
        return View::make("admin.inaddclues",array("messages"=>$messages));
    }
    
    DB::beginTransaction();
    $clue = new Clue;
    $clue->gpsx         = $post["gx"];
    $clue->gpsy         = $post["gy"];
    $clue->title        = $post["title"];
    $clue->description  = $post["description"];
    //$clue->title        = $post["title"];
    //$clue->description  = $post["description"];
    $clue->hash         = md5($post["gx"].$post["gy"].$post["title"].$post["description"]);
    
    $clue->save();
    DB::commit();
    
    // create qr code.
    \ClueController::createQrCode($clue);
    // update every progress to 0.
    DB::table('clues_progress')->update(array("end"=>"0"));
    return Redirect::to(Game::BASEURL."/admin/clues");
}));
/**
 * Ban user
 */
Route::get('/admin/user/ban/{id}',array("before" => "admin.auth",  function($id) {
    // destroy clue.
    
    $user = User::findOrFail($id);
    $user->ban = 1;
    $user->save();
    return Redirect::to(Game::BASEURL."/admin/users");
}));
/**
 * Unban user
 */
Route::get('/admin/user/unban/{id}',array("before" => "admin.auth",  function($id) {
    // destroy clue.
    $user = User::findOrFail($id);
    $user->ban = 0;
    $user->save();
    return Redirect::to(Game::BASEURL."/admin/users");
}));


Route::post('/admin/clues/modify',array("before" => "admin.auth",  function() {
    
     $validator = Validator::make(
        Input::all(),
        array(
            'id'=>'required|integer|exists:clues',
            'title' => 'required|max:30',
            'description'=>'required',
            'gx'=>'required|numeric',
            'gy'=>'required|numeric',
        )
    );
    
    /**
     * Validator fails.
     */
    if ($validator->fails())
    {
        $messages = $validator->messages()->all();
        // @improve.
        if (Input::has("id")&&$clue=Clue::findOrFail(Input::only("id"))){
            return View::make("admin.inmodclues",array("clue"=>$clue[0],"messages"=>$messages));
        }
        else{// you may have some problem if id isn't the form.
            return Redirect::to(Game::BASEURL."/admin/clues");
        }
    }
    
    $post = Input::only('id','title', 'description','gx','gy');
    // find the clue.
    //@improve
    $clue = Clue::findOrFail($post["id"]);
    $clue->gpsx         = $post["gx"];
    $clue->gpsy         = $post["gy"];
    $clue->title        = $post["title"];
    $clue->description  = $post["description"];
    $clue->save();
    
    \ClueController::editQrCode($clue);
    
    return Redirect::to(Game::BASEURL."/admin/clues");
}));




Route::get('/admin/clues/delete/{id}',array("before" => "admin.auth",  function($id) {
    // destroy clue.
    Clue::destroy($id);
    return Redirect::to(Game::BASEURL."/admin/clues");
}));

Route::get('/admin/clues/delall',array("before" => "admin.auth",  function() {
    // destroy clue.
    
    \Clue::truncate();
    \ClueData::truncate();
    return Redirect::to(Game::BASEURL."/admin/clues");
}));

/**
 * Admin home page error
 */
Route::get('/admin/users', array("before" => "admin.auth", function() {
    
    $users = DB::select("SELECT clues_progress.cid,clues_progress.uid,clues_progress.end as position,users.username as email,clues_progress.count as count,users.ban as ban from users,clues_progress where (users.id=clues_progress.uid) ORDER BY IF(position > 0, 0, 1000000),position ASC,count DESC ");
    
    return View::make('admin.inusers',array("us"=>1,"users"=>$users,"count"=>Clue::count()));
}));






/**
 * Admin authentification login and logout
 */


/**
 *  Home page admin
 */
Route::get('/admin', function() {
    if (Auth::admin()->check()) {
        return Redirect::to(Game::BASEURL."/admin/clues");
    }
    $login = array("error" => 0);

    return View::make('admin.login', $login);
});


/**
 * Admin home page error
 */

Route::get('admin/error', function() {
    if (Auth::admin()->check()) {
        return Redirect::to(Game::BASEURL."/admin/clues");
    }
    $login = array("error" => 1);
    return View::make('admin.login', $login);
});

/**
 * Admin login page.
 */




Route::post('/admin/login', array("before"=>"csrf",function() {
 
    // admin check.
  $validator = Validator::make(
        Input::all(),
        array(
            'username' => 'required|max:40',
            'password'=>'required|max:64'
        )
    );
    
    /**
     * Validator fails.
     */
    if ($validator->fails())
    {
        $messages = $validator->messages()->all();
        return View::make("admin.login",array("messages"=>$messages));
    }
    
    if (Auth::admin()->check()) {
        return Redirect::to(Game::BASEURL."/admin/clues");
    }

    $post = Input::only('username', 'password');
    $username = $post["username"];
    $password = $post["password"];
    // Autentification.
    
    $logadm = Auth::admin()->attempt(array(
        "username" => $username,
        "password" => $password,
    ));
//
    if ($logadm == true) {
        return Redirect::to(Game::BASEURL."/admin/clues");
    } else {
        return Redirect::to(Game::BASEURL."/admin/error");
    }
    
}));


/**
 * Admin logout page.
 */
Route::get('/admin/logout', array("before" => "admin.auth",function() {
    Auth::admin()->logout();
    return Redirect::to(Game::BASEURL."/admin");
}));



/**
 * 
 * 
 * 
 * Admin game reset.
 * 
 * 
 * 
 */

Route::get('/admin/progress/reset', array("before" => "admin.auth",function() {
    DB::table('clues_progress')->update(array("count"=>"0","end"=>"0","resetted"=>true));
    \History::truncate();
    return Redirect::to(Game::BASEURL."/admin/users");
}));

Route::get('/admin/game/reset', array("before" => "admin.auth",function() {
    
    \ClueProgress::truncate();
    \History::truncate();
    \User::truncate();
    return Redirect::to(Game::BASEURL."/admin/users");
}));



Route::get('/admin/user/progress/reset/{id}', array("before" => "admin.auth",function($user) {
//    \ClueProgress::truncate();
//    \History::truncate();
    $validator = Validator::make(
        array("user"=>$user),
        array(
            "user"=>'required'
        )
    );
    
    if ($validator->fails())
    {
        return  App::abort(404);
    }
    
    $u = User::findOrFail($user);
    \ClueProgress::where('uid', '=', $u->id)->update(array("count"=>"0","end"=>"0"));
    \History::where('uid', '=', $u->id)->delete();
    return Redirect::to(Game::BASEURL."/admin/users");
}));


Route::get('/admin/user/delete/{id}', array("before" => "admin.auth",function($user) {
//    \ClueProgress::truncate();
//    \History::truncate();
    $validator = Validator::make(
        array("user"=>$user),
        array(
            "user"=>'required'
        )
    );
    
    if ($validator->fails())
    {
        return  App::abort(404);
    }
    
    $u = User::findOrFail($user);
    // delete all
    $u->delete();
    \ClueProgress::where('uid', '=', $u->id)->delete();
    \History::where('uid', '=', $u->id)->delete();
    return Redirect::to(Game::BASEURL."/admin/users");
}));

/**
 * 
 * 
 * 
 * 
 * Download clues files.
 * 
 * 
 * 
 * 
 * 
 */

Route::get('/admin/clues/download/{id}', array("before" => "admin.auth",function($id) {

    $validator = Validator::make(
        Input::all(),
        array(
            'id'=>'required|integer|min:0'
        )
    );
    
    $c = DB::select("select clues_data.svgqrcode as svgqrcode from clues_data where clues_data.id=?",array($id));
    if (count($c)==0){
        App::abort(404);
        return;
    }else{
        $app = $c[0];
    }
    
    header('Content-Type: application/svg');
    header('Content-Length: ' . strlen($app->svgqrcode));
    header('Content-Disposition: attachment; filename='.$id.'.svg');
    echo $app->svgqrcode;
}));


Route::get('/admin/clues/zip/svg/download', array("before" => "admin.auth",function() {

    $c = DB::select("select clues.title,clues.hash,clues_data.svgqrcode as svgqrcode from clues_data,clues where (clues.id=clues_data.id)");
    if (count($c)==0){
        App::abort(404);
        return;
    }
    // Prepare File
    $file = tempnam("tmp", "zip");
    
    $zip = new ZipArchive();
    $zip->open($file, ZipArchive::OVERWRITE);
    
    foreach($c as $clue){
        $zip->addFromString($clue->title.$clue->hash.  str_random(10).".svg", $clue->svgqrcode);
    }
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-Length: ' . filesize($file));
    header('Content-Disposition: attachment; filename="svgclues.zip"');
    readfile($file);
    unlink($file); 
}));



Route::get('/admin/clues/zip/png/download', array("before" => "admin.auth",function() {
//    \ClueProgress::truncate();
//    \History::truncate();
    $c = DB::select("select clues.title,clues.hash,clues_data.qrcode as qrcode from clues,clues_data where (clues_data.id=clues.id)");
    if (count($c)==0){
        App::abort(404);
        return;
    }
    // Prepare File
    $file = tempnam("tmp", "zip");
    
    $zip = new ZipArchive();
    $zip->open($file, ZipArchive::OVERWRITE);
    
    foreach($c as $clue){
        $zip->addFromString($clue->title.$clue->hash.".png", \base64_decode($clue->qrcode));
    }
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-Length: ' . filesize($file));
    header('Content-Disposition: attachment; filename="pngclues.zip"');
    readfile($file);
    unlink($file); 
}));

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClueController
 *
 * @author test_web_smwc
 */
class ClueController {

    /**
     * 
     * @param type $u user id.
     * @return type
     */
    public static function getCurrentClue($u) {
        // start transaction
        // clues data.
        //start algo
        
        $algo = Algorithm::getCurrentAlgorithm();

        // START TRANSACTION.
        DB::beginTransaction();

        // GET CURRENT CLUE INDEX.
        $clp = ClueProgress::where("uid", "=", $u->id)->get();



        // NO CLUE INDEX!?!?
        if (count($clp) == 0) {
            // GET CLUE OBJ. IT FROM ALGO.
            $clue = $algo->firstTime();
            //
            // set clue.
            if (!\is_object($clue)){
                
                App::abort(404);
            }
            
            self::setActualClue($u, $clue);
            $clp = new \ClueProgress;
            $clp->count = 0;
        } else {
            // Maybe he finish ..
            if ($clp[0]->end != 0) {
                DB::rollback();
                // return win view
                if (Game::RANK_SHOW==true){
                    $rank = DB::select("select clues_progress.id,clues_progress.end as position,prizes.description,users.username as winner from (clues_progress left join prizes on (clues_progress.end=prizes.position) )  join  users on (users.id=clues_progress.uid) where (clues_progress.end!=0)   order by clues_progress.end asc limit ?",array(Game::RANK_SHOW_LIMIT));
                }else{
                    $rank = array();
                }
                
                return View::make('user.clue.win', array("progress" => $clp[0], "user" => $u, "prize" => $algo->alreadyWin($clp[0], $u),"rank"=>$rank));
            }
            // check if user was resetted
            if ($clp[0]->resetted == true) {

                $clue = $algo->firstTime();
                //
                // set clue.
                $clp = array(self::setActualClue($u, $clue,0,$clp[0]));
            }
            
            // get current clue.
            $clp = $clp[0];
            // get current clue.
            $clue = Clue::find($clp->cid);
            // if someone delete it ... get another clue!
            if (!\is_object($clue)){
                
                $clue = $algo->success($clp, $u);
                
                $clp = self::setActualClue($u, $clue,0,$clp);
            }
            
            
        }
        // commit
        DB::commit();
        // set data clues.
        $state = array("clue" => $clue, "progress" => $clp);
        // return maked view with data clues.

        if (is_null($clp)) {
            return View::make("user.clue.welcome", $state);
        } else {
            return View::make("user.clue.actual", $state);
        }
    }   

    private static function setActualClue($u, $c, $count = 0, $cp = null, $end = 0) {
        // new clueprogress.
        if ($cp == null) {
            $cp = new ClueProgress;
            $cp2 = new History;
            $cp2->uid = $u->id; //current user id.
            $cp2->cid = $c->id; // next id.
            $cp2->save();
        }

        $cp->uid = $u->id; //current user id.
        $cp->cid = $c->id; // next id.
        $cp->end = $end;
        $cp->count = $count;
        $cp->save();
        return $cp;
    }
    /**
     * goto next clue.
     * @param type $u
     * @param type $hash
     * @return type
     */
    public static function goToNextClue($u, $hash) {
        DB::beginTransaction();
        // check current game state.

        $algo = \Algorithm::getCurrentAlgorithm();

        $clp = ClueProgress::where("uid", "=", $u->id)->get();

        
        // NO  CURRENT GAME STATE.
        if (sizeof($clp) == 0) {
            DB::rollback();
            // redirect
            return Redirect::to(Game::BASEURL."/user/clue");
        }
        
        $clp = $clp[0];
        // BUT YOU WIN!!?!?
        if ($clp->end != 0) {
            DB::rollback();
            if (Game::RANK_SHOW==true){
                 $rank = DB::select("select clues_progress.id,clues_progress.end as position,prizes.description,users.username as winner from (clues_progress left join prizes on (clues_progress.end=prizes.position) )  join  users on (users.id=clues_progress.uid) where (clues_progress.end!=0)   order by clues_progress.end asc limit ?",array(Game::RANK_SHOW_LIMIT));
            }else{
                 $rank = array();
            }
            // return win view.
            return View::make('user.clue.win', array("progress" => $clp, "user" => $u, "prize" => $algo->alreadyWin($clp, $u),"rank"=>$rank));
        }

        // OK GET THE CURRENT CLUE.
        $clue = Clue::findOrFail($clp->cid);
        // CHECK HASH
        // IF ISN'T RIGHT.

        if ($clue->hash != $hash) {
            // ROLLBACK, CALL ALGO, RETURN WRONG CLUE VIEW.
            DB::rollback();
            $algo->fail($clp, $u); // algorithm fail.
            return View::make('user.clue.wrong', array("progress" => $clp, "clue" => $clue));
        }
        
        // if hash is right.
        // OK MAYBE THIS IS THE LAST CLUE.
        // > (for case which the clues count is equal to 1 see /user/clue
        if ($clp->count + 1 >= Clue::count()) {
            $clp->count = $clp->count + 1;
            $clp->end = ClueProgress::max('end') + 1;
            $clp->save();
            if (Game::RANK_SHOW==true){
                 $rank = DB::select("select clues_progress.id,clues_progress.end as position,prizes.description,users.username as winner from (clues_progress left join prizes on (clues_progress.end=prizes.position) )  join  users on (users.id=clues_progress.uid) where (clues_progress.end!=0)   order by clues_progress.end asc limit ?;",array(Game::RANK_SHOW_LIMIT));
            }else{
                 $rank = array();
            }
            $view = View::make('user.clue.win', array("progress" => $clp, "user" => $u, "prize" => $algo->win($clp, $u),"rank"=>$rank));

            DB::commit();
            return $view;
        }

        $clp->count = $clp->count + 1;

        $clue = $algo->success($clp, $u);
        // SAVE IN PROGRESS.

        $clp->cid = $clue->id;
        $clp->save();
        // ALGORITHM SUCCESS.
        //commit data.
        DB::commit();
        // SHOW ME, OK IT'S FOUND ...
        return View::make('user.clue.new', array("clue" => $clue, "progress" => $clp));
    }

    
    /**
     * Save qr code.
     * @param type $clue
     */
    public static function createQrCode($clue){
        
        $dclue = new ClueData();
        QrCode::format('png');
        QrCode::size(Game::QR_SIZE);
        // change color
        QrCode::color(Game::QR_COLOR_R,Game::QR_COLOR_G,Game::QR_COLOR_B);
        QrCode::backgroundColor(Game::QR_BCOLOR_R,Game::QR_BCOLOR_G,Game::QR_BCOLOR_B);
        $dclue->qrcode       = base64_encode(QrCode::encoding('UTF-8')->generate(URL::to("/").'/user/clue/'.$clue->hash));
        QrCode::format('svg');
        // change color 
        
        QrCode::color(Game::QR_COLOR_R,Game::QR_COLOR_G,Game::QR_COLOR_B);
        QrCode::backgroundColor(Game::QR_BCOLOR_R,Game::QR_BCOLOR_G,Game::QR_BCOLOR_B);
        $dclue->svgqrcode       = QrCode::encoding('UTF-8')->generate(URL::to("/").'/user/clue/'.$clue->hash);
        $dclue->id = $clue->id;
        $dclue->save();
    }
    
    public static function editQrCode($clue){

        $dclue = ClueData::find($clue->id);
        QrCode::format('png');
        QrCode::size(Game::QR_SIZE);
        QrCode::color(Game::QR_COLOR_R,Game::QR_COLOR_G,Game::QR_COLOR_B);
        QrCode::backgroundColor(Game::QR_BCOLOR_R,Game::QR_BCOLOR_G,Game::QR_BCOLOR_B);
        $dclue->qrcode       = base64_encode(QrCode::encoding('UTF-8')->generate(URL::to("/").'/user/clue/'.$clue->hash));
        QrCode::format('svg');
        QrCode::color(Game::QR_COLOR_R,Game::QR_COLOR_G,Game::QR_COLOR_B);
        QrCode::backgroundColor(Game::QR_BCOLOR_R,Game::QR_BCOLOR_G,Game::QR_BCOLOR_B);
        $dclue->svgqrcode       = QrCode::encoding('UTF-8')->generate(URL::to("/").'/user/clue/'.$clue->hash);
        $dclue->id = $clue->id;
        $dclue->save();
        
    }
}

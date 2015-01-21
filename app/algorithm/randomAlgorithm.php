<?php


/**
 * Description of randomAlgorithm
 *
 * @author Fabio Pagnotta
 */
class randomAlgorithm implements currentAlgorithm {

    public static function fail($progress, $user) {
        
    }

    public static function firstTime() {
        return DB::select('select clues.title,clues.id,clues.description from  clues ORDER BY rand() LIMIT 1')[0];
    }

    public static function success($progress, $user) {


        //check query

        $db = DB::select('select clues.id,clues.title,clues.description,clues.gpsx,clues.gpsy from  clues left join (select * from history where (history.uid=?)  ) as historic  on (clues.id=historic.cid) where  (clues.id<>?) and historic.cid is NULL ORDER BY rand() LIMIT 1', array($progress->uid, $progress->cid));
        if (count($db) == 0) {
            // bad situation.
            //return null;
            App::abort(404,"No next clue");
        } else {
            // ok save progresss
            // save in history
            $clp2 = new History;
            $db = $db[0];
            $clp2->cid = $db->id;
            $clp2->uid = $progress->uid;
            $clp2->save();
        }
        return $db;
    }

    public static function win($progress, $user) {
        //save in history
        $clp2 = new History;
        $clp2->cid = $progress->cid;
        $clp2->uid = $progress->uid;
        $clp2->save();
        // get prize
        return array("name" => self::getPrize($progress));
    }
    
    public static function alreadyWin($progress, $user) {
        
        return array("name" => self::getPrize($progress));
    }

    public static function getPrize($progress){
        $prize = Prize::where("position","=",$progress->end)->first();
        if (\is_null($prize)){
            return Lang::get("prize.game.default");
        }
        else
        {
            return $prize->description;
        }
    }
}

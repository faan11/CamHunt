<?php

/**
 * Description of currentAlgorithm
 *
 * @author Fabio Pagnotta
 */
interface currentAlgorithm {
    /**
     * The user attend the first time, the game. 
     * @return Clue the first clue.
     */
    public static function firstTime();
    /**
     * The user fails the algorithm.
     * @param ClueProgress $progress 
     * @param User $user
     */
    public static function fail($progress,$user);
    /**
     * 
     * The user win the game.
     * @param ClueProgress $progress
     * @param User $user
     * @return the prize. (check user.clue.win)
     */
    public static function win($progress,$user);
    /**
     * The user already win.
     * @param type $progress
     * @param type $user
     */
    public static function alreadyWin($progress,$user);
    /**
     * 
     * @param ClueProgress $progress
     * @param User $user
     * @return Clue the next clue.
     */
    public static function success($progress,$user);
}

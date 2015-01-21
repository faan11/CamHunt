<?php


class Configz extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'config';
        
        public $timestamps = true;
        
        
        private static function _get(){
            return self::all()[0];
        }
        
        
        public  static function canRegister(){
            $me= self::_get();
            
            return  ($me->registration_active);
            
        }
        
        
        public  static function canPlay(){
            $me= self::_get();
            
            return  ($me->match_active);
            
            
            
            
        }
        

        

}

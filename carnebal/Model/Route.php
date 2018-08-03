<?php
class Route {
    
    public static $rotasValidas = array();

    public static function set($rotaValida, $function){

        self::$rotasValidas[] = $rotaValida;

        if ($_GET['url'] == $rotaValida){
            $function->__invoke();
        }
    }
    
}//class
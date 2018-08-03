<?php

class BaseUrl {
    
    public static $baseUrl = 'http://localhost/carnebal';
    
    public static function getBaseUrl(){
        return self::$baseUrl;
    }
    
}
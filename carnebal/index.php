<?php

require_once("Routes.php");

function __autoload($class_name) {
    if (file_exists('./Model/'.$class_name.'.php')){
        require_once './Model/'.$class_name.'.php';
    } else
    if (file_exists('./Controller/'.$class_name.'.php')){
        require_once './Controller/'.$class_name.'.php';
    }
      
}
?>
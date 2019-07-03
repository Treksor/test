<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

function loadClasses($className)
{
//    $class_pieces=explode('\\',$className);
//    require($_SERVER['DOCUMENT_ROOT']."/classes/".$class_pieces.".php");
    if (file_exists("./classes/".$className.".php")){
        require ("./classes/".$className.".php");
    }


}
spl_autoload_register('loadClasses');

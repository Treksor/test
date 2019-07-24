<?php

function loadClasses($className)
{
//    $class_pieces=explode('\\',$className);
//    require($_SERVER['DOCUMENT_ROOT']."/classes/".$class_pieces.".php");
    if (file_exists("./classes/".$className.".php")){
        require ("./classes/".$className.".php");
    }


}
spl_autoload_register('loadClasses');

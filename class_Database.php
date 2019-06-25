<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);
$project_root=$_SERVER['DOCUMENT_ROOT'];
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";

class Database
{
    public static function connectDB()
    {
        $file='./temp/data.txt';
        $data=fopen($file,'r');
        $logininfo=fread($data,filesize($file));
        $logininfo=unserialize($logininfo);
        fclose($data);
        $db = DbSimple_Generic::connect("mysqli://$logininfo[user]:$logininfo[pass]@$logininfo[host]/");
        if ($db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$logininfo[dbname]'")){
            $db->query("USE $logininfo[dbname]");
        }else{
            die ('Нет такой бд.<a href="migrate.php"> Создать?');
        }
        return $db;
    }

}
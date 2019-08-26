<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

include('autoload.php');
$project_root=$_SERVER['DOCUMENT_ROOT'];
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";

switch($_GET['action']){
    case "delete":
        $db = DBconnect::connectDB();
        $db->select("DELETE FROM `adds` WHERE `adds`.`id`=?d",$_GET['id']);
        echo "Товар ".$_GET['id']." удален";
        break;
    default:
        break;
}
?>


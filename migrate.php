<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$project_root=$_SERVER['DOCUMENT_ROOT'];
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";
function create($db,$cities,$categories){
    $db->query('CREATE TABLE `cities` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `city` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL
  ) ENGINE=\'innoDB\' COLLATE \'utf8_general_ci\'');

    $db->query('CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL
) ENGINE=\'innoDB\' COLLATE \'utf8_general_ci\'');

    $db->query('CREATE TABLE `adds` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `status` enum(\'person\', \'company\') COLLATE \'utf8_general_ci\' NOT NULL,
  `user_name` varchar(40) COLLATE \'utf8_general_ci\' NOT NULL,
  `user_email` varchar(40) COLLATE \'utf8_general_ci\' NOT NULL,
  `checkbox` tinyint(1) NOT NULL,
  `phone_number` char(11) COLLATE \'utf8_general_ci\' NOT NULL,
  `city` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL,
  `category` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL,
  `add_name` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL,
  `add_description` text COLLATE \'utf8_general_ci\' NOT NULL,
  `price` DECIMAL(10,2) NOT NULL
) ENGINE=\'innoDB\' COLLATE \'utf8_general_ci\';');

    foreach ($cities as $value){
        $db->query("INSERT INTO `cities` (`city`) VALUES ('$value');");
    }

    foreach ($categories as $value){
        $db->query("INSERT INTO `categories` (`category`) VALUES ('$value');");
    }
}

function databaseErrorHandler($message, $info)
{
    // Если использовалась @, ничего не делать.
    if (!error_reporting()) return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>";
    print_r($info);
    echo "</pre>";
    exit();
}

function savedata($var,$file='./temp/data.txt'){
    $data=fopen($file,'w');
    fwrite($data, $var);
    fclose($data);
}

$cities = array('Выбери место жительства','Новосибирск','Луна','Марс','Титан','Нибиру');
$categories=array('Что продаемс?','Бакалея','Девайсы','Бухло','Детское','Книги');

if (isset($_POST['submit'])){
    $db = DbSimple_Generic::connect("mysqli://$_POST[user]:$_POST[pass]@$_POST[host]/");
//    $db->setErrorHandler('databaseErrorHandler');
    if ($db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$_POST[dbname]'")){
        $db->query("DROP DATABASE `$_POST[dbname]` COLLATE 'utf8_general_ci'");
        $db->query("CREATE DATABASE `$_POST[dbname]` COLLATE 'utf8_general_ci'");
        $db->query("USE $_POST[dbname]");
    }else{
        $db->query("CREATE DATABASE `$_POST[dbname]` COLLATE 'utf8_general_ci'");
        $db->query("USE $_POST[dbname]");
    }
    create($db,$cities,$categories);
    $data=serialize($_POST);
    savedata($data);
    header('location: ./index.php');
}


?>

<form method="POST">
    <p><label class="left-label" for="host">Хост</label> <input name="host" type="text" id="host" value="">
    <p><label class="left-label" for="user">Юзер</label> <input name="user" type="text" id="user" value="">
    <p><label class="left-label" for="pass">Пароль</label> <input name="pass" type="text" id="pass" value="">
    <p><label class="left-label" for="dbname">Название</label> <input name="dbname" type="text" id="dbname" value="">
    <p><input type="submit" name="submit" value="submit">
</form>

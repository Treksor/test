<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

function create(){
    mysql_query('CREATE TABLE `cities` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `city` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL
  ) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\'') or die('города не создались'.mysql_error());

    mysql_query('CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL
) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\'') or die('категории не создались' . mysql_error());

    mysql_query('CREATE TABLE `adds` (
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
) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\';') or die('шаблон объявы не создался' . mysql_error());

}

function savedata($var,$file='./temp/data.txt'){
    $data=fopen($file,'w');
    fwrite($data, $var);
    fclose($data);
}

if (isset($_POST['submit'])){
    $db=mysql_connect($_POST['host'],$_POST['user'],$_POST['pass']) or die('нет соединения с сервером'.mysql_error());
    $a=mysql_select_db($_POST['dbname'],$db);
    if (!$a){
        mysql_query("CREATE DATABASE `$_POST[dbname]` COLLATE 'utf8_general_ci'") or die ('не могу создать'.mysql_error());
        mysql_select_db($_POST['dbname'],$db);
        create();
    }else{
        mysql_query("DROP DATABASE $_POST[dbname]");
        mysql_query("CREATE DATABASE `$_POST[dbname]` COLLATE 'utf8_general_ci'") or die ('не могу создать заного'.mysql_error());
        mysql_select_db($_POST['dbname'],$db);
        create();
    }
    $data=serialize($_POST);
    savedata($data);
    header('location: ./index.php');
}

$cities = array('Выбери место жительства','Новосибирск','Луна','Параша','Жопа','Нибиру');
$categories=array('Что продаемс?','Космос','Гавно','Еще гавно','Еще больше гавна','Телега говна с горкой');

foreach ($cities as $value){
    mysql_query("INSERT INTO `cities` (`city`)
VALUES ('$value');");
}

foreach ($categories as $value){
    mysql_query("INSERT INTO `categories` (`category`)
VALUES ('$value');");
}

?>

<form method="POST">
    <p><label class="left-label" for="host">Хост</label> <input name="host" type="text" id="host" value="">
    <p><label class="left-label" for="user">Юзер</label> <input name="user" type="text" id="user" value="">
    <p><label class="left-label" for="pass">Пароль</label> <input name="pass" type="text" id="pass" value="">
    <p><label class="left-label" for="dbname">Название</label> <input name="dbname" type="text" id="dbname" value="">
    <p><input type="submit" name="submit" value="submit">
</form>

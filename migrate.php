<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

function create($host,$user,$pass,$dbname){
    $db=mysql_connect($host,$user,$pass) or die('нет соединения с сервером'.mysql_error());
    mysql_query("CREATE DATABASE `$dbname` COLLATE 'utf8_general_ci'") or die ('не могу создать'.mysql_error());
}

function savedata($var,$file='./temp/data.txt'){
    $data=fopen($file,'w');
    fwrite($data, $var);
    fclose($data);
}

if (isset($_POST['submit'])){
    create($_POST['host'],$_POST['user'],$_POST['pass'],$_POST['dbname']);
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

<?php
function connect_db(){
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

function list_options($col,$table,$db){
    $result=$db->selectCol("SELECT $col FROM $table");
    return $result;
}

function saveAds($var,$tablename,$db){
    $db->query("INSERT INTO `$tablename` (?#) VALUES (?a)",array_keys($var),array_values($var));
}

function updateAds($var,$tablename,$db){
    $a=$var['id'];
    unset($var['id']);
    $db->query("UPDATE `$tablename` SET ?a WHERE  `$tablename`.`id` =?",$var,$a);
}

function getAds($db){
    $result = $db->select("SELECT * FROM adds");
    $db->setErrorHandler('databaseErrorHandler');
    return $result;
}

function deleteAds($ad,$db){
    $db->select("DELETE FROM `adds` WHERE `adds`.`id`=?",$ad['id']);
}

function prepareDataForSave($a){
    unset($a['submit']);
    unset($a['id']);
    $a['phone_number']=preg_replace('~\D+~','',$a['phone_number']);
    if (!array_key_exists('checkbox',$a)){
        $a['checkbox']='0';
    }else{
        $a['checkbox']='1';
    }
    return $a;
}

function prepareDataForUpdate($a){
    unset($a['submit']);
    $a['phone_number']=preg_replace('~\D+~','',$a['phone_number']);
    if (!array_key_exists('checkbox',$a)){
        $a['checkbox']='0';
    }else{
        $a['checkbox']='1';
    }
    return $a;
}



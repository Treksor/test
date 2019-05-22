<?php
function connect_db(){
    $file='./temp/data.txt';
    $data=fopen($file,'r');
    $logininfo=fread($data,filesize($file));
    $logininfo=unserialize($logininfo);
    fclose($data);
    $db = mysql_connect($logininfo['host'],$logininfo['user'],$logininfo['pass']) or die('нет соединения с сервером'.mysql_error());
    $a=mysql_select_db($logininfo['dbname'],$db) or die ('Нет такой бд.<a href="migrate.php"> Создать?');
    return $a;

}

function TableExists($table) {
    $res = mysql_query("SHOW TABLES LIKE '$table'");
    return mysql_num_rows($res) > 0;
}

function list_options($col,$table){
    $output=array();
    $result=mysql_query("select * from $table");
    while ($row=mysql_fetch_assoc($result)){
        $output[$row['id']]=$row[$col];
    }
    mysql_free_result($result);
    return $output;
}

function saveAds($var){
    mysql_query("INSERT INTO `adds` (`status`, `user_name`, `user_email`, `check`, `phone_number`, `city`, `category`, `add_name`, `add_description`, `price`)
VALUES ('$var[status]', '$var[user_name]', '$var[user_email]', '$var[check]', '$var[phone_number]',
'$var[city]', '$var[category]', '$var[add_name]', '$var[add_description]', '$var[price]');");
}

function updateAds($var){
    mysql_query("UPDATE  `lesson8`.`adds` SET  
`status` = '$var[status]',
`user_name` =  '$var[user_name]',
`user_email` = '$var[user_email]',
`phone_number` =  '$var[phone_number]',
`city` =  '$var[city]',
`category` =  '$var[category]',
`add_name` =  '$var[add_name]',
`add_description` =  '$var[add_description]',
`price` =  '$var[price]'
 WHERE  `adds`.`id` ='$var[id]';")or die('изменения не внесены' . mysql_error());
}

function getAds(){
    $output=array();
    $result = mysql_query("SELECT * FROM adds");
    while ($row=mysql_fetch_assoc($result)){
        $output[$row['id']]=$row;
    }
    mysql_free_result($result);
    return $output;
}

function deleteAds($ad){
    mysql_query("DELETE FROM `lesson8`.`adds` WHERE `adds`.`id`=$ad[id]");
}

function checkTheCheck($a){
    if (!array_key_exists('check',$a)){
        $a['check']='off';
    }
    return $a;
}


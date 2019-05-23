<?php
function connect_db(){
    $file='./temp/data.txt';
    $data=fopen($file,'r');
    $logininfo=fread($data,filesize($file));
    $logininfo=unserialize($logininfo);
    fclose($data);
    $db = mysql_connect($logininfo['host'],$logininfo['user'],$logininfo['pass']) or die('нет соединения с сервером'.mysql_error());
    mysql_select_db($logininfo['dbname'],$db) or die ('Нет такой бд.<a href="migrate.php"> Создать?');
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
    $keys="`".implode('`,`',array_keys($var))."`";
    $vals="'".implode("','",array_values($var))."'";
    mysql_query("INSERT INTO `adds` ($keys) VALUES ($vals)") or die(''.mysql_error());
}

function updateAds($var,$tablename){
    $a=$var['id'];
    unset($var['id']);
    $keys=array_keys($var);
    $vals=array_values($var);
    for($i = 0, $length=count($keys); $i < $length; ++$i) {
        $pair[]="`$keys[$i]`='$vals[$i]'";
    }
    $pair=implode(',',$pair);
    mysql_query("UPDATE  `$tablename` SET $pair WHERE  `$tablename`.`id` ='$a';") or die('изменения не внесены' . mysql_error());
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
    mysql_query("DELETE FROM `adds` WHERE `adds`.`id`=$ad[id]");
}

function checkTheCheckS($a){
    unset($a['submit']);
    unset($a['id']);
    if (!array_key_exists('checkbox',$a)){
        $a['checkbox']='off';
    }
    return $a;
}

function checkTheCheckU($a){
    unset($a['submit']);
    if (!array_key_exists('checkbox',$a)){
        $a['checkbox']='off';
    }
    return $a;
}

//function updateAds($var){
//    mysql_query("UPDATE  `adds` SET
//`status` = '$var[status]',
//`user_name` =  '$var[user_name]',
//`user_email` = '$var[user_email]',
//`phone_number` =  '$var[phone_number]',
//`city` =  '$var[city]',
//`category` =  '$var[category]',
//`add_name` =  '$var[add_name]',
//`add_description` =  '$var[add_description]',
//`price` =  '$var[price]'
// WHERE  `adds`.`id` ='$var[id]';")or die('изменения не внесены' . mysql_error());
//}
//function saveAds($var){
//    mysql_query("INSERT INTO `adds` (`status`, `user_name`, `user_email`, `checkbox`, `phone_number`, `city`, `category`, `add_name`, `add_description`, `price`)
//VALUES ('$var[status]', '$var[user_name]', '$var[user_email]', '$var[checkbox]', '$var[phone_number]',
//'$var[city]', '$var[category]', '$var[add_name]', '$var[add_description]', '$var[price]');");
//}
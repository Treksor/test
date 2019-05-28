<?php
function connect_db(){
    $file='./temp/data.txt';
    $data=fopen($file,'r');
    $logininfo=fread($data,filesize($file));
    $logininfo=unserialize($logininfo);
    fclose($data);
    $link = mysqli_connect($logininfo['host'],$logininfo['user'],$logininfo['pass']) or die('нет соединения с сервером'.mysqli_error($link));
    mysqli_select_db($link,$logininfo['dbname']) or die ('Нет такой бд.<a href="migrate.php"> Создать?');
    return $link;
}

function list_options($col,$table,$link){
    $output=array();
    $result=mysqli_query($link,"select * from $table");
    while ($row=mysqli_fetch_assoc($result)){
        $output[$row['id']]=$row[$col];
    }
    mysqli_free_result($result);
    return $output;
}

function saveAds($var,$tablename,$link){
//    $keys="`".implode('`,`',array_keys($var))."`";
//    $vals="'".implode("','",array_values($var))."'";
    $stmt = mysqli_prepare($link, "INSERT INTO `$tablename` (status,user_name,user_email,checkbox,phone_number,
    city,category,add_name,add_description,price) VALUES (?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt,'sssisiissd',$var['status'],$var['user_name'],$var['user_email'],
            $var['checkbox'],$var['phone_number'],$var['city'],$var['category'],$var['add_name'],$var['add_description'],$var['price']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

function updateAds($var,$tablename,$link){
    $a=$var['id'];
    unset($var['id']);
    $stmt = mysqli_prepare($link,"UPDATE  `$tablename` SET status=?,user_name=?,user_email=?,checkbox=?,phone_number=?,
    city=?,category=?,add_name=?,add_description=?,price=? WHERE  `$tablename`.`id` ='$a';");
    mysqli_stmt_bind_param($stmt,'sssisiissd',$var['status'],$var['user_name'],$var['user_email'],
        $var['checkbox'],$var['phone_number'],$var['city'],$var['category'],$var['add_name'],$var['add_description'],$var['price']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

//function saveAds($var){
//    $keys="`".implode('`,`',array_map('mysql_real_escape_string',array_keys($var)))."`";
//    $keys="`".implode('`,`',array_keys($var))."`";
//    $vals="'".implode("','",array_values($var))."'";
//    $vals="'".implode("','",array_map('mysql_real_escape_string',array_values($var)))."'";
//    mysql_query("INSERT INTO `adds` ($keys) VALUES ($vals)") or die(''.mysql_error());
//}
//
//function updateAds($var,$tablename){
//    $a=$var['id'];
//    unset($var['id']);
//    $keys=array_map('mysql_real_escape_string',array_keys($var));
//    $vals=array_map('mysql_real_escape_string',array_values($var));
//    for($i = 0, $length=count($keys); $i < $length; ++$i) {
//        $pair[]="`$keys[$i]`='$vals[$i]'";
//    }
//    $pair=implode(',',$pair);
//    mysql_query("UPDATE  `$tablename` SET $pair WHERE  `$tablename`.`id` ='$a';") or die('изменения не внесены' . mysql_error());
//}

function getAds($link){
    $output=array();
    $result = mysqli_query($link,"SELECT * FROM adds");
    while ($row=mysqli_fetch_assoc($result)){
        $output[$row['id']]=$row;
    }
    mysqli_free_result($result);
    return $output;
}

function deleteAds($ad,$link){
    mysqli_query($link,"DELETE FROM `adds` WHERE `adds`.`id`=$ad[id]");
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


//function mysqlcheck($var){
//    $var1=array();
//    foreach ($var as $key=>$value){
//        $key=mysql_real_escape_string($key);
//        $value=mysql_real_escape_string($value);
//        $var1[$key]=$value;
//    }
//    return $var1;
//}
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
////}
//
//function TableExists($table) {
//    $res = mysql_query("SHOW TABLES LIKE '$table'");
//    return mysql_num_rows($res) > 0;
//}

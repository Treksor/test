<?php
//index.php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$project_root=$_SERVER['DOCUMENT_ROOT'];

include('functions.php');

$link=connect_db();


$smarty_dir=$project_root.'/smarty/';
require($smarty_dir.'libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$cities=list_options('city','cities',$link);
$categories=list_options('category','categories',$link);

$item = array(
    'status' => 'person',
    'user_name' => '',
    'user_email' => '',
    'checkbox' =>'1',
    'phone_number' => '',
    'city' => '',
    'category' => '',
    'add_name' => '',
    'add_description' => '',
    'price' => '',
    'submit' => '',
    'id'=>''
);

$allData=getAds($link);

if (isset($_GET['open'])) {
    $item = $allData[$_GET['open']];
}

if (isset($_GET['delete'])) {
    $item=$allData[$_GET['delete']];
    deleteAds($item,$link);
    header('location: ./index.php');
}

if (isset($_POST['submit'])){
    if (is_numeric($item['id'])){
        $itemtosave=prepareDataForUpdate($_POST);
        updateAds($itemtosave,'adds',$link);
    }
    else {
        $itemtosave=prepareDataForSave($_POST);
        saveAds($itemtosave,'adds',$link);
    }
    header('location: ./index.php');
}

$smarty->assign('status',array('person'=>'Частное лицо',
    'company'=>'Компания'));
$smarty->assign('city',$cities);
$smarty->assign('category',$categories);
$smarty->assign('item',$item);
$smarty->assign('data',$allData);

$smarty->display('index.tpl');

//end of index.php
?>
<!--migrate.php-->
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

function create($link,$cities,$categories){
    mysqli_query($link,'CREATE TABLE `cities` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `city` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL
  ) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\'') or die('города не создались'.mysqli_error($link));

    mysqli_query($link,'CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL
) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\'') or die('категории не создались' . mysqli_error($link));

    mysqli_query($link,'CREATE TABLE `adds` (
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
) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\';') or die('шаблон объявы не создался' . mysqli_error($link));
    foreach ($cities as $value){
        mysqli_query($link,"INSERT INTO `cities` (`city`)
VALUES ('$value');");
    }

    foreach ($categories as $value){
        mysqli_query($link,"INSERT INTO `categories` (`category`)
VALUES ('$value');");
    }
}

function savedata($var,$file='./temp/data.txt'){
    $data=fopen($file,'w');
    fwrite($data, $var);
    fclose($data);
}

$cities = array('Выбери место жительства','Новосибирск','Луна','Параша','Жопа','Нибиру');
$categories=array('Что продаемс?','Космос','Гавно','Еще гавно','Еще больше гавна','Телега говна с горкой');

if (isset($_POST['submit'])){
    $link=mysqli_connect($_POST['host'],$_POST['user'],$_POST['pass']) or die('нет соединения с сервером'.mysqli_error($link));
    if (!mysqli_select_db($link,$_POST['dbname'])){
        mysqli_query($link,"CREATE DATABASE `$_POST[dbname]` COLLATE 'utf8_general_ci'") or die ('не могу создать'.mysqli_error($link));
        $link=mysqli_connect($_POST['host'],$_POST['user'],$_POST['pass'],$_POST['dbname']);
        create($link,$cities,$categories);
    }else{
        mysqli_query($link,"DROP DATABASE $_POST[dbname]");
        mysqli_query($link,"CREATE DATABASE `$_POST[dbname]` COLLATE 'utf8_general_ci'") or die ('не могу создать заного'.mysqli_error($link));
        $link=mysqli_connect($_POST['host'],$_POST['user'],$_POST['pass'],$_POST['dbname']);
        create($link,$cities,$categories);
    }
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

<!--end of migrate.php-->

<!--functions.php-->
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
?>
<!--//    end of functions.php-->

<!--index.tpl-->
{include file='header.tpl'}

<link rel="stylesheet" type="text/css" href=styles.css>
<form method="POST">
    <input type="hidden" name="id" value="{$item.id}">
    {html_radios name="status" options=$status selected=$item.status}
    <br>
    <p><label class="left-label" for="user_name">Ваше имя</label> <input name="user_name" type="text" id="user_name" value="{$item.user_name|escape:'UTF-8':'htmlall'}">
        <br>
        <label class="left-label" for="user_email">Электронная почта </label><input name="user_email" type="email" id="user_email" value="{$item.user_email}">
    <p><input type="checkbox" name="checkbox" id="checkbox" {if $item.checkbox==='1'}checked{/if}> <label for="checkbox">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="phone_number">Номер телефона: </label><input name="phone_number" type="text" id="phone_number" value="{$item.phone_number}">
    <p><label class="left-label" for="city">Город</label>
    <p>{html_options name=city options=$city selected=$item.city}
    <p><label class="left-label" for="category">Категория</label>
    <p>{html_options name=category options=$category selected=$item.category}

    <p><label class="left-label" for="add_name">Название объявления </label><input name="add_name" type="text" id="add_name" value="{$item.add_name|escape:'UTF-8':'htmlall'}">
    <p><label class="left-label" for="add_description">Описание товара</label><textarea name="add_description" id="add_description" style="resize:none;">{$item.add_description|escape:'UTF-8':'htmlall'}</textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value="{$item.price}">руб.
    <p><input type="submit" name="submit" value="submit">
</form>

<table cellpadding="10px">
    <tr>
        <td>Номер</td>
        <td>Название объявления</td>
        <td>Цена</td>
        <td>Имя</td>
    </tr>
    {if !empty($data)}
    {foreach from=$data key=id item=i}
    <tr>
        <td>{$id}</td>
        <td><a href="../index.php?open={$id}">{$i.add_name|escape:'UTF-8':'htmlall'}</a></td>
        <td>{$i.price}</td>
        <td>{$i.user_name|escape:'UTF-8':'htmlall'}</td>
        <td><a href="../index.php?delete={$id}">Удалить</a></td>
    </tr>
    {/foreach}
    {/if}
</table>



{include file='footer.tpl'}

<!--end of index.tpl-->


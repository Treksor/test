<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);


$project_root=$_SERVER['DOCUMENT_ROOT'];
$smarty_dir=$project_root.'/smarty/';
require($smarty_dir.'libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

function connect_db(){
    $file='./temp/data.txt';
    $data=fopen($file,'r');
    $logininfo=fread($data,filesize($file));
    $logininfo=unserialize($logininfo);
    fclose($data);
    $db = mysql_connect($logininfo['host'],$logininfo['user'],$logininfo['pass']) or die('нет соединения с сервером'.mysql_error());
    mysql_select_db($logininfo['dbname'],$db) or die ('нет соединения с бд'.mysql_error());
}

function close_result($result){
    mysql_free_result($result);
}

function TableExists($table) {
    $res = mysql_query("SHOW TABLES LIKE '$table'");
    return mysql_num_rows($res) > 0;
}

connect_db();

$cities = array('Выбери место жительства','Новосибирск','Луна','Параша','Жопа','Нибиру');
$categories=array('Что продаемс?','Космос','Гавно','Еще гавно','Еще больше гавна','Телега говна с горкой');


if (!TableExists('cities')){
    mysql_query('CREATE TABLE `cities` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `city_name` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL
  ) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\'') or die('города не создались'.mysql_error());
   foreach ($cities as $value){
       mysql_query("INSERT INTO `cities` (`city`)
VALUES ('$value');");
   }
}

if (!TableExists('categories')) {
    mysql_query('CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL
) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\'') or die('категории не создались' . mysql_error());
    foreach ($categories as $value){
        mysql_query("INSERT INTO `categories` (`category`)
VALUES ('$value');");
    }
}

if (!TableExists('adds')) {
    mysql_query('CREATE TABLE `adds` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `status` varchar(7) COLLATE \'utf8_general_ci\' NOT NULL,
  `user_name` varchar(40) COLLATE \'utf8_general_ci\' NOT NULL,
  `user_email` varchar(40) COLLATE \'utf8_general_ci\' NOT NULL,
  `check` tinyint NOT NULL,
  `phone_number` char(11) COLLATE \'utf8_general_ci\' NOT NULL,
  `city` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL,
  `category` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL,
  `add_name` varchar(50) COLLATE \'utf8_general_ci\' NOT NULL,
  `add_description` text COLLATE \'utf8_general_ci\' NOT NULL,
  `price` int NOT NULL
) ENGINE=\'MyISAM\' COLLATE \'utf8_general_ci\';') or die('шаблон объявы не создался' . mysql_error());
}

function list_options($col,$table){
    $result=mysql_query("select * from $table");
    while ($row=mysql_fetch_assoc($result)){
        $output[$row['id']]=$row[$col];
    }
    close_result($result);
    return $output;
}

$cities=list_options('city','cities');
$categories=list_options('category','categories');


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
    $result = mysql_query("SELECT * FROM adds");
    while ($row=mysql_fetch_assoc($result)){
        $output[$row['id']]=$row;
    }
    close_result($result);
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

$item = array(
    'status' => 'person',
    'user_name' => '',
    'user_email' => '',
    'check' =>'on',
    'phone_number' => '',
    'city' => '',
    'category' => '',
    'add_name' => '',
    'add_description' => '',
    'price' => '',
    'submit' => '',
    'id'=>''
);

$allData=getAds();

if (isset($_GET['open'])) {
    $item = $allData[$_GET['open']];
}

if (isset($_GET['delete'])) {
    $item=$allData[$_GET['delete']];
    deleteAds($item);
    header('location: ./index.php');
}

if (isset($_POST['submit'])){
    $itemtosave=checkTheCheck($_POST);
    if (is_numeric($item['id'])){
        updateAds($itemtosave);
    }
    else {
        saveAds($itemtosave);
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

?>







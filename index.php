<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

include('functions.php');
connect_db();

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

$cities=list_options('city','cities');
$categories=list_options('category','categories');

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







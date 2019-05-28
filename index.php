<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

include('functions.php');
$link=connect_db();
phpinfo();
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

?>







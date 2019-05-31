<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$project_root=$_SERVER['DOCUMENT_ROOT'];
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";
include('functions.php');

$db=connect_db();

$smarty_dir=$project_root.'/smarty/';
require($smarty_dir.'libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$cities=list_options('city','cities',$db);
$categories=list_options('category','categories',$db);

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

$allData=getAds($db);

if (isset($_GET['open'])) {
    $item = $allData[$_GET['open']];
}

if (isset($_GET['delete'])) {
    $item=$allData[$_GET['delete']];
    deleteAds($item,$db);
    header('location: ./index.php');
}

if (isset($_POST['submit'])){
    if (is_numeric($item['id'])){
        $itemtosave=prepareDataForUpdate($_POST);
        updateAds($itemtosave,'adds',$db);
    }
    else {
        $itemtosave=prepareDataForSave($_POST);
        saveAds($itemtosave,'adds',$db);
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







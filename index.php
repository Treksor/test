<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$project_root=$_SERVER['DOCUMENT_ROOT'];
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";
include('class_Database.php');
include('class_ad.php');

$smarty_dir=$project_root.'/smarty/';
require($smarty_dir.'libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$cities=NewAd::getOptions('city','cities');
$categories=NewAd::getOptions('category','categories');

//$item = new NewAd(0);
$allData=NewAd::getAds();

if (isset($_GET['open']))
{
    $item = $allData[$_GET['open']];
}
elseif (isset($_GET['delete']))
{
    $item=$allData[$_GET['delete']];
    $item->deleteAd();
    header('location: ./index.php');
}
elseif (isset($_POST['submit']))
{
    if (is_numeric($_POST['id']))
    {
        $item=$allData[$_POST['id']];
        $item->updateAd($_POST,'adds');
    }
    else
        {
            $ad= new NewAd($_POST);
            $ad->saveAd('adds');
            $item = new NewAd(0);
        }
//    unset($_REQUEST);
//    header('location: ./index.php');
}
else
{
    $item = new NewAd(0);
}

$smarty->assign('status',array('person'=>'Частное лицо',
                                          'company'=>'Компания'));
$smarty->assign('city',$cities);
$smarty->assign('category',$categories);
$smarty->assign('item',$item);
$smarty->assign('data',$allData);

$smarty->display('index.tpl');

?>







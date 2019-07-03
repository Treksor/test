<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$project_root=$_SERVER['DOCUMENT_ROOT'];
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";
include('autoload.php');


$smarty_dir=$project_root.'/smarty/';
require($smarty_dir.'libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$cities=Options_towns::getOptions('city','cities');
$categories=Options_categories::getOptions('category','categories');

if (isset($_GET['open']))
{
//    $item = $allData[$_GET['open']];
    $item=NewAd::findAd($_GET['open']);
}
elseif (isset($_GET['delete']))
{
//    $item=$allData[$_GET['delete']];
    $item=NewAd::findAd($_GET['delete']);
    $item->deleteAd();
    $item = new NewAd();
}
elseif (isset($_POST['submit']))
{
    if (is_numeric($_POST['id']))
    {
//        $item=$allData[$_POST['id']];
        $item=NewAd::findAd($_POST['id']);
        $item->updateAd($_POST,'adds');
        $item = new NewAd();
    }
    else
        {
            $ad= new NewAd($_POST);
            $ad->saveAd('adds');
            $item = new NewAd();
        }
}

if (!isset($item) || !($item instanceof NewAd))
{
    $item = new NewAd();
}

$allData=NewAd::getAds();

$smarty->assign('status',array('person'=>'Частное лицо',
                                          'company'=>'Компания'));
$smarty->assign('city',$cities);
$smarty->assign('category',$categories);
$smarty->assign('item',$item);
$smarty->assign('data',$allData);

$smarty->display('index.tpl');

?>







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

$cities=OptionsTowns::getOptions('city','cities');
$categories=OptionsCategories::getOptions('category','categories');


if (isset($_POST['submit']))
{
    $ad=AdFactory::createAd($_POST,$_POST['status']);
    $ad->saveAd();
//    if (is_numeric($_POST['id']))
//    {
////        $item=$allData[$_POST['id']];
//        $item=NewAd::findAd($_POST['id']);
//        $item->updateAd($_POST,'adds');
//        $item = new NewAd();
//    }
//    else
//        {
//            $ad= new NewAd($_POST);
//            $ad->saveAd('adds');
//            $item = new NewAd();
//        }
}
elseif (isset($_GET['delete']))
{
    NewAd::findAd($_GET['delete'])->deleteAd();
}
elseif (isset($_GET['open']))
{
    $item=NewAd::findAd($_GET['open']);
}

if (!isset($item) || !($item instanceof NewAd))
{
    $item = AdFactory::createAd(array(),'person');
}

$smarty->assign('status',array('person'=>'Частное лицо',
                                          'company'=>'Компания'));
$smarty->assign('city',$cities);
$smarty->assign('category',$categories);
$smarty->assign('item',$item);

$main=AdsStore::instance();
$main->getAllAdsFromDb();
$main->outputAds();
$smarty->display('oop.tpl');

?>







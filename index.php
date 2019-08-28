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
$smarty->debugging = false;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$cities=OptionsTowns::getOptions('city','cities');
$categories=OptionsCategories::getOptions('category','categories');
$action=isset($_REQUEST['action']) ? $_REQUEST['action']:"";


//if (isset($_POST['submit'])) {
//    $ad = AdFactory::createAd($_POST, $_POST['status']);
//    $ad->saveAd();
//    if (is_numeric($_POST['id']))
//    {
////        $item=$allData[$_POST['id']];
//        $item=BaseAd::findAd($_POST['id']);
//        $item->updateAd($_POST,'adds');
//        $item = new BaseAd();
//    }
//    else
//        {
//            $ad= new BaseAd($_POST);
//            $ad->saveAd('adds');
//            $item = new BaseAd();
//        }
//if (isset($_REQUEST['action'])) {
    switch ($action) {
        case "submit":
            $ad = AdFactory::createAd($_POST, $_POST['status']);
            $ad->saveAd();
            break;
        case "delete":
            BaseAd::findAd($_GET['id'])->deleteAd();
            exit;
            break;
        case "open":
            $item = BaseAd::findAd($_GET['id']);
            break;
        default:
            break;
    }
//}
//elseif (isset($_GET['action']))
//{
//    BaseAd::findAd($_GET['id'])->deleteAd();
//    exit;
//}
//elseif (isset($_GET['open']))
//{
//    $item=BaseAd::findAd($_GET['open']);
//}

if (!isset($item) || !($item instanceof BaseAd))
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







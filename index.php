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


$item = array(
    'clientType' => 'person',
    'name' => '',
    'mail' => '',
    'check' =>'on',
    'phoneNumber' => '',
    'town' => '',
    'category' => '',
    'caption' => '',
    'notes' => '',
    'price' => '',
    'submit' => '',
    'id'=>''
);
$item1=$item;
$cities = array('Выбери место жительства','Новосибирск','Луна','Параша','Жопа','Нибиру');
$categories=array('Что продаемс?','Космос','Гавно','Еще гавно','Еще больше гавна','Телега говна с горкой');

function checkTheCheck($a){
    if (!array_key_exists('check',$a)){
        $a['check']='';
    }
    return $a;
}
function getAds($file='./temp/data.txt'){
    $data=fopen($file,'r');
    if (filesize($file)>0){
        $var=fread($data,filesize($file));
        $var=unserialize($var);
    }
    fclose($data);
    return $var;
}

function saveAds($var,$file='./temp/data.txt'){
    $data=fopen($file,'w');
    fwrite($data, $var);
    fclose($data);
}
$allData=getAds();

if (isset($_GET['delete'])) {
//    $allData=getAds();
    unset($allData[$_GET['delete']]);
    $var = serialize($allData);
    saveAds($var);
    header('location: ./index.php');
}

if (isset($_GET['open'])) {
//    $allData=getAds();
    $item = $allData[$_GET['open']];
    $item['id'] = $_GET['open'];
}


if (isset($_POST['submit'])){
    $itemtosave=checkTheCheck($_POST);
    if (is_numeric($item['id'])){
        $allData[$item['id']]=$itemtosave;
        $item=$item1;
    }
    else {
        $allData[]=$itemtosave;
    }
    $var=serialize($allData);
    saveAds($var);
    header('location: ./index.php');
}


$smarty->assign('clientType',array('person'=>'Частное лицо',
                                          'company'=>'Компания'));
$smarty->assign('clientTypeS','person');
$smarty->assign('town',$cities);
$smarty->assign('category',$categories);
$smarty->assign('item',$item);
$smarty->assign('data',$allData);








$smarty->display('index.tpl');
?>







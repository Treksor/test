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






<!--.tpl-->
<!--{include file='header.tpl'}-->
<!---->
<!--<link rel="stylesheet" type="text/css" href=styles.css>-->
<!--<form method="POST">-->
<!--    <input type="hidden" name="id" value="{$item.id}">-->
<!--    {html_radios name="clientType" options=$clientType selected=$item.clientType}-->
<!--    <br>-->
<!--    <p><label class="left-label" for="name">Ваше имя</label> <input name="name" type="text" id="name" value="{$item.name}">-->
<!--        <br>-->
<!--        <label class="left-label" for="mail">Электронная почта </label><input name="mail" type="email" id="mail" value="{$item.mail}">-->
<!--    <p><input type="checkbox" name="check" id="samayaglavnayagalka" {if $item.check==='on'}checked{/if}> <label for="samayaglavnayagalka">Я не хочу получать вопросы по объявлению по e-mail</label>-->
<!--    <p><label class="left-label" for="tnumber">Номер телефона: </label><input name="phoneNumber" type="text" id="tnumber" value="{$item.phoneNumber}">-->
<!--    <p><label class="left-label" for="town">Город</label>-->
<!--    <p>{html_options name=town options=$town selected=$item.town}-->
<!--    <p><label class="left-label" for="lulz">Категория</label>-->
<!--    <p>{html_options name=category options=$category selected=$item.category}-->
<!---->
<!--    <p><label class="left-label" for="nazvanieobyavy">Название объявления </label><input name="caption" type="text" id="nazvanieobyavy" value="{$item.caption}">-->
<!--    <p><label class="left-label" for="notes">Описание товара</label><textarea name="notes" id="notes" style="resize:none;">{$item.notes}</textarea>-->
<!--    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value="{$item.price}">руб.-->
<!--    <p><input type="submit" name="submit" value="submit">-->
<!--</form>-->
<!---->
<!---->
<!---->
<!--<table cellpadding="10px">-->
<!--    <tr>-->
<!--        <td>Номер</td>-->
<!--        <td>Название объявления</td>-->
<!--        <td>Цена</td>-->
<!--        <td>Имя</td>-->
<!--    </tr>-->
<!--    {if !empty($data)}-->
<!--    {foreach from=$data key=id item=i}-->
<!--    <tr>-->
<!--        <td>{$id+1}</td>-->
<!--        <td><a href="../index.php?open={$id}">{$i.caption}</a></td>-->
<!--        <td>{$i.price}</td>-->
<!--        <td>{$i.name}</td>-->
<!--        <td><a href="../index.php?delete={$id}">Удалить</a></td>-->
<!--    </tr>-->
<!--    {/foreach}-->
<!--    {/if}-->
<!--</table>-->
<!---->
<!---->
<!--{*separator="<br />"}*}-->
<!---->
<!--{*<ul>*}-->
<!--    {*{foreach from=$items key=myId item=i}*}-->
<!--    {*<li><a href="item.php?id={$myId}">{$i.no}: {$i.label}</a></li>*}-->
<!--    {*{/foreach}*}-->
<!--    {*</ul>*}-->
<!---->
<!--{*{html_options name=customer_id options=$cust_options selected=$customer_id}*}-->
<!--{*<br>*}-->
<!--{*{html_table loop=$data}*}-->
<!--{*{html_table loop=$data cols=4 table_attr='border="0"'}*}-->
<!---->
<!---->
<!--{include file='footer.tpl'}-->
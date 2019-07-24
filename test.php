<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$project_root=$_SERVER['DOCUMENT_ROOT'];

$smarty_dir=$project_root.'/smarty/';
require($smarty_dir.'libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->debugging = false;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';

$smarty->display('oop.tpl');
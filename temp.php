<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$project_root=$_SERVER['DOCUMENT_ROOT'];
$smarty_dir=$project_root.'/smarty/';

// put full path to Smarty.class.php
require($smarty_dir.'libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$massive=array('first'=>'mary','john','ted');

if (isset($_GET['mobile'])){
    $smarty->assign('header_template','header_mobile');
}
else{
    $smarty->assign('header_template','header');
}

$items_list = array(23 => array('no' => 2456, 'label' => 'Salad'),
    96 => array('no' => 4889, 'label' => 'Cream')
);
$smarty->assign('items', $items_list);

$smarty->assign('title','сайт');
$smarty->assign('names',$massive);
$smarty->assign('name', 'Igor');
$smarty->assign('Contacts',
    array('fax' => '555-222-9876',
        'email' => 'zaphod@slartibartfast.example.com',
        'phone' => array('home' => '555-444-3333',
            'cell' => '555-111-1234')
    )
);
$smarty->assign('cust_options', array(
        1000 => 'Joe Schmoe',
        1001 => 'Jack Smith',
        1002 => 'Jane Johnson',
        1003 => 'Charlie Brown')
);
$smarty->assign('customer_id', 1001);

$smarty->assign('data',array(1,2,3,4,5,6,7,8,9));
$smarty->assign('tr',array('bgcolor="#eeeeee"','bgcolor="#dddddd"'));


$smarty->display('index.tpl');

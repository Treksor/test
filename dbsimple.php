<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$project_root=$_SERVER['DOCUMENT_ROOT'];

## Подключение к БД.
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";

// Подключаемся к БД.
$db = DbSimple_Generic::connect('mysqli://treksor:123@127.0.0.1/treksor_test'); //dns

// Устанавливаем обработчик ошибок.
$db->setErrorHandler('databaseErrorHandler');

$ids = array(1, 101, 303);
$result = $db->select("SELECT * FROM departments WHERE id in(?a)",$ids);
print_r($result);

$row = array('id' => 110, 'name' => 'Фигзнаеткакой');
$db->query('INSERT INTO table(?#) VALUES(?a)', array_keys($row), array_values($row));

// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info)
{
    // Если использовалась @, ничего не делать.
    if (!error_reporting()) return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>";
    print_r($info);
    echo "</pre>";
    exit();
}
?>
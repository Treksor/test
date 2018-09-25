<?
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$news = 'Четыре новосибирские компании вошли в сотню лучших работодателей
Животное, а не водоросль: сибирские учёные нашли скелет у древних организмов в Арктике
Семья из Новосибирска выпустила открытки с апокалиптичными видами города
Квартиры в стильных новостройках продают по цене аренды
Теперь не рухнет: у 30-метровой геодезической вышки заварили опоры
Новосибирским военным устроят проверку
Из-за аварии на Сибиряков-Гвардейцев встали троллейбусы
«Сибирь» проиграла десятую игру подряд
Путин назначил алтайскую судью председателем нового новосибирского суда';
$news = explode("\n", $news);

$count=count($news);
function Listallnews($news){
    foreach ($news as $value){
        echo $value,'<br>';
    }
}

function Listnewsbynumber($news){
    echo $news[$_GET['id']];
}

if (isset($_GET)) {
    if ($_GET['id'] <= $count) {
        Listnewsbynumber($news);
    } else {
        Listallnews($news);
    }
} else {
    header("HTTP/1.0 404 Not Found");
}






?>




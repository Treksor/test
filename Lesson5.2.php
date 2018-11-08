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

function listNewsByNumber($news){
    echo $news[$_POST['id']];
}


//if (isset($_POST['id']) & is_numeric($_GET['id']) & ($_POST['id'] < $count)) {
//    listNewsByNumber($news);
//} else {
//    echo 'Введите в поле номер новости';
//}
if (isset($_POST['id']) & is_numeric($_POST['id']) & ($_POST['id'] < $count)){
    listNewsByNumber($news);}
?>

<html>
<body>

<form method="POST">
    <br>Введите номер новости
    <p>
        <input type="text" name="id" value="">
    </p>
    <p><input type="submit"></p>
</form>

</body>
</html>


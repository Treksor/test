<?
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);
session_start();

$allData = array(Array('clientType' => '',
    'name' => '',
    'mail' => '',
    'check' =>'',
    'phoneNumber' => '',
    'town' => '',
    'category' => '',
    'caption' => '',
    'notes' => '',
    'price' => '',
    'submit' => ''));
$item = array(
    'clientType' => 'private',
    'name' => '',
    'mail' => '',
    'check' =>'on',
    'phoneNumber' => '',
    'town' => '',
    'category' => '',
    'caption' => '',
    'notes' => '',
    'price' => '',
    'submit' => ''
);
$cities = array('Новосибирск','Луна','Параша','Жопа','Нибиру');
$categories=array('Космос','Гавно','Еще гавно','Еще больше гавна');
if (!empty($_GET)){
    if (isset($_GET['delete'])){
        unset($_SESSION['data'][$_GET['delete']]);
        header('location: http:/index.php');
    }
}

if (!empty($_GET)){
    if (isset($_GET['open'])){
        $item=$_SESSION['data'][$_GET['open']];
        header('location: http:/index.php');
    }
}


if (isset($_POST['submit'])){
    $_SESSION['data'][]=$_POST;
}

//if (array_key_exists('unset',$_POST)){
//    unset($_SESSION['data']);
//}

if (array_key_exists('data',$_SESSION) & !empty($_SESSION['data'])){
    $allData=$_SESSION['data'];
//    print_r($allData);
}

//print_r($_SESSION);
print_r($_SESSION); echo '<br><br><br>';
print_r($allData);
//if (isset($_GET['open'])){
//    if (!empty($allData)){
//        foreach ($allData as $key =>$value){

?>

<link rel="stylesheet" type="text/css" href="styles.css">

<form method="POST">
<!--    <p><input type="radio" name="clientType" value="Person" id="Person"--><?php //$item['clientType'] === 'person'? echo 'checked': ''?><!--><label for="Person">Частное лицо</label>-->
        <input type="radio" name="clientType" value="Company" id="Company"><label for="Company">Компания</label>
    <p><label class="left-label" for="name">Ваше имя</label> <input name="name" type="text" id="name" value=<?php echo $item['name'];?>><br>
        <label class="left-label" for="mail">Электронная почта </label><input name="mail" type="email" id="mail" value=<?php echo $item['mail'];?>>
    <p><input type="checkbox" name="check" id="samayaglavnayagalka"> <label for="samayaglavnayagalka">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="tnumber">Номер телефона: </label><input name="phoneNumber" type="text" id="tnumber" value=<?php echo $item['phoneNumber'];?>>
    <p><label class="left-label" for="town">Город</label>
        <select name="town" id="town">
            <?php foreach ($cities as $city){?>
            <option name="town"><?php echo $city;}?></option>
<!--            <option name="town" value="s1">Новосибирск</option>-->
<!--            <option name="town" value="s2">Луна</option>-->
<!--            <option name="town" value="s3">Марс</option>-->
<!--            <option name="town" value="s4">Жопа</option>-->
        </select><br>
        <label class="left-label" for="lulz">Категория</label>
        <select name="category" id="lulz">
            <?php foreach ($categories as $category){?>
            <option name="category"><?php echo $category;}?></option>
<!--            <option name="category" value="s1">Космическое парно</option>-->
<!--            <option name="category" value="s2">Вечное</option>-->
<!--            <option name="category" value="s3">Перекати-поле</option>-->
        </select>
    <p><label class="left-label" for="nazvanieobyavy">Название объявления </label><input name="caption" type="text" id="nazvanieobyavy" value=<?php echo $item['caption'];?>>
    <p><label class="left-label" for="notes">Описание товара</label><textarea name="notes" id="notes" style="resize:none;"><?php echo $item['notes'];?></textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value=<?php echo $item['price'];?>>руб.
    <p><input type="submit" name="submit" value="submit"></p>
<!--    <p><input type="submit" name="unset" value="unset"</p>-->
</form>

<table cellpadding="10px">
    <tr>
        <td>Номер</td>
        <td>Название объявления</td>
        <td>Цена</td>
        <td>Имя</td>
    </tr>
    <?php
    if (array_key_exists('data',$_SESSION) & !empty($_SESSION['data'])){
            foreach ($allData as $key => $value) {
    ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><a href="index.php?open=<?php echo $key;?>"><?php echo $value['caption']; ?></a></td>
                    <td><?php echo $value['price']; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><a href="index.php?delete=<?php echo $key;?>">Удалить</a></td>
                </tr>
    <?php
            }
        }
    ?>
</table>






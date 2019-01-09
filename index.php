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

if (!empty($_GET)){
    if (isset($_GET['delete'])){
        unset($_SESSION['data'][$_GET['delete']]);
        header('location: http:/index.php');
    }
}

if (isset($_POST['submit'])){
    $_SESSION['data'][]=$_POST;
}

if (array_key_exists('unset',$_POST)){
    unset($_SESSION['data']);
}

if (array_key_exists('data',$_SESSION) & !empty($_SESSION['data'])){
    $allData=$_SESSION['data'];
//    print_r($allData);
}
//echo '<br><br>';
//print_r($_GET);
//echo '<br><br>';
//print_r($_SESSION);
print_r($_SESSION); echo '<br><br><br>';
print_r($allData);
//if (isset($_GET['open'])){
//    if (!empty($allData)){
//        foreach ($allData as $key =>$value){

?>

<link rel="stylesheet" type="text/css" href="styles.css">

<form method="POST">
    <p><input type="radio" name="clientType" value="Person" id="Person"><label for="Person">Частное лицо</label>
        <input type="radio" name="clientType" value="Company" id="Company"><label for="Company">Компания</label>
    <p><label class="left-label" for="name">Ваше имя</label> <input name="name" type="text" id="name"><br>
        <label class="left-label" for="mail">Электронная почта </label><input name="mail" type="email" id="mail">
    <p><input type="checkbox" name="check" id="samayaglavnayagalka"> <label for="samayaglavnayagalka">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="tnumber">Номер телефона: </label><input name="phoneNumber" type="text" id="tnumber">
    <p><label class="left-label" for="town">Город</label>
        <select name="town" id="town">
            <option name="town">Выбери место жительства</option>
            <option name="town" value="s1">Новосибирск</option>
            <option name="town" value="s2">Луна</option>
            <option name="town" value="s3">Марс</option>
            <option name="town" value="s4">Жопа</option>
        </select><br>
        <label class="left-label" for="lulz">Категория</label>
        <select name="category" id="lulz">
            <option name="category">Выбери что-нибудь</option>
            <option name="category" value="s1">Космическое парно</option>
            <option name="category" value="s2">Вечное</option>
            <option name="category" value="s3">Перекати-поле</option>
        </select>
    <p><label class="left-label" for="nazvanieobyavy">Название объявления </label><input name="caption" type="text" id="nazvanieobyavy">
    <p><label class="left-label" for="notes">Описание товара</label><textarea name="notes" id="notes" style="resize:none;"></textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" value="0" size="5" id="price">руб.
    <p><input type="submit" name="submit" value="submit"></p>
    <p><input type="submit" name="unset" value="unset"</p>
</form>
<?php //}}}?>

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






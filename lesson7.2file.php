<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);


//$allData = array(Array('clientType' => '',
//    'name' => '',
//    'mail' => '',
//    'check' =>'',
//    'phoneNumber' => '',
//    'town' => '',
//    'category' => '',
//    'caption' => '',
//    'notes' => '',
//    'price' => '',
//    'submit' => ''));
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

//print_r($_SESSION); echo '<br><br><br>';
//print_r($allData); echo '<br><br><br>';
////print_r($item); echo '<br><br><br>';
//print_r($_COOKIE);echo '<br><br><br>';



?>

<link rel="stylesheet" type="text/css" href="styles.css">

<form method="POST">
    <input type="hidden" name="id" value=<?php echo $item['id']; ?>>
    <p><input type="radio" name="clientType" value="Person" id="Person"<?php if ($item['clientType'] === 'Person'){ echo 'checked'; }?>><label for="Person">Частное лицо</label>
        <input type="radio" name="clientType" value="Company" id="Company"<?php if ($item['clientType'] === 'Company'){ echo 'checked';} ?>><label for="Company">Компания</label>
    <p><label class="left-label" for="name">Ваше имя</label> <input name="name" type="text" id="name" value="<?php echo $item['name'];?>"><br>
        <label class="left-label" for="mail">Электронная почта </label><input name="mail" type="email" id="mail" value="<?php echo $item['mail'];?>">
    <p><input type="checkbox" name="check" id="samayaglavnayagalka" <?php if ($item['check'] === 'on'){ echo 'checked';}?>> <label for="samayaglavnayagalka">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="tnumber">Номер телефона: </label><input name="phoneNumber" type="text" id="tnumber" value="<?php echo $item['phoneNumber'];?>">
    <p><label class="left-label" for="town">Город</label>
        <select name="town" id="town">
            <?php foreach ($cities as $city){?>
            <option name="town" <?php if ($item['town']==$city){ ?> selected<?php } ?>><?php echo $city;}?></option>

        </select><br>
        <label class="left-label" for="lulz">Категория</label>
        <select name="category" id="lulz">
            <?php foreach ($categories as $category){?>
            <option name="category" <?php if ($item['category']==$category){ ?> selected <?php } ?> ><?php  echo $category;}?></option>

        </select>
    <p><label class="left-label" for="nazvanieobyavy">Название объявления </label><input name="caption" type="text" id="nazvanieobyavy" value="<?php echo $item['caption'];?>">
    <p><label class="left-label" for="notes">Описание товара</label><textarea name="notes" id="notes" style="resize:none;"><?php echo $item['notes'];?></textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value="<?php echo $item['price'];?>">руб.
    <p><input type="submit" name="submit" value="submit">
</form>

<table cellpadding="10px">
    <tr>
        <td>Номер</td>
        <td>Название объявления</td>
        <td>Цена</td>
        <td>Имя</td>
    </tr>
    <?php
    if (!empty($allData)){
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






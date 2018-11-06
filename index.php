<?
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);



?>

<form method="POST">
    <p><input type="radio" name="answer" value="Person" id="Person"><label for="Person">Частное лицо</label>
        <input type="radio" name="answer" value="Company" id="Company"><label for="Company">Компания</label>
    <p><label for="name">Ваше имя</label> <input type="text" id="name"><br>
        <label for="mail">Электронная почта </label><input type="email" id="mail">
    <p><input type="checkbox" id="samayaglavnayagalka"> <label for="samayaglavnayagalka">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label for="tnumber">Номер телефона: </label><input type="text" id="tnumber">
    <p><label for="town">Город</label>
    <select name="select" id="town">
        <option selected value="s1">Новосибирск</option>
        <option value="s2">Луна</option>
        <option value="s3">Марс</option>
        <option value="s4">Жопа</option>
    </select><br>
        <label for="lulz">Категория</label>
    <select name="select" id="lulz">
        <option selected value="s1">Религию нужно искоренить</option>
        <option value="s2">Космическое парно</option>
        <option value="s3">Вечное</option>
        <option value="s4">Перекати-поле</option>
    </select>
    <p><label for="nazvanieobyavy">Название объявления </label><input type="text" id="nazvanieobyavy">
    <p><label for="notes" style="float:left; margin-right: 10px;">Описание товара</label><textarea id="notes" style="resize:none;"></textarea>
    <p><label for="price">Цена <input type="text" value="0" size="5" id="price">руб.
    <p><input type="submit"></p>
</form>



<?
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);



?>

<form method="POST">
    <p><input type="radio" name="answer" value="Person">Частное лицо
        <input type="radio" name="answer" value="Company">Компания
    <p>Ваше имя: <input type="text"><br>
        Электронная почта: <input type="email">
    <p><input type="checkbox"> Я не хочу получать вопросы по объявлению по e-mail
    <p>Номер телефона: <input type="text">
    <p>Город
    <select name="select">
        <option selected value="s1">Новосибирск</option>
        <option value="s2">Луна</option>
        <option value="s3">Марс</option>
        <option value="s4">Жопа</option>
    </select><br>
    Категория
    <select name="select">
        <option selected value="s1">Религию нужно искоренить</option>
        <option value="s2">Космическое парно</option>
        <option value="s3">Вечное</option>
        <option value="s4">Перекати-поле</option>
    </select>
    <p>Название объявления<input type="text">
    <p>Описание объявления: <textarea style="resize: none;" rows="10" cols="50" ></textarea>
    <p>Цена <input type="text" value="0" size="5">руб.
    <p><input type="submit"></p>
</form>



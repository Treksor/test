{include file='header.tpl'}

<link rel="stylesheet" type="text/css" href=styles.css>
<form method="POST">
    <input type="hidden" name="id" value={$item.id}>
    {html_radios name="clientType" options=$clientType selected=$item.clientType}
    <br>
    <p><label class="left-label" for="name">Ваше имя</label> <input name="name" type="text" id="name" value={$item.name}>
        <br>
        <label class="left-label" for="mail">Электронная почта </label><input name="mail" type="email" id="mail" value="{$item.mail}">
    <p><input type="checkbox" name="check" id="samayaglavnayagalka" {if $item.check==='on'}checked{/if}> <label for="samayaglavnayagalka">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="tnumber">Номер телефона: </label><input name="phoneNumber" type="text" id="tnumber" value={$item.phoneNumber}>
    <p><label class="left-label" for="town">Город</label>
    <p>{html_options name=town options=$town selected=$item.town}
    <p><label class="left-label" for="lulz">Категория</label>
    <p>{html_options name=category options=$category selected=$item.category}

    <p><label class="left-label" for="nazvanieobyavy">Название объявления </label><input name="caption" type="text" id="nazvanieobyavy" value={$item.caption}>
    <p><label class="left-label" for="notes">Описание товара</label><textarea name="notes" id="notes" style="resize:none;">{$item.notes}</textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value={$item.price}>руб.
    <p><input type="submit" name="submit" value="submit">
</form>



<table cellpadding="10px">
    <tr>
        <td>Номер</td>
        <td>Название объявления</td>
        <td>Цена</td>
        <td>Имя</td>
    </tr>
    {if !empty($data)}
        {foreach from=$data key=id item=i}
            <tr>
                <td>{$id+1}</td>
                <td><a href="../index.php?open={$id}">{$i.caption}</a></td>
                <td>{$i.price}</td>
                <td>{$i.name}</td>
                <td><a href="../index.php?delete={$id}">Удалить</a></td>
            </tr>
        {/foreach}
    {/if}
</table>


{*separator="<br />"}*}

{*<ul>*}
    {*{foreach from=$items key=myId item=i}*}
        {*<li><a href="item.php?id={$myId}">{$i.no}: {$i.label}</a></li>*}
    {*{/foreach}*}
{*</ul>*}

{*{html_options name=customer_id options=$cust_options selected=$customer_id}*}
{*<br>*}
{*{html_table loop=$data}*}
{*{html_table loop=$data cols=4 table_attr='border="0"'}*}


{include file='footer.tpl'}
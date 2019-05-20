{include file='header.tpl'}

<link rel="stylesheet" type="text/css" href=styles.css>
<form method="POST">
    <input type="hidden" name="id" value="{$item.id}">
    {html_radios name="status" options=$status selected=$item.status}
    <br>
    <p><label class="left-label" for="user_name">Ваше имя</label> <input name="user_name" type="text" id="user_name" value="{$item.name}">
        <br>
        <label class="left-label" for="user_email">Электронная почта </label><input name="user_email" type="email" id="user_email" value="{$item.mail}">
    <p><input type="checkbox" name="check" id="check" {if $item.check==='on'}checked{/if}> <label for="check">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="phone_number">Номер телефона: </label><input name="phone_number" type="text" id="phone_number" value="{$item.phoneNumber}">
    <p><label class="left-label" for="city">Город</label>
    <p>{html_options name=town options=$town selected=$item.town}
    <p><label class="left-label" for="category">Категория</label>
    <p>{html_options name=category options=$category selected=$item.category}

    <p><label class="left-label" for="add_name">Название объявления </label><input name="add_name" type="text" id="add_name" value="{$item.caption}">
    <p><label class="left-label" for="add_description">Описание товара</label><textarea name="add_description" id="add_description" style="resize:none;">{$item.notes}</textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value="{$item.price}">руб.
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
{include file='header.tpl'}

<link rel="stylesheet" type="text/css" href=styles.css>
<form method="POST" action="../index.php">
    <input type="hidden" name="id" value="{$item->id}">
    {html_radios name="status" options=$status selected=$item->status}
    <br>
    <p><label class="left-label" for="user_name">Ваше имя</label> <input name="user_name" type="text" id="user_name" value="{$item->user_name|escape:'UTF-8':'htmlall'}">
        <br>
        <label class="left-label" for="user_email">Электронная почта </label><input name="user_email" type="email" id="user_email" value="{$item->user_email}">
    <p><input type="checkbox" name="checkbox" id="checkbox" {if $item->checkbox===1}checked{/if}> <label for="checkbox">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="phone_number">Номер телефона: </label><input name="phone_number" type="text" id="phone_number" value="{$item->phone_number}">
    <p><label class="left-label" for="city">Город</label>
    <p>{html_options name=city options=$city selected=$item->city}
    <p><label class="left-label" for="category">Категория</label>
    <p>{html_options name=category options=$category selected=$item->category}

    <p><label class="left-label" for="add_name">Название объявления </label><input name="add_name" type="text" required  id="add_name" value="{$item->add_name|escape:'UTF-8':'htmlall'}">
    <p><label class="left-label" for="add_description">Описание товара</label><textarea name="add_description" id="add_description" style="resize:none;">{$item->add_description|escape:'UTF-8':'htmlall'}</textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value="{$item->price}">руб.
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
                <td><a href="../index.php?open={$id}">{$i->add_name|escape:'UTF-8':'htmlall'}</a></td>
                <td>{$i->price}</td>
                <td>{$i->user_name|escape:'UTF-8':'htmlall'}</td>
                <td><a href="../index.php?delete={$id}">Удалить</a></td>
            </tr>
        {/foreach}
    {/if}
</table>



{include file='footer.tpl'}
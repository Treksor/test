{include file='headerB.tpl'}
<div class="row border">
<div class="col-4 border">
<form class="form-horizontal" method="POST" action="../index.php?action=submit">
    <input type="hidden" name="id" value="{$item->id}">
    <input type="hidden" name="checkbox" value="0">
    <div class="form-group ml-3" id="container"></div>

    <div class="form-group ml-3">
        {*<div class="form-check-inline">*}
            {*<input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Person" checked>*}
            {*<label for="exampleRadios1" class="form-check-label">*}
                {*Частное лицо*}
            {*</label>*}
        {*</div>*}
        {*<div class="form-check-inline ml-5">*}
            {*<input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Company">*}
            {*<label for="exampleRadios2" class="form-check-label">*}
                {*Компания*}
            {*</label>*}
        {*</div>*}
        {html_radios name="status" options=$status selected=$item->status separator="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"}
    </div>

    <div class="form-group row">
        <div class="col-3 ml-3">
            <label for="user_name" class="col-form-label">Ваше имя</label>
        </div>
        <div class="col-6 ml-3">
            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="name" value="{$item->user_name|escape:'UTF-8':'htmlall'}">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3 ml-3">
            <label for="user_email" class="col-form-label">Email address</label>
        </div>
        <div class="col-6 ml-3">
            <input type="email" class="form-control" name="user_email" id="user_email" placeholder="name@example.com" value="{$item->user_email}">
        </div>
    </div>

    <div class="form-check ml-3">
        <input class="form-check-input" type="checkbox" value="1" name="checkbox" id="checkbox" {if $item->checkbox==1}checked{/if}>
        <label class="form-check-label" for="checkbox">
            Я не хочу получать вопросы по объявлению по e-mail
        </label>
    </div>

    <div class="form-group row mt-3">
        <div class="col-3 ml-3">
            <label for="phone_number" class="col-form-label">Номер телефона</label>
        </div>
        <div class="col-6 ml-3">
            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{$item->phone_number}">
        </div>
    </div>

    <div class="form-group row mt-3">
        <div class="col-3 ml-3">
            <label class="col-form-label" for="city">Город</label>
        </div>
        <div class="col-6 ml-3">
            {html_options class="form-control" name=city options=$city selected=$item->city}
        </div>
    </div>

    <div class="form-group row mt-3">
        <div class="col-3 ml-3">
            <label class="col-form-label" for="category">Категория</label>
        </div>
        <div class="col-6 ml-3">
            {html_options class="form-control" name=category options=$category selected=$item->category}
        </div>
    </div>

    <div class="form-group row mt-3">
        <div class="col-3 ml-3">
            <label for="add_name" class="col-form-label">Название объявления</label>
        </div>
        <div class="col-6 ml-3">
            <input type="text" class="form-control mt-3" name="add_name" id="add_name" value="{$item->add_name|escape:'UTF-8':'htmlall'}">
        </div>
    </div>


    <div class="form-group row">
        <div class="col-3 ml-3">
            <label class="col-form-label mt-3" for="add_description">Описание товара</label>
        </div>
        <div class="col-6 ml-3">
            <textarea class="form-control " name="add_description" id="add_description" rows="3" style="resize:none">{$item->add_description|escape:'UTF-8':'htmlall'}</textarea>
        </div>
    </div>

    <div class="form-group row mt-3">
        <div class="col-3 ml-3">
            <label for="price" class="col-form-label">Цена</label>
        </div>
        <div class="col-6 ml-3">
            <input type="text" class="form-control" name="price" id="price" value="{$item->price}">
        </div>
    </div>

    <div class="form-group ml-4">
        <button type="submit" name="submit" class="btn btn-primary col-9">Готово</button>
    </div>
</form>
</div>
<div class="col-7 border">
{include file="table.tpl"}
</div>
</div>

{include file='footerB.tpl'}

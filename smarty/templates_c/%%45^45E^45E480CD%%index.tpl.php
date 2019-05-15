<?php /* Smarty version 2.6.31, created on 2019-05-15 12:25:19
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'index.tpl', 6, false),array('function', 'html_options', 'index.tpl', 14, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link rel="stylesheet" type="text/css" href=styles.css>
<form method="POST">
    <input type="hidden" name="id" value=<?php echo $this->_tpl_vars['item']['id']; ?>
>
    <?php echo smarty_function_html_radios(array('name' => 'clientType','options' => $this->_tpl_vars['clientType'],'selected' => $this->_tpl_vars['item']['clientType']), $this);?>

    <br>
    <p><label class="left-label" for="name">Ваше имя</label> <input name="name" type="text" id="name" value=<?php echo $this->_tpl_vars['item']['name']; ?>
>
        <br>
        <label class="left-label" for="mail">Электронная почта </label><input name="mail" type="email" id="mail" value="<?php echo $this->_tpl_vars['item']['mail']; ?>
">
    <p><input type="checkbox" name="check" id="samayaglavnayagalka" <?php if ($this->_tpl_vars['item']['check'] === 'on'): ?>checked<?php endif; ?>> <label for="samayaglavnayagalka">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="tnumber">Номер телефона: </label><input name="phoneNumber" type="text" id="tnumber" value=<?php echo $this->_tpl_vars['item']['phoneNumber']; ?>
>
    <p><label class="left-label" for="town">Город</label>
    <p><?php echo smarty_function_html_options(array('name' => 'town','options' => $this->_tpl_vars['town'],'selected' => $this->_tpl_vars['item']['town']), $this);?>

    <p><label class="left-label" for="lulz">Категория</label>
    <p><?php echo smarty_function_html_options(array('name' => 'category','options' => $this->_tpl_vars['category'],'selected' => $this->_tpl_vars['item']['category']), $this);?>


    <p><label class="left-label" for="nazvanieobyavy">Название объявления </label><input name="caption" type="text" id="nazvanieobyavy" value=<?php echo $this->_tpl_vars['item']['caption']; ?>
>
    <p><label class="left-label" for="notes">Описание товара</label><textarea name="notes" id="notes" style="resize:none;"><?php echo $this->_tpl_vars['item']['notes']; ?>
</textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value=<?php echo $this->_tpl_vars['item']['price']; ?>
>руб.
    <p><input type="submit" name="submit" value="submit">
</form>



<table cellpadding="10px">
    <tr>
        <td>Номер</td>
        <td>Название объявления</td>
        <td>Цена</td>
        <td>Имя</td>
    </tr>
    <?php if (! empty ( $this->_tpl_vars['data'] )): ?>
        <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['i']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['id']+1; ?>
</td>
                <td><a href="../index.php?open=<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['i']['caption']; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['i']['price']; ?>
</td>
                <td><?php echo $this->_tpl_vars['i']['name']; ?>
</td>
                <td><a href="../index.php?delete=<?php echo $this->_tpl_vars['id']; ?>
">Удалить</a></td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
</table>



                


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php /* Smarty version 2.6.31, created on 2019-06-28 09:22:15
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'index.tpl', 7, false),array('function', 'html_options', 'index.tpl', 15, false),array('modifier', 'escape', 'index.tpl', 9, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link rel="stylesheet" type="text/css" href=styles.css>
<form method="POST" action="../index.php">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['item']->id; ?>
">
    <input type="hidden" name="checkbox" value="0">
    <?php echo smarty_function_html_radios(array('name' => 'status','options' => $this->_tpl_vars['status'],'selected' => $this->_tpl_vars['item']->status), $this);?>

    <br>
    <p><label class="left-label" for="user_name">Ваше имя</label> <input name="user_name" type="text" id="user_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']->user_name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'UTF-8', 'htmlall') : smarty_modifier_escape($_tmp, 'UTF-8', 'htmlall')); ?>
">
        <br>
        <label class="left-label" for="user_email">Электронная почта </label><input name="user_email" type="email" id="user_email" value="<?php echo $this->_tpl_vars['item']->user_email; ?>
">
    <p><input type="checkbox" name="checkbox" id="checkbox" <?php if ($this->_tpl_vars['item']->checkbox === 1): ?>checked<?php endif; ?>> <label for="checkbox">Я не хочу получать вопросы по объявлению по e-mail</label>
    <p><label class="left-label" for="phone_number">Номер телефона: </label><input name="phone_number" type="text" id="phone_number" value="<?php echo $this->_tpl_vars['item']->phone_number; ?>
">
    <p><label class="left-label" for="city">Город</label>
    <p><?php echo smarty_function_html_options(array('name' => 'city','options' => $this->_tpl_vars['city'],'selected' => $this->_tpl_vars['item']->city), $this);?>

    <p><label class="left-label" for="category">Категория</label>
    <p><?php echo smarty_function_html_options(array('name' => 'category','options' => $this->_tpl_vars['category'],'selected' => $this->_tpl_vars['item']->category), $this);?>


    <p><label class="left-label" for="add_name">Название объявления </label><input name="add_name" type="text" required  id="add_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']->add_name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'UTF-8', 'htmlall') : smarty_modifier_escape($_tmp, 'UTF-8', 'htmlall')); ?>
">
    <p><label class="left-label" for="add_description">Описание товара</label><textarea name="add_description" id="add_description" style="resize:none;"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']->add_description)) ? $this->_run_mod_handler('escape', true, $_tmp, 'UTF-8', 'htmlall') : smarty_modifier_escape($_tmp, 'UTF-8', 'htmlall')); ?>
</textarea>
    <p><label class="left-label" for="price">Цена </label><input name="price" type="text" size="5" id="price" value="<?php echo $this->_tpl_vars['item']->price; ?>
">руб.
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
"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']->add_name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'UTF-8', 'htmlall') : smarty_modifier_escape($_tmp, 'UTF-8', 'htmlall')); ?>
</a></td>
                <td><?php echo $this->_tpl_vars['i']->price; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['i']->user_name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'UTF-8', 'htmlall') : smarty_modifier_escape($_tmp, 'UTF-8', 'htmlall')); ?>
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
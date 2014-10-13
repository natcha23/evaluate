<?php /* Smarty version 2.6.19, created on 2014-08-22 15:46:30
         compiled from mtmenu/display.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'add_script', 'mtmenu/display.tpl', 54, false),)), $this); ?>
<?php if (! $this->_tpl_vars['_isAjax']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form name="<?php echo $this->_tpl_vars['name']; ?>
_form" id="<?php echo $this->_tpl_vars['name']; ?>
_form" action="<?php echo $this->_tpl_vars['base_url']; ?>
" method="post" enctype="application/x-www-form-urlencoded" class="form-check" style="margin: 0px;">
    <div id="<?php echo $this->_tpl_vars['name']; ?>
_container">
<?php $_from = $this->_tpl_vars['lbl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['v1']):
?>
    <input type="hidden" id="lbl_<?php echo $this->_tpl_vars['k1']; ?>
" value="<?php echo $this->_tpl_vars['v1']; ?>
">
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" >
    <tbody>
        <tr>
            <td  height="38" class="titlehead">&nbsp;&nbsp;Menu Authen</td>
        </tr>
        <tr>
            <td >
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['_template'])."/mtmenu/_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </td>
        </tr>
    </tbody>
</table>
<?php if (! $this->_tpl_vars['_isAjax']): ?>
    </div>
</form>
<?php echo '
<script type="text/javascript" language="javascript">
/*$(document).ready(function(){
    $("#btn_new").removeAttr("onclick").click(function(){
        app.gotoview("/master/mtmenu/form/_m/new");
    });
    $("img[@id=img-minimize]").click(function(){
        $($(this).parents("table").get(0))
        .find(\'div#content-container\')
        .slideToggle("slow", function() {
            var _img = $($(this).parents("table").get(0)).find("img#img-minimize").get(0);
            var _flag = _img.src.split("/").pop().split(".")[0];
            if(_flag=="up") _img.src = _img.src.replace("up","down");
            else _img.src = _img.src.replace("down","up")
        });
    });
});
 $(document).ajaxComplete(function(){
     $("#btn_new").removeAttr("onclick").click(function(){
         app.gotoview("/master/mtmenu/form/_m/new");
    });
 });*/
function editmenu(code){
   app.gotoview("/master/mtmenu/form/_m/edit/code/"+code);
}
function viewmenu(code){
   app.gotoview("/master/mtmenu/form/_m/view/code/"+code);
}
</script>
'; ?>

<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('js' => ($this->_tpl_vars['_js'])."/menu.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php /* Smarty version 2.6.19, created on 2014-08-21 17:41:15
         compiled from menu/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'menu/form.tpl', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef">
    <tbody>
        <tr>
			<td colspan="4" align="center">
				 <table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					   <tr >
					        <td height="38" class="titlehead">&nbsp;<?php if ($this->_tpl_vars['mode'] == 'edit'): ?>Edit<?php else: ?>New<?php endif; ?> Menu</td>
				       </tr>
				 </table>
	        </td>
		</tr>
        <tr>
            <td colspan="4" style="background: #efefef; padding: 5px; padding-top: 0px;border: none; ">
                <div id="content-container" style="margin: 0px;padding: 0px;">
                <form name="" id="" method="post"
                    <?php if ($this->_tpl_vars['mode'] == 'edit'): ?>
                	action="/<?php echo $this->_tpl_vars['projectName']; ?>
/master/menu/edit/id/<?php echo $this->_tpl_vars['id']; ?>
/mod/<?php echo $this->_tpl_vars['mod']; ?>
/type/<?php echo $this->_tpl_vars['_params']['type']; ?>
"
                	<?php else: ?>
                	action="/<?php echo $this->_tpl_vars['projectName']; ?>
/master/menu/add/id/<?php echo $this->_tpl_vars['id']; ?>
/mod/<?php echo $this->_tpl_vars['mod']; ?>
/type/<?php echo $this->_tpl_vars['_params']['type']; ?>
"
                	<?php endif; ?>
                	>
                <table cellpadding="0" cellspacing="0" border="0" class="tbl" style="background-color: transparent;">
                    <tbody>
                        <tr><td colspan="3">&nbsp;</td></tr>
                		<tr>
                            <td></td>
                			<td>
                                <b>Menu name(TH): </b><input type="text" name="section[section_name]" value="<?php echo $this->_tpl_vars['section']['section_name']; ?>
" />
                                <!--b>Menu name(EN): </b><input type="text" name="section[section_name][EN]" value="<?php echo $this->_tpl_vars['section']['section_name']['EN']; ?>
" /-->
                			    <b>Link : </b><input type="text" name="section[section_link]" value="<?php echo $this->_tpl_vars['section']['section_link']; ?>
" />
                                <input type="submit" id="btn_save" class="btn_tools" name="btn_save" value="<?php echo ((is_array($_tmp='save')) ? $this->_run_mod_handler('translate', true, $_tmp) : $this->_plugins['modifier']['translate'][0][0]->modifierTranslate($_tmp)); ?>
"/>
                                <input type="reset" id="btn_cancel" class="btn_tools" name="btn_reset" value="Reset"/>
                			</td>
                		</tr>
                	</tbody>
                </table>
                </form>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
            <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
                <tbody>
                    <tr>
                        <td width="12"><img width="12" height="19" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuleft.gif"/></td>
                        <td>&nbsp;</td>
                        <td width="12"><img width="12" height="19" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuright.gif"/></td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </tbody>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu/_list.tpl", 'smarty_include_vars' => array('menus' => $this->_tpl_vars['menus'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php /* Smarty version 2.6.19, created on 2014-08-21 17:43:27
         compiled from mtmenu/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'add_script', 'mtmenu/form.tpl', 62, false),)), $this); ?>
<?php ob_start(); ?>
	<table width="100%"	>
		<tr>
			<td align="right">
 				<?php if (! $this->_tpl_vars['readonly']): ?>
    				<input type="button" class="btn_tools" id="btn_save" value="Save" onclick="checkSaveMenuAuth('<?php echo $this->_tpl_vars['mode']; ?>
');">
    			<?php endif; ?>
					<input id="btn_back" title="Back" class="btn_tools" onclick="app.gotoview('/master/mtmenu/display');" value=" Back " type="button">
            </td>
	</tr>
</table>
<?php $this->_smarty_vars['capture']['toolbar'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form method="post" action="<?php echo $this->_tpl_vars['app_url']; ?>
master/mtmenu/save/_m/<?php echo $this->_tpl_vars['mode']; ?>
" id="my_form" enctype="multipart/form-data">
	<?php $_from = $this->_tpl_vars['lbl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['v1']):
?>
	    <input type="hidden" id="lbl_<?php echo $this->_tpl_vars['k1']; ?>
" value="<?php echo $this->_tpl_vars['v1']; ?>
">
	<?php endforeach; endif; unset($_from); ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="white">
		<tr colspan="2">
            <td class="titlehead" colspan="2">&nbsp;Menu Authen</td>
        </tr>
        <tr>
    			<td bgcolor="#EBEBEB">
    				<?php echo $this->_smarty_vars['capture']['toolbar']; ?>

    			</td>
    		</tr>
		<tr height="50">
		    <td align="left" " colspan="2">
		    	&nbsp;&nbsp;&nbsp;
		    	<b>Code Menu Type :</b> <input type="text" value="<?php echo $this->_tpl_vars['look_menu']['lookup_code']; ?>
" id="lookup_code" <?php echo $this->_tpl_vars['readonly']; ?>
 class="<?php echo $this->_tpl_vars['readonly']; ?>
" name="lookup_code" size="10" <?php if ($this->_tpl_vars['mode'] == 'edit'): ?>readonly="readonly"<?php endif; ?>>
		    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    	<b>Name Menu Type :</b> <input type="text" value="<?php echo $this->_tpl_vars['look_menu']['lookup_name']; ?>
" id="lookup_name" <?php echo $this->_tpl_vars['readonly']; ?>
 class="<?php echo $this->_tpl_vars['readonly']; ?>
" name="lookup_name" size="50" <?php if ($this->_tpl_vars['mode'] == 'edit'): ?>readonly="readonly"<?php endif; ?>>
		    </td>
		</tr>
		<tr>
		    <td colspan="2">
		    	<?php echo $this->_tpl_vars['MenuTree']; ?>

		    </td>
		</tr>
		<tr>
	    	<td bgcolor="#EBEBEB">
	    		<?php echo $this->_smarty_vars['capture']['toolbar']; ?>

	    	</td>
    	</tr>
    	<tr align="right">
			<td colspan="2">
				<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
			    	<tbody>
			        	<tr align="right">
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
	</table>
</form>

<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/menu.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
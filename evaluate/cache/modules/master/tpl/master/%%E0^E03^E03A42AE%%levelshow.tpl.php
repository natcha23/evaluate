<?php /* Smarty version 2.6.19, created on 2014-09-02 16:24:50
         compiled from levelshow.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'levelshow.tpl', 29, false),array('function', 'cycle', 'levelshow.tpl', 35, false),array('function', 'add_script', 'levelshow.tpl', 71, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_grade" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;<?php echo $this->_tpl_vars['headPage']; ?>
</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="5%"> No. </td>
				    				<td class="font11b" align="center" width="25%"> ระดับ Level </td>
				    				<?php $_from = $this->_tpl_vars['grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['grd']):
?>
				    				<td class="font11b" align="center" width="13%" nowrap>
				    					<?php echo $this->_tpl_vars['grd']['grade']; ?>
<br><?php echo ((is_array($_tmp=$this->_tpl_vars['grd']['start_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['grd']['end_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>

				    				</td>
				    				<?php endforeach; endif; unset($_from); ?>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" id="tr_<?php echo $this->_tpl_vars['item']['gr_id']; ?>
">
				    				<td align="center" class="font12"><?php echo $this->_tpl_vars['loopH']; ?>
.</td>
				    				<td align="left" class="font12" >&nbsp;<?php echo $this->_tpl_vars['item']['lv_code']; ?>
 : <?php echo $this->_tpl_vars['item']['lv_shotname']; ?>
</td>
				    				<?php $_from = $this->_tpl_vars['grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['grd']):
?>
				    				<?php $this->assign('_grade', $this->_tpl_vars['grd']['grade']); ?>
				    				<td class="font12" align="right" ><?php echo ((is_array($_tmp=$this->_tpl_vars['rows'][$this->_tpl_vars['key']][$this->_tpl_vars['_grade']]['money'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
&nbsp;&nbsp;</td>
				    				<?php endforeach; endif; unset($_from); ?>
				    			</tr <?php echo $this->_tpl_vars['loopH']++; ?>
>
					    		<?php endforeach; endif; unset($_from); ?>
				    		</table>
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
			        <tr>
			            <td colspan="2">&nbsp;</td>
			        </tr>
			      </table>
			   </td>
	        <!-- end detail-->
	      	</tr>
    	</table>
    </td>
  </tr>
</table>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/master.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
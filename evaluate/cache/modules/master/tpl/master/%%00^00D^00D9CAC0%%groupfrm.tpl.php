<?php /* Smarty version 2.6.19, created on 2014-08-21 16:34:16
         compiled from groupfrm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'add_script', 'groupfrm.tpl', 96, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_groupfrm" enctype="multipart/form-data">
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
				    			<tr bgcolor="#EBEBEB">
									<td align="right" >
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitGroup();" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/master/group');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" >
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="<?php echo $this->_tpl_vars['mode']; ?>
">
										<input type="hidden" name="fields[l_id]" value="<?php echo $this->_tpl_vars['rows']['l_id']; ?>
" >
									</td>
								</tr>
								<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ชื่อย่อ Group</td>
										    	<td class="font12"><input type="text" name="fields[l_shotname]" id="l_shotname" value="<?php echo $this->_tpl_vars['rows']['l_shotname']; ?>
" class="textfield_3c" maxLength="10"></td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ชื่อเต็ม Group</td>
										    	<td class="font12"><input type="text" name="fields[l_fullname]" id="l_fullname" value="<?php echo $this->_tpl_vars['rows']['l_fullname']; ?>
" class="textfield_10c" ></td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">หมายเหตุ</td>
										    	<td class="font12"><textarea name="fields[g_desc]" id="g_desc" rows="5" class="textfield_10c"><?php echo $this->_tpl_vars['rows']['g_desc']; ?>
</textarea></td>
									    	</tr>
                                            <tr>
                                                <td width="2%">&nbsp;</td>
                                                <td align="left" width="15%" class="font11b">Order by</td>
                                                <td class="font12"><input type="text" name="fields[l_order]" id="l_order" value="<?php echo $this->_tpl_vars['rows']['l_order']; ?>
" class="textfield_3c" onKeyup="ckvNum(this);" maxLength="2"></td>
                                            </tr>

									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td align="right" >
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitGroup();" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/master/group');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    		</table>
				    	</td>
				    </tr>
			        <tr align="right">
							<td colspan="2">
								<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
							    	<tbody>
							        	<tr align="right">
							            	<td width="12"><img width="12" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuleft.gif"/></td>
							                <td>&nbsp;</td>
							                <td width="12"><img width="12" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuright.gif"/></td>
							            </tr>
							        </tbody>
				 	            </table>
					        </td>
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
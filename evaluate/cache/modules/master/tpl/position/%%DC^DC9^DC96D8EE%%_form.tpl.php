<?php /* Smarty version 2.6.19, created on 2014-09-02 15:54:28
         compiled from position/_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'position/_form.tpl', 69, false),array('function', 'add_script', 'position/_form.tpl', 117, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_mstform" enctype="multipart/form-data">
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
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="submitForm('<?php echo $this->_tpl_vars['mode']; ?>
');" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/position/display');" value=" Back " type="button">
											&nbsp;
										</td>
									</tr>
									<tr >
										<td align="left" >
											<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >

										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Position Code</td>
													<td class="font12">
														<input type="text" name="fields[org_position_code]" id="org_position_code" <?php if ($this->_tpl_vars['maxId']): ?> value="<?php echo $this->_tpl_vars['maxId']; ?>
" readonly<?php else: ?> readonly value="<?php echo $this->_tpl_vars['rows']['org_position_code']; ?>
"<?php endif; ?> class="textfield_2c" onKeyup="ckvNum(this);">
														<input type="hidden" name="org_poscode_old" value="<?php echo $this->_tpl_vars['rows']['org_position_code']; ?>
" class="textfield_2c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Position Name TH</td>
													<td class="font12">
														<input type="text" name="fields[org_position_name_th]" id="org_position_name_th" value="<?php echo $this->_tpl_vars['rows']['org_position_name_th']; ?>
" class="textfield_7c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Position Name EN</td>
													<td class="font12">
														<input type="text" name="fields[org_position_name_en]" id="org_position_name_en" value="<?php echo $this->_tpl_vars['rows']['org_position_name_en']; ?>
" class="textfield_7c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Position Level</td>
													<td class="font12">
														<input type="text" name="fields[org_position_level]" id="org_position_level" value="<?php echo $this->_tpl_vars['rows']['org_position_level']; ?>
" onKeyup="ckvNum(this);" class="textfield_2c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Status</td>
													<td class="font12">
														<select name="fields[org_position_status]" id="org_position_status" class="selectBox3cm" >
															<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statusOp'],'selected' => $this->_tpl_vars['rows']['org_position_status']), $this);?>

														</select>
													</td>
										    	</tr>
										   </table>
										</td>
									</tr>
					    			<tr>
										<td align="right" height="20">
											<input type='hidden' name='save' id="save">
											<input type='hidden' name='mode' value="<?php echo $this->_tpl_vars['mode']; ?>
">
											<input type="hidden" name="fields[org_position_id]" value="<?php echo $this->_tpl_vars['rows']['org_position_id']; ?>
" >
										</td>
									</tr>
									<tr ><td height="20"></td></tr>
									<tr bgcolor="#EBEBEB">
										<td align="right" >
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="submitForm('<?php echo $this->_tpl_vars['mode']; ?>
');" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/position/display');" value=" Back " type="button">
											&nbsp;
										</td>
									</tr>
					    		</table>
					    	</td>
					    </tr>
					    <tr align="right">
							<td >
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
</form>
</div>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => "date,".($this->_tpl_vars['_js'])."/position.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
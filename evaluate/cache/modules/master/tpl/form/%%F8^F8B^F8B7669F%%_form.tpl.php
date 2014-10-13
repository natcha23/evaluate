<?php /* Smarty version 2.6.19, created on 2014-06-19 14:58:53
         compiled from form/_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_input_date', 'form/_form.tpl', 61, false),array('function', 'html_options', 'form/_form.tpl', 78, false),array('function', 'html_radios', 'form/_form.tpl', 86, false),array('function', 'add_script', 'form/_form.tpl', 133, false),)), $this); ?>
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
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="submitForm();" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/form/display');" value=" Back " type="button">
											&nbsp;
										</td>
									</tr>
									<tr >
										<td align="left" >
											<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >

										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Form No.</td>
													<td class="font12">
														<input type="text" name="fields[form_code]" id="form_code" value="<?php echo $this->_tpl_vars['rows']['form_code']; ?>
" class="textfield_5c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Form Name</td>
													<td class="font12">
														<input type="text" name="fields[form_name]" id="form_name" value="<?php echo $this->_tpl_vars['rows']['form_name']; ?>
" class="textfield_5c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Objective</td>
													<td class="font12">
														<textarea name="fields[form_objective]" rows="7" id="form_objective" class="textfield_10c" ><?php echo $this->_tpl_vars['rows']['form_objective']; ?>
</textarea>
													</td>
										    	</tr>
										    	<tr height="30">
													<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Start Date</td>
													<td class="font12" nowrap>
														 <?php if ($this->_tpl_vars['rows']['form_stdate'] == '0000-00-00'): ?><?php $this->assign('stdate', ""); ?><?php else: ?><?php $this->assign('stdate', $this->_tpl_vars['rows']['form_stdate']); ?><?php endif; ?>
														 <?php echo $this->_plugins['function']['html_input_date'][0][0]->html_input_date(array('name' => "fields[form_stdate]",'id' => 'form_stdate','value' => ($this->_tpl_vars['stdate']),'size' => '15','readonly' => true), $this);?>

													</td>
												</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
											    	<td align="left" width="150px" class="font11b" nowrap>End Date</td>
											    	<td class="font12" nowrap>
											    		<?php if ($this->_tpl_vars['rows']['form_enddate'] == '0000-00-00'): ?><?php $this->assign('enddate', ""); ?><?php else: ?><?php $this->assign('enddate', $this->_tpl_vars['rows']['form_enddate']); ?><?php endif; ?>
											    		<?php echo $this->_plugins['function']['html_input_date'][0][0]->html_input_date(array('name' => "fields[form_enddate]",'id' => 'form_enddate','value' => ($this->_tpl_vars['enddate']),'size' => '15','readonly' => true), $this);?>

											    	</td>
												</tr>
												<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Form Type</td>
													<td class="font12">
														<select name="fields[form_type]" id="form_type" class="selectBox3cm" >
														<option value="">-- Please select --</option>
														<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['typeOp'],'selected' => $this->_tpl_vars['rows']['form_type']), $this);?>

														</select>
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Form Active</td>
													<td class="font12">
											    		<?php echo smarty_function_html_radios(array('name' => "fields[form_status]",'class' => 'border0','id' => 'form_status','options' => $this->_tpl_vars['statusOp'],'checked' => $this->_tpl_vars['status']), $this);?>

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
											<input type="hidden" name="fields[form_id]" value="<?php echo $this->_tpl_vars['rows']['form_id']; ?>
" >
										</td>
									</tr>
									<tr ><td height="20"></td></tr>
									<tr bgcolor="#EBEBEB">
										<td align="right" >
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="submitForm();" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/form/display');" value=" Back " type="button">
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => "date,".($this->_tpl_vars['_js'])."/form.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
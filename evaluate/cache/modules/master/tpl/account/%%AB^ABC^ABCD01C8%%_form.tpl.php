<?php /* Smarty version 2.6.19, created on 2014-08-24 14:11:03
         compiled from account/_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'account/_form.tpl', 147, false),array('function', 'html_input_date', 'account/_form.tpl', 191, false),array('function', 'html_radios', 'account/_form.tpl', 230, false),array('function', 'add_script', 'account/_form.tpl', 273, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_gradefrm" enctype="multipart/form-data">
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
									<td colspan="2" align="right" >
										<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="submitForm();" value=" Save " type="button"><?php endif; ?>
										<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/account/display');" value=" Back " type="button">
										<?php else: ?>
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');" value=" Back " type="button">
										<?php endif; ?>
										&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" height="10">
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="<?php echo $this->_tpl_vars['mode']; ?>
">
										<input type="hidden" name="fields[user_id]" value="<?php echo $this->_tpl_vars['rows']['user_id']; ?>
" >
									</td>
								</tr>
								<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="98%" border="0" >
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Code :</td>
										    	<td class="font12" width="40%">
										    		<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										    		<input type="text" name="fields[user_code]" id="user_code" value="<?php echo $this->_tpl_vars['rows']['user_code']; ?>
" <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>readonly<?php endif; ?> class="textfield_3c" onKeyup="ckvNum(this);" maxLength="7">
										    		<?php else: ?>
										    												    		<input type="text" name="fields[user_code]" readonly id="user_code" value="<?php echo $this->_tpl_vars['rows']['user_code']; ?>
" class="textfield_3c">
										    		<?php endif; ?>
										    	</td>
									    		<td rowspan="8" >
									    			<table>
														<tr>
															<td>
																<?php if (! $this->_tpl_vars['rows']['user_image']): ?>
																	<img src="<?php echo $this->_tpl_vars['UPLOAD_URL']; ?>
/default.gif" id="PreviewImage" width="100" height="134">
																<?php else: ?>
																	<img src="<?php echo $this->_tpl_vars['UPLOAD_URL']; ?>
/account/<?php echo $this->_tpl_vars['rows']['user_image']; ?>
?<?php echo $this->_tpl_vars['rand']; ?>
" width="100" height="134" id="PreviewImage" class="border1">
																	<input type="hidden" name="picture_old" value="<?php echo $this->_tpl_vars['rows']['user_image']; ?>
" width="100" height="134">
																<?php endif; ?>
																	<br>
																	<input type="file" name="picture" id="picture" onchange="CheckImageType(this);">
															</td>
														</tr>
													</table>
									    		</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Name :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										    		<input type="text" name="fields[user_name]" id="user_name" value="<?php echo $this->_tpl_vars['rows']['user_name']; ?>
" class="textfield_5c" <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>readonly<?php endif; ?>>
										    		<?php else: ?>
										    		<?php echo $this->_tpl_vars['rows']['user_name']; ?>

										    		<?php endif; ?>
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Lastname :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										    		<input type="text" name="fields[user_lname]" id="user_lname" value="<?php echo $this->_tpl_vars['rows']['user_lname']; ?>
" class="textfield_5c" <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>readonly<?php endif; ?>>
										    		<?php else: ?>
										    		<?php echo $this->_tpl_vars['rows']['user_lname']; ?>

										    		<?php endif; ?>
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">User Login :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
											    	<input type="text" name="fields[u_login]" id="u_login" value="<?php echo $this->_tpl_vars['rows']['u_login']; ?>
" class="textfield_5c" <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>readonly<?php endif; ?>>
											    	<?php else: ?>
										    		<?php echo $this->_tpl_vars['rows']['u_login']; ?>

										    		<?php endif; ?>
										    	</td>
									    	</tr>
									    	<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Password :</td>
										    	<td colspan="2" class="font12">
										    		<input type="password" name="fields[u_password]" id="u_password" value="<?php echo $this->_tpl_vars['rows']['u_password']; ?>
" class="textfield_5c" >
										    		<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="button" onclick="$('#u_password').val('')">
										    		<input type="hidden" name="u_password" id="u_password_old" value="<?php echo $this->_tpl_vars['rows']['u_password']; ?>
" class="textfield_5c" >
										    	</td>
									    	</tr>
									    	<?php endif; ?>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">E-Mail :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										    		<input type="text" name="fields[user_email]" id="user_email" value="<?php echo $this->_tpl_vars['rows']['user_email']; ?>
" class="textfield_5c" <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>readonly<?php endif; ?>>
										    		<?php else: ?>
										    		<?php echo $this->_tpl_vars['rows']['user_email']; ?>

										    		<?php endif; ?>
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Moblie :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										    		<input type="text" name="fields[user_mobile]" id="user_mobile" value="<?php echo $this->_tpl_vars['rows']['user_mobile']; ?>
" class="textfield_5c" onKeyup="isNumber(this);" <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>readonly<?php endif; ?>> Ex:- 081XXXXXXX
										    		<?php else: ?>
										    		<?php echo $this->_tpl_vars['rows']['user_mobile']; ?>

										    		<?php endif; ?>
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Position :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										    		<select name="fields[user_position]" id="user_position" onchange="GetLevel(this);" class="selectBox6cm" <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>readonly<?php endif; ?>>
													<option value="">-- Please select --</option>
													<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['positionOp'],'selected' => $this->_tpl_vars['rows']['user_position']), $this);?>

													</select>
                                                    <input type="hidden" name="position_old" value="<?php echo $this->_tpl_vars['rows']['user_position']; ?>
">
                                                    <input type="hidden" name="level_old" value="<?php echo $this->_tpl_vars['rows']['org_position_level']; ?>
">
                                                    <input type="hidden" name="level_new" id="level_new">
													<?php else: ?>
										    		<?php echo $this->_tpl_vars['positionOp'][$this->_tpl_vars['rows']['user_position']]; ?>

                                                    <input type="hidden" name="level_new" id="level_new" value="<?php echo $this->_tpl_vars['rows']['org_position_level']; ?>
">
										    		<?php endif; ?>
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Department :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										    		<select name="fields[user_sec_depart]" id="user_sec_depart" class="selectBox6cm" <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>readonly<?php endif; ?>>
													<option value="">-- Please select --</option>
													<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['departmentOp'],'selected' => $this->_tpl_vars['rows']['user_sec_depart']), $this);?>

													</select>
                                                    <input type="hidden" name="dept_old" value="<?php echo $this->_tpl_vars['rows']['user_sec_depart']; ?>
">
													<?php else: ?>
										    		<?php echo $this->_tpl_vars['departmentOp'][$this->_tpl_vars['rows']['user_sec_depart']]; ?>

										    		<?php endif; ?>
										    	</td>
									    	</tr>
											<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">User Menu :</td>
										    	<td colspan="2" class="font12">
										    		<select name="fields[lookup_code]" id="lookup_code" class="selectBox6cm" >
													<option value="">-- Please select --</option>
													<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupMenuOp'],'selected' => $this->_tpl_vars['rows']['lookup_code']), $this);?>

													</select>
										    	</td>
									    	</tr>
									    	<?php endif; ?>
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Start Date :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['rows']['user_start'] == '0000-00-00'): ?><?php $this->assign('stdate', ""); ?><?php else: ?><?php $this->assign('stdate', $this->_tpl_vars['rows']['user_start']); ?><?php endif; ?>
													<?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?><?php echo $this->_tpl_vars['stdate']; ?>
<?php else: ?>
													<?php echo $this->_plugins['function']['html_input_date'][0][0]->html_input_date(array('name' => "fields[user_start]",'id' => 'user_start','value' => ($this->_tpl_vars['stdate']),'size' => '15','readonly' => true), $this);?>

													<?php endif; ?>
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Header Active :</td>
										    	<td colspan="2" class="font12">
										    		<input <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>disabled<?php endif; ?> class="border0" type="checkbox" name="fields[user_header]" value="Y" <?php if ($this->_tpl_vars['rows']['user_header'] == 'Y'): ?>checked<?php endif; ?>>
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b"> Active :</td>
										    	<td colspan="2" class="font12">
										    		<input <?php if ($this->_tpl_vars['_profile']->lookup_code != 'AM'): ?>disabled<?php endif; ?> class="border0" type="checkbox" name="fields[incentive_active]" value="Y" <?php if ($this->_tpl_vars['rows']['incentive_active'] == 'Y'): ?>checked<?php endif; ?>>
										    	</td>
									    	</tr>
									    	<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Start MI :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['rows']['user_start_mi'] == '0000-00-00'): ?><?php $this->assign('stdate_mi', ""); ?><?php else: ?><?php $this->assign('stdate_mi', $this->_tpl_vars['rows']['user_start_mi']); ?><?php endif; ?>
													<?php echo $this->_plugins['function']['html_input_date'][0][0]->html_input_date(array('name' => "fields[user_start_mi]",'id' => 'user_start_mi','value' => ($this->_tpl_vars['stdate_mi']),'size' => '15','readonly' => true), $this);?>

										    	</td>
									    	</tr>
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Start PI :</td>
										    	<td colspan="2" class="font12">
										    		<?php if ($this->_tpl_vars['rows']['user_start_pi'] == '0000-00-00'): ?><?php $this->assign('stdate_pi', ""); ?><?php else: ?><?php $this->assign('stdate_pi', $this->_tpl_vars['rows']['user_start_pi']); ?><?php endif; ?>
													<?php echo $this->_plugins['function']['html_input_date'][0][0]->html_input_date(array('name' => "fields[user_start_pi]",'id' => 'user_start_pi','value' => ($this->_tpl_vars['stdate_pi']),'size' => '15','readonly' => true), $this);?>

										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Active :</td>
										    	<td colspan="2" class="font12">
										    		<?php echo smarty_function_html_radios(array('name' => "fields[user_active]",'class' => 'border0','id' => 'user_active','options' => $this->_tpl_vars['statusOp'],'checked' => $this->_tpl_vars['status']), $this);?>

										    	</td>
									    	</tr>
									    	<?php endif; ?>
									    	<tr><td colspan="4" height="10" class="font12"></td></tr>
									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td colspan="2" align="right" >
										<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="submitForm();" value=" Save " type="button"><?php endif; ?>
										<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/account/display');" value=" Back " type="button">
										<?php else: ?>
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');" value=" Back " type="button">
										<?php endif; ?>
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => "date,".($this->_tpl_vars['_js'])."/account.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
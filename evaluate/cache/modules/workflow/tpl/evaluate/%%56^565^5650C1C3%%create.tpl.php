<?php /* Smarty version 2.6.19, created on 2014-06-17 17:38:06
         compiled from PI/create.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'PI/create.tpl', 47, false),array('function', 'cycle', 'PI/create.tpl', 95, false),array('function', 'add_script', 'PI/create.tpl', 233, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_create" enctype="multipart/form-data">
<input type='hidden' name='mode' id="mode">
<input type='hidden' name='save' id="save">
<input type='hidden' name='drf_id' id="drf_id" value="<?php echo $this->_tpl_vars['drfid']; ?>
">
<table valign="top" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        				<!--td width="3" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/line.jpg"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/line.jpg" width="3" height="6" /></td-->
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
					  <tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_save" title="Draft" class="btn_tools" onclick="chkDraftSubmit('PI','<?php echo $this->_tpl_vars['frmRow']['form_id']; ?>
');" value=" Draft " type="button">
							<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="chkSaveSubmit('PI','<?php echo $this->_tpl_vars['frmRow']['form_id']; ?>
');" value=" Save " type="button"><?php endif; ?>
							<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="reset">
							<input id="btn_list" title="Portal" class="btn_tools" onclick="openPage('workflow/evaluate/portalpi/form_id/<?php echo $this->_tpl_vars['frmRow']['form_id']; ?>
/form_type/PI');" value=" Portal " type="button">
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/form/display');" value=" Back " type="button">
							&nbsp;
						</td>
					 </tr>
			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr height="20" valign="top" >
				    				<td class="font11b" align="left" width="15%">&nbsp; เลขที่แบบประเมิน </td>
				    				<td class="font12b" align="left" ><?php if ($this->_tpl_vars['drfid']): ?><?php echo $this->_tpl_vars['frmDraft']['form_code']; ?>
<?php else: ?><?php echo $this->_tpl_vars['frmRow']['form_code']; ?>
<?php endif; ?></td>
				    			</tr>
				    			<tr height="25">
				    				<td class="font11b" align="left" width="15%">&nbsp; ใบประเมินประจำเดือน </td>
				    				<td class="font11b" align="left" >
				    					<select name="fields[month]" id="month" class="selectBox10"  >
											<?php if ($this->_tpl_vars['drfid']): ?><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['_monthPIOp'],'selected' => $this->_tpl_vars['frmDraft']['month']), $this);?>

                                            <?php else: ?><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['_monthPIOp'],'selected' => $this->_tpl_vars['monthNow']), $this);?>
<?php endif; ?>
										</select>
										&nbsp;&nbsp; ปี &nbsp;
										<select name="fields[year]" id="year" class="selectBox7"  >
											<?php if ($this->_tpl_vars['drfid']): ?><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yearOp'],'selected' => $this->_tpl_vars['frmDraft']['year']), $this);?>

                                            <?php else: ?><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yearOp'],'selected' => $this->_tpl_vars['yearNow']), $this);?>
<?php endif; ?>
										</select>
									</td>
				    			</tr>
				    			<tr height="20" valign="top" >
				    				<td class="font11b" align="left" width="15%">&nbsp; Evaluate Objective </td>
				    				<td class="font11b" align="left" >
				    					<input type="hidden" name="fields[form_code]" value="<?php if ($this->_tpl_vars['drfid']): ?><?php echo $this->_tpl_vars['frmDraft']['form_code']; ?>
<?php else: ?><?php echo $this->_tpl_vars['frmRow']['form_code']; ?>
<?php endif; ?>">
				    					<textarea name="fields[mph_objective]" rows="7" readonly id="mph_objective" class="textfield_10c" ><?php if ($this->_tpl_vars['drfid']): ?><?php echo $this->_tpl_vars['frmDraft']['mph_objective']; ?>
<?php else: ?><?php echo $this->_tpl_vars['frmRow']['form_objective']; ?>
<?php endif; ?></textarea>
				    				</td>
				    			</tr>
				    			<tr height="20" valign="top" bgcolor="#F2F2F2" >
				    				<td class="font11b" align="left" colspan="2" width="15%">&nbsp; กำหนดหัวข้อการประเมิน </td>
				    			</tr>
				    			<tr height="25" valign="top" id="_show1">
				    				<td class="font11b" align="left" width="15%"></td>
				    				<td class="font11b" align="left" >
				    					<table valign="top" cellpadding="0" cellspacing="1" width="100%" border="0">
				    						<tr height="25" class="font11b" bgcolor="#DAECF4"><td colspan="2">เลือกรายการประเมิน</td></tr>
				    						<tr height="20">
				    							<td valign="top" width="50%">
				    								<?php $_from = $this->_tpl_vars['evaluate']['Left']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    								<table valign="top" cellpadding="0" cellspacing="1" width="99%" border="0">
				    									<tr bgcolor="#cccccc">
				    										<td align="center" width="4%"><input type='checkbox' <?php if ($this->_tpl_vars['frmDraft']['data_select'][$this->_tpl_vars['key']]['subject']): ?> checked <?php endif; ?>name='fields[data][<?php echo $this->_tpl_vars['key']; ?>
][subject]' id="s_<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
" value='<?php echo $this->_tpl_vars['item']['mst_eva_name']; ?>
' onclick="selectChkAll(this);"></td>
							    							<td class="font12" align="left" >
							    							&nbsp;<?php echo $this->_tpl_vars['item']['mst_eva_name']; ?>

							    							</td>
							    							<td class="font12" width="5%" align="left" >
							    								<input type="text" name="fields[data][<?php echo $this->_tpl_vars['key']; ?>
][mpl_weight]" onKeyup="ckvNum(this);" <?php if ($this->_tpl_vars['frmDraft']['data_select'][$this->_tpl_vars['key']]['mpl_weight']): ?> value="<?php echo $this->_tpl_vars['frmDraft']['data_select'][$this->_tpl_vars['key']]['mpl_weight']; ?>
"<?php else: ?>value="" <?php endif; ?> class="textfield_1_5c" maxLength="2">
							    							</td>
				    									</tr>
				    									<?php $_from = $this->_tpl_vars['dataLine'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['line']):
?>
				    									<!--tr bgcolor="#ffffff">
				    										<td align="center" width="4%"><input type='checkbox' name='fields[data][<?php echo $this->_tpl_vars['key']; ?>
][detail][<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
][subject]' id="d_<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
_<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
" value='<?php echo $this->_tpl_vars['line']['mst_eva_name']; ?>
' onclick="selectChkHead(this);"></td>
							    							<td class="font12" align="left" >
							    							&nbsp;<?php echo $this->_tpl_vars['line']['mst_eva_name']; ?>

							    							</td>
							    							<td class="font12" width="5%" align="left" >
							    								<input type="text" onKeyup="ckvNum(this);" name="fields[data][<?php echo $this->_tpl_vars['key']; ?>
][detail][<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
][mpl_weight]" value="" class="textfield_1_5c" maxLength="2">
							    							</td><?php if ($this->_tpl_vars['frmDraft']['data_select'][$this->_tpl_vars['key']]['subject']): ?> checked <?php endif; ?>
				    									</tr-->
				    									<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#ECECED"), $this);?>
">
				    										<td align="center" width="4%"></td>
							    							<td class="font12" align="left" >
							    							<input type='checkbox' <?php if ($this->_tpl_vars['frmDraft']['data_select'][$this->_tpl_vars['key']]['detail'][$this->_tpl_vars['line']['mst_eva_id']]['subject']): ?> checked<?php endif; ?> name='fields[data][<?php echo $this->_tpl_vars['key']; ?>
][detail][<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
][subject]' id="d_<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
_<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
" value='<?php echo $this->_tpl_vars['line']['mst_eva_name']; ?>
' onclick="selectChkHead(this);">
							    							&nbsp;<?php echo $this->_tpl_vars['line']['mst_eva_name']; ?>

							    							</td>
							    							<td class="font12" width="5%" align="left" >
							    								<input type="text" onKeyup="ckvNum(this);" name="fields[data][<?php echo $this->_tpl_vars['key']; ?>
][detail][<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
][mpl_weight]" <?php if ($this->_tpl_vars['frmDraft']['data_select'][$this->_tpl_vars['key']]['detail'][$this->_tpl_vars['line']['mst_eva_id']]['mpl_weight']): ?> value="<?php echo $this->_tpl_vars['frmDraft']['data_select'][$this->_tpl_vars['key']]['detail'][$this->_tpl_vars['line']['mst_eva_id']]['mpl_weight']; ?>
" <?php else: ?>value=""<?php endif; ?> class="textfield_1_5c" maxLength="2">
							    							</td>
				    									</tr>
				    									<?php endforeach; endif; unset($_from); ?>
				    								</table>
				    								<?php endforeach; endif; unset($_from); ?>
				    							</td>
				    							<!--td valign="top" width="50%">
				    								<?php $_from = $this->_tpl_vars['evaluate']['Right']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    								<table valign="top" cellpadding="0" cellspacing="1" width="99%" border="0">
				    									<tr bgcolor="#cccccc">
				    										<td align="center" width="4%"><input type='checkbox' name='fields[data][<?php echo $this->_tpl_vars['key']; ?>
][subject]' id="s_<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
" value='<?php echo $this->_tpl_vars['item']['mst_eva_name']; ?>
' onclick="selectChkAll(this);"></td>
							    							<td class="font12" align="left" >
							    							&nbsp;<?php echo $this->_tpl_vars['item']['mst_eva_name']; ?>

							    							</td>
							    							<td class="font12" width="5%" align="left" >
							    								<input type="text" onKeyup="ckvNum(this);" name="fields[data][<?php echo $this->_tpl_vars['key']; ?>
][mpl_weight]" value="" class="textfield_1c">
							    							</td>
				    									</tr>
				    									<?php $_from = $this->_tpl_vars['dataLine'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['line']):
?>
				    									<tr bgcolor="#ffffff">
				    										<td align="center" width="4%"><input type='checkbox' name='fields[data][<?php echo $this->_tpl_vars['key']; ?>
][detail][<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
][subject]]' id="d_<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
_<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
" value='<?php echo $this->_tpl_vars['line']['mst_eva_name']; ?>
' onclick="selectChkHead(this);"></td>
							    							<td class="font12" align="left" >
							    							&nbsp;<?php echo $this->_tpl_vars['line']['mst_eva_name']; ?>

							    							</td>
							    							<td class="font12" width="5%" align="left" >
							    								<input type="text" onKeyup="ckvNum(this);" name="fields[data][<?php echo $this->_tpl_vars['key']; ?>
][detail][<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
][mpl_weight]" value="" class="textfield_1c">
							    							</td>
				    									</tr>
				    									<?php endforeach; endif; unset($_from); ?>
				    								</table>
				    								<?php endforeach; endif; unset($_from); ?>
				    							</td-->
				    						</tr>
				    					</table>
				    				</td>
				    			</tr>
				    			<tr height="20" valign="top" bgcolor="#F2F2F2" >
				    				<td class="font11b" align="left" colspan="2" width="15%">&nbsp; กำหนดผู้ใช้ฟอร์ม </td>
				    			</tr>

				    			<tr height="25" valign="top" id="_show2">
				    				<td class="font11b" align="left" width="15%"></td>
				    				<td class="font11b" align="left" >
				    					<table valign="top" cellpadding="0" cellspacing="1" width="98%" border="0">
				    						<tr height="25" class="font11b"><td colspan="2"><input type="button" name="add" value=" เลือกผู้ใช้ฟอร์ม " onclick="openPopup('workflow/evaluate/userpopup');"></td></tr>
				    						<tr>
				    							<td>
				    								<textarea name="user_eva" rows="7" id="user_name" class="textfield_10c" readonly><?php if ($this->_tpl_vars['drfid']): ?><?php echo $this->_tpl_vars['frmDraft']['user_eva']; ?>
<?php endif; ?></textarea>
				    								<input type='hidden' name='fields[user_code]' id="user_code" value="<?php if ($this->_tpl_vars['drfid']): ?><?php echo $this->_tpl_vars['frmDraft']['user_code']; ?>
<?php endif; ?>">
												</td>
				    						</tr>

				    					</table>
				    				</td>
				    			</tr>
				    			<tr height="20" valign="top" bgcolor="#F2F2F2" >
				    				<td class="font11b" align="left" width="15%">&nbsp; ผู้ใช้ฟอร์ม เริ่มต้น </td>
				    				<td class="font11b" align="left" >

				    					<select name="fields[mph_sflow]" id="mph_sflow" class="selectBox7"  >
				    					<option value="">-Select-</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['levelOp'],'selected' => $this->_tpl_vars['frmDraft']['mph_sflow']), $this);?>

										</select>
										&nbsp;&nbsp; ผู้ใช้ฟอร์มสิ้นสุด &nbsp;
										<select name="fields[mph_eflow]" id="mph_eflow" class="selectBox7"  >
										<option value="">-Select-</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['levelOp'],'selected' => $this->_tpl_vars['frmDraft']['mph_eflow']), $this);?>

										</select>
				    			</tr>
				    			<tr height="20" valign="top" bgcolor="#F2F2F2" >
				    				<td class="font11b" align="left" colspan="2" width="15%">&nbsp; กำหนดผู้รับใบประเมิน </td>
				    			</tr>
				    			<tr height="25" valign="top" id="_show3">
				    				<td class="font11b" align="left" width="15%"></td>
				    				<td class="font11b" align="left" >
				    					<table valign="top" cellpadding="0" cellspacing="1" width="98%" border="0">
				    						<tr height="25" class="font11b"><td colspan="2">เลือกผู้รับใบประเมิน</td></tr>
				    						<tr height="20">
				    							<td colspan="2" class="font12">
										    		<select name="fields[user_rec]" id="user_rec" class="selectBox6cm" >
													<option value="">-- Please select --</option>
													<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['userRecive'],'selected' => $this->_tpl_vars['frmDraft']['user_rec']), $this);?>

													</select>
										    	</td>
				    										    						</tr>
				    					</table>
				    				</td>
				    			</tr>
						       <tr ><td colspan="2"height="20"></td></tr>
							   <tr bgcolor="#EBEBEB">
									<td colspan="2" align="right" >
										<input id="btn_save" title="Draft" class="btn_tools" onclick="chkDraftSubmit('PI','<?php echo $this->_tpl_vars['frmRow']['form_id']; ?>
');" value=" Draft " type="button">
										<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_sent" title="Save and send pi" class="btn_tools" onclick="chkSaveSubmit('PI','<?php echo $this->_tpl_vars['frmRow']['form_id']; ?>
');" value=" Save and Send" type="button"><?php endif; ?>
										<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="reset">
										<input id="btn_list" title="Portal" class="btn_tools" onclick="openPage('workflow/evaluate/portalpi/form_id/<?php echo $this->_tpl_vars['frmRow']['form_id']; ?>
/form_type/PI');" value=" Portal " type="button">
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
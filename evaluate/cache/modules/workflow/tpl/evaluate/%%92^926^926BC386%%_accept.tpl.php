<?php /* Smarty version 2.6.19, created on 2014-08-24 14:09:38
         compiled from summary/_accept.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'summary/_accept.tpl', 29, false),array('function', 'cycle', 'summary/_accept.tpl', 71, false),array('function', 'add_script', 'summary/_accept.tpl', 197, false),array('modifier', 'number_format', 'summary/_accept.tpl', 83, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data" >
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
				    		<table id="list-content"bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#EBEBEB" height="25">
						   			<td class="font11" align="left" colspan="4" ><b>Month :</b>
				    					<?php if ($this->_tpl_vars['typePage'] == 'PI'): ?>
				    					<select name="search[month]" id="month" class="selectBox10" >
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['monthOp'],'selected' => $this->_tpl_vars['month']), $this);?>

										</select>
										<?php else: ?>
										<select name="search[quarter]" id="month" class="selectBox10">
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['quarterOp'],'selected' => $this->_tpl_vars['month']), $this);?>

										</select>
										<?php endif; ?>
										<select name="search[year]" id="year" class="selectBox7"  >
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yearOp'],'selected' => $this->_tpl_vars['year']), $this);?>

										</select>
										<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">

				    				</td>
						   			<td class="font11" align="right" colspan="5" ><b>Department :</b>
										<select name="group" id="group" class="selectBox22" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

										</select>&nbsp;&nbsp;
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
									<td class="font11b" width="8%" align="center" >Emp. Code</td>
									<td class="font11b" width="20%" align="center" >Emp. Name</td>
									<td class="font11b" align="center" >Position</td>
									<td class="font11b" width="5%" align="center" >Level</td>
									<td class="font11b" width="10%" align="center" >Diff Score</td>
									<td class="font11b" width="10%" align="center" >Score</td>
									<!-- natcharee close temporary -->
									<?php if ($this->_tpl_vars['lookup_code'] == 'AM' || $this->_tpl_vars['_profile']->level >= 11): ?>
									<td class="font11b" width="10%" align="center" >Grade</td>
									<td class="font11b" width="10%" align="center" >Incentive</td>
									<?php endif; ?>
								</tr>
								<?php if ($this->_tpl_vars['rowsArr']): ?>
								<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['depart']):
?>
									<tr height="20" bgcolor="#C6DCFF" >
										<td align="center" ><input type='checkbox' name="checkDep" class="border0" id="dep_<?php echo $this->_tpl_vars['key']; ?>
" onclick="selectChkSub(this,'<?php echo $this->_tpl_vars['key']; ?>
');"></td>
										<td colspan="8" align="left" class="font12">&nbsp;<?php echo $this->_tpl_vars['depart']['department']; ?>
</td>
									</tr>
									<?php $_from = $this->_tpl_vars['depart']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['item']):
?>
									<?php $this->assign('diff_scolll', $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_totalscoll']-$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']]['total']); ?>
										<tr height="20" <?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['re_inc'] == 'N'): ?>bgcolor="#FFE7F6"<?php else: ?>bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
"<?php endif; ?> >
											<td align="center" ><input type='checkbox' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][user_code]" class="border0" id="chk_<?php echo $this->_tpl_vars['key']; ?>
_<?php echo $this->_tpl_vars['item']['user_code']; ?>
" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_id']; ?>
' onclick="ChkHead(this,'<?php echo $this->_tpl_vars['key']; ?>
');"></td>
											<td class="font11" align="center" ><?php if ($this->_tpl_vars['item']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['item']['user_code']; ?>
<?php endif; ?></td>
											<td align="left" class="font11" >
												<?php if ($this->_tpl_vars['lookup_code'] == 'AM' || $this->_tpl_vars['_profile']->level >= 9): ?>
												<a href="#" onclick="openPageEvaluate('<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_type']; ?>
','<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_id']; ?>
','<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_user']; ?>
','<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_month']; ?>
','A');"><?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>
</a>
												<?php else: ?>
												<?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>

												<?php endif; ?>
											</td>
											<td align="left" class="font11" ><?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td>
											<td align="center" class="font11" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
											<!--td align="right" class="font11"><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['key1']]['diff_scoll'] < '0'): ?><font color="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key1']]['diff_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</font><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key1']]['diff_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
<?php endif; ?>&nbsp;</td-->
											<td align="right" class="font11"><?php if ($this->_tpl_vars['diff_scolll'] < '0'): ?><font color="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['diff_scolll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</font><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['diff_scolll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
<?php endif; ?>&nbsp;</td>
											<td align="right" class="font11"><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade'] == 'A'): ?><font color="blue"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</font><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
<?php endif; ?>&nbsp;</td>
											<!-- natcharee close temporary -->
												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][user_code]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_user']; ?>
'>
												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][grade]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade']; ?>
'>
												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_id]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_id']; ?>
'>
												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_column]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_column']; ?>
'>
												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_eflow]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_eflow']; ?>
'>
                                                <input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_level_now]" value='<?php echo $this->_tpl_vars['item']['org_position_level']; ?>
'>
                                                <input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_incentive]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['incentive']; ?>
'>
                                                
                                                
											<?php if ($this->_tpl_vars['lookup_code'] == 'AM' || $this->_tpl_vars['_profile']->level >= 11): ?>
											<td align="center" class="font11"><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade'] == 'A'): ?><font color="blue"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade']; ?>
</font><?php else: ?><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade']; ?>
<?php endif; ?>
<!-- 												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][user_code]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_user']; ?>
'> -->
<!-- 												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][grade]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade']; ?>
'> -->
<!-- 												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_id]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_id']; ?>
'> -->
<!-- 												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_column]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_column']; ?>
'> -->
<!-- 												<input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_eflow]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_eflow']; ?>
'> -->
<!--                                                 <input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_level_now]" value='<?php echo $this->_tpl_vars['item']['org_position_level']; ?>
'> -->
<!--                                                 <input type='hidden' name="check[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_incentive]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['incentive']; ?>
'> -->
											</td>
											
											<td align="right" class="font11"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;
<!-- 	                                            <input type='hidden' name="update[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_level_now]" value='<?php echo $this->_tpl_vars['item']['org_position_level']; ?>
'> -->
<!-- 	                                            <input type='hidden' name="update[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_incentive]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['incentive']; ?>
'> -->
                                            </td>
                                            <?php endif; ?>
                                            
                                            	<input type='hidden' name="update[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_level_now]" value='<?php echo $this->_tpl_vars['item']['org_position_level']; ?>
'>
	                                            <input type='hidden' name="update[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_incentive]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['incentive']; ?>
'>
										</tr>
									<?php endforeach; endif; unset($_from); ?>
									<tr height="20" bgcolor="#b9b9b9">
										<td colspan="6" align="right" class="font12b">Average Score&nbsp;</td>
										<td align="right" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['incArr'][$this->_tpl_vars['key']]['average_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
										<!-- natcharee close temporary -->
										<?php if ($this->_tpl_vars['lookup_code'] == 'AM' || $this->_tpl_vars['_profile']->level >= 11): ?>
										<td align="right" class="font12b" nowrap>Summary Total</td>
										<td align="right" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['incArr'][$this->_tpl_vars['key']]['sum_incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
										<?php endif; ?>
									</tr>
								<?php endforeach; endif; unset($_from); ?>
								<tr height="20" bgcolor="#b9b9b9">
									<td colspan="6" align="right" class="font12blue">Average Score&nbsp;</td>
									<td align="right" class="font12blue"><?php echo ((is_array($_tmp=$this->_tpl_vars['totalArr']['average_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
									<!-- natcharee close temporary -->
									<?php if ($this->_tpl_vars['lookup_code'] == 'AM' || $this->_tpl_vars['_profile']->level >= 11): ?>
									<td align="right" class="font12blue" nowrap>Summary Total</td>
									<td align="right" class="font12blue"><?php echo ((is_array($_tmp=$this->_tpl_vars['totalArr']['sum_incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
									<?php endif; ?>
								</tr>
								<?php else: ?>
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="9" align="center" class="font12blue">Data Empty !!!!</td>
								</tr>
								<?php endif; ?>
				    		</table>
				    	</td>
				    </tr>
			       <tr bgcolor="#EBEBEB">
						<td align="left" >หมายเหตุ : รายการแถวสีชมพู หมายถึง รายการที่ยังไม่ถึงกำหนดรับ incentive</td>
						<td align="right" >
						<?php if ($this->_tpl_vars['rowsArr']): ?>
							<?php if ($this->_tpl_vars['lookup_code'] == 'AM'): ?>
								<input type='hidden' name="lookup_code" value='<?php echo $this->_tpl_vars['lookup_code']; ?>
'>
								<input id="btn_list" title="Finish by detail (Please select data.)" class="btn_tools" onclick="approveDetail('pi');" value="  Finish by detail" type="button">
								<input id="btn_accept" title="Finish All" class="btn_tools" onclick="acceptDataToSave('F','pi');" value="  Finish All" type="button">
							<?php else: ?>
								<?php if ($this->_tpl_vars['_profile']->level_name == $this->_tpl_vars['endflow']): ?>
									<input id="btn_list" title="Approve by detail (Please select data.)" class="btn_tools" onclick="approveDetail('pi');" value="  Approve by detail" type="button">
									<input id="btn_accept" title="Approve All" class="btn_tools" onclick="acceptDataToSave('F','pi');" value="  Approve All" type="button">
								<?php else: ?>
									<?php if ($this->_tpl_vars['lookup_code'] != 'AM'): ?>
										<input id="btn_list" title="Accept by detail (Please select data.)" class="btn_tools" onclick="approveDetail('pi');" value="  Accept by detail" type="button">						
										<input id="btn_sent" title="Send All" class="btn_tools" onclick="openPopup('workflow/evaluate/userpopup/pageview/pi/accept/Y');" value="  Send All " type="button">
										<?php if ($this->_tpl_vars['level'] > 11): ?>
										<input id="btn_accept" title="Approve All" class="btn_tools" onclick="acceptDataToSave('F','pi');" value="  Approve All" type="button">
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
                           							<!--input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/portalpi/form_id/<?php echo $this->_tpl_vars['form_id']; ?>
/form_type/<?php echo $this->_tpl_vars['form_type']; ?>
');" value="  Back " type="button"-->
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
<input type="hidden" name="user_recive" id="user_recive" value="<?php echo $this->_tpl_vars['_profile']->user_code; ?>
">
<input type="hidden" name="user_send" id="user_send" value="<?php echo $this->_tpl_vars['_profile']->user_code; ?>
">
<input type="hidden" name="mph_month" id="mph_month" value="<?php echo $this->_tpl_vars['monthNow']; ?>
">
<input type="hidden" name="update_mode" id="update_mode">

</table>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
<script>
	var typeshow = '<?php echo $this->_tpl_vars['typenow']; ?>
';
	<?php echo '
	jsShowTime(typeshow);

	// Toggle button approve all & finish all
	$(\'#list-content\').find(\'input:checkbox\').click(function(key, item) {

		$(this).each(function(key, item) {
			// Checked select box in list.
			if( $(\'input[type="checkbox"]:checked\').length > 0 ) {
				// Disabled button.
				$(\'#btn_accept\').attr(\'disabled\', \'disabled\');
			} else {
				// Enabled button.
				$(\'#btn_accept\').attr(\'disabled\', \'\');
			}
		});

	});

	
	'; ?>

</script>
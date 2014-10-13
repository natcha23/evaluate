<?php /* Smarty version 2.6.19, created on 2014-08-28 16:58:17
         compiled from summary/_incentive.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'summary/_incentive.tpl', 28, false),array('function', 'cycle', 'summary/_incentive.tpl', 98, false),array('function', 'add_script', 'summary/_incentive.tpl', 189, false),array('modifier', 'number_format', 'summary/_incentive.tpl', 110, false),)), $this); ?>
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
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#EBEBEB" height="25">
				    				<td class="font11" align="left" colspan="3" ><b>Month :</b>
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
						   			<td class="font11" align="right" colspan="5" >
						   				<b>Department :</b>
										<select name="group" id="group" <?php if ($this->_tpl_vars['head_org']): ?>disabled<?php endif; ?> class="selectBox25" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

										</select>&nbsp;&nbsp;
						   			 </td>
					 			</tr>
					 			<tr bgcolor="#EBEBEB" height="25">
				    				<td class="font11" align="left" colspan="8">
				    					<table width="100%" border="0">
				    						<tr>
				    							<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
				    							<td align="left">
				    												    							</td>
				    							<?php endif; ?>
				    							<td align="right">
				    							<?php if ($this->_tpl_vars['dataArr']): ?>
												<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
												<input type="button" id="btn_export" class="btn_tools" value=" Export to Excel" onclick="jsExportExcel('<?php echo $this->_tpl_vars['typePage']; ?>
')">
												<input type="button" id="btn_print" class="btn_tools" value=" Print Report" onclick="jsPrintReport('<?php echo $this->_tpl_vars['typePage']; ?>
')">
												<input type="button" id="btn_export" class="btn_tools" value=" Export Average" onclick="jsExportExcel2('<?php echo $this->_tpl_vars['typePage']; ?>
')">
												<!-- Add button export excel for hr format #natcha 10 Jun 2014 -->
												<!--input type="button" id="btn_export" class="btn_tools" value=" Export for payroll" onclick="exportHRSExcel('<?php echo $this->_tpl_vars['typePage']; ?>
')"-->
												                                        		<?php endif; ?>
				    							<?php endif; ?>
				    							<!--input type="button" id="btn_analysis" class="btn_tools" value=" วิเคราะห์ข้อมูล" onclick="jsAnalysis('<?php echo $this->_tpl_vars['typePage']; ?>
')"-->
				    							</td>
				    					
				    							
				    						</tr>
				    					</table>
				    				</td>
				    				
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="8%" align="center" >Emp. Code</td>
									<td class="font11b" width="20%" align="center" >Emp. Name</td>
									<td class="font11b" align="center" >Position</td>
									<td class="font11b" <?php if (! $this->_tpl_vars['show']): ?>width="5%"<?php else: ?>width="10%"<?php endif; ?> align="center" >Level</td>
									<?php if (! $this->_tpl_vars['show']): ?>
									<td class="font11b" width="10%" align="center" >Diff Score</td>
									<td class="font11b" width="10%" align="center" >Score</td>
									<?php endif; ?>
									<td class="font11b" width="10%" align="center" >Grade</td>
									<td class="font11b" <?php if (! $this->_tpl_vars['show']): ?>width="10%"<?php else: ?>width="15%"<?php endif; ?>align="center" >Incentive</td>
								</tr>

								<?php if ($this->_tpl_vars['dataArr']): ?>
								<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['depart']):
?>
									<tr height="20" bgcolor="#C6DCFF" >
										<td colspan="8" align="left" class="font12">&nbsp;<?php echo $this->_tpl_vars['depart']['department']; ?>
</td>
									</tr>
									<?php $_from = $this->_tpl_vars['depart']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['item']):
?>
									<?php $this->assign('diff_scolll', $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_totalscoll']-$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']]['total']); ?>
										<tr height="20" <?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['re_inc'] == 'N'): ?>bgcolor="#FFE7F6"<?php else: ?>bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
"<?php endif; ?> >
											<td class="font11" align="center" ><?php if ($this->_tpl_vars['item']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['item']['user_code']; ?>
<?php endif; ?></td>
											<td align="left" class="font11" >
											<?php if ($this->_tpl_vars['typePage'] == 'MI'): ?>
											<a href="javascript:app.gotoview('/workflow/evaluate/mifrm/user/<?php echo $this->_tpl_vars['item']['user_code']; ?>
/m/<?php echo $this->_tpl_vars['monthNow']; ?>
/status/W');"><?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>
</a>
											<?php else: ?>
											<a href="javascript:app.gotoview('/workflow/evaluate/pifrm/user/<?php echo $this->_tpl_vars['item']['user_code']; ?>
/m/<?php echo $this->_tpl_vars['monthNow']; ?>
/status/W');"><?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>
</a>
											<?php endif; ?>
											</td>
											<td align="left" class="font11" ><?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td>
											<td align="center" class="font11" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
											<?php if (! $this->_tpl_vars['show']): ?>
											<td align="right" class="font11"><?php if ($this->_tpl_vars['diff_scolll'] < '0'): ?><font color="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['diff_scolll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</font><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['diff_scolll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
<?php endif; ?>&nbsp;</td>
											<td align="right" class="font11"><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade'] == 'A'): ?><font color="blue"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</font><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
<?php endif; ?>&nbsp;</td>
											<?php endif; ?>
											<td align="center" class="font11"><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade'] == 'A'): ?><font color="blue"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade']; ?>
</font><?php else: ?><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade']; ?>
<?php endif; ?></td>
											<td align="right" class="font11"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
										    <input type='hidden' name="update[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_level_now]" value='<?php echo $this->_tpl_vars['item']['org_position_level']; ?>
'>
                                            <input type='hidden' name="update[<?php echo $this->_tpl_vars['item']['user_code']; ?>
][mph_incentive]" value='<?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['incentive']; ?>
'>
                                        </tr>
									<?php endforeach; endif; unset($_from); ?>
									<?php if (! $this->_tpl_vars['show']): ?>
									<tr height="20" bgcolor="#b9b9b9">
										<td colspan="5" align="right" class="font12b">Average Score&nbsp;</td>
										<td align="right" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['incArr'][$this->_tpl_vars['key']]['average_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
										<td align="right" class="font12b">Summary Total</td>
										<td align="right" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['incArr'][$this->_tpl_vars['key']]['sum_incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
									</tr>
									<?php else: ?>
									<tr height="20" bgcolor="#b9b9b9">
										<td colspan="5" align="right" class="font12b">Summary Total</td>
										<td align="right" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['incArr'][$this->_tpl_vars['key']]['sum_incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
									</tr>
									<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?>
								<?php if (! $this->_tpl_vars['show']): ?>
								<tr height="20" bgcolor="#b9b9b9">
									<td colspan="5" align="right" class="font12blue">Average Score&nbsp;</td>
									<td align="right" class="font12blue"><?php echo ((is_array($_tmp=$this->_tpl_vars['totalArr']['average_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
									<td align="right" class="font12blue" nowrap>Summary Total</td>
									<td align="right" class="font12blue"><?php echo ((is_array($_tmp=$this->_tpl_vars['totalArr']['sum_incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
								</tr>
								<?php else: ?>
								<tr height="20" bgcolor="#b9b9b9">
									<td colspan="5" align="right" class="font12blue">Summary Total</td>
									<td align="right" class="font12blue"><?php echo ((is_array($_tmp=$this->_tpl_vars['totalArr']['sum_incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
								</tr>
								<?php endif; ?>
								<?php endif; ?>
				    		</table>
				    	</td>
				    </tr>
				    <?php if ($this->_tpl_vars['dataArr']): ?>
					<tr bgcolor="#EBEBEB">
						<td align="left" >หมายเหตุ : รายการแถวสีชมพู หมายถึง รายการที่ยังไม่ถึงกำหนดรับ incentive</td>
						<td align="right" >
							<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
							
								<input type="button" id="btn_export" class="btn_tools" value=" Export to Excel" onclick="jsExportExcel('<?php echo $this->_tpl_vars['typePage']; ?>
')">
								<input type="button" id="btn_print" class="btn_tools" value=" Print Report" onclick="jsPrintReport('<?php echo $this->_tpl_vars['typePage']; ?>
')">
								<input type="button" id="btn_export" class="btn_tools" value=" Export Average" onclick="jsExportExcel2('<?php echo $this->_tpl_vars['typePage']; ?>
')">
								<!-- Add button export excel for hr format #natcha 10 Jun 2014 -->
								<!--input type="button" id="btn_export" class="btn_tools" value=" Export for payroll" onclick="exportHRSExcel('<?php echo $this->_tpl_vars['typePage']; ?>
')"-->
							
							<?php endif; ?>
                            <input type="hidden" name="mph_month" value="<?php echo $this->_tpl_vars['monthNow']; ?>
">
                            <input type="hidden" name="update_mode" id="update_mode">
				    	</td>
					</tr>
					<?php endif; ?>
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
<?php /* Smarty version 2.6.19, created on 2014-08-24 14:10:04
         compiled from summary/_grade.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'summary/_grade.tpl', 30, false),array('function', 'cycle', 'summary/_grade.tpl', 62, false),array('function', 'add_script', 'summary/_grade.tpl', 189, false),array('modifier', 'number_format', 'summary/_grade.tpl', 80, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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
			         <?php if ($this->_tpl_vars['typePage'] == 'MI'): ?>
			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#cccccc" height="25">
						   			<td class="font11" align="left" colspan="3" ><b>Select : </b>
										<select name="typeEva" id="type" class="selectBox7" onchange="jsChange(this.value);" >
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['typeOp'],'selected' => $this->_tpl_vars['typePage']), $this);?>

										</select>
										<!--input type="button" class="button" value="Search" name="btt_search" onclick="jsSearch();"-->
						   			 </td>
						   			<td class="font11" align="right" colspan="10" ><b>Department :</b>
										<select name="group" id="group" <?php if ($this->_tpl_vars['head_org']): ?>disabled<?php endif; ?> class="font12" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

										</select>
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="5%" rowspan="2" align="center" >รหัส</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >ชื่อ - สกุล</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >Position</td>
									<td class="font11b" width="4%" rowspan="2" align="center" >Level</td>
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<td class="font11b" colspan="2" <?php if ($this->_tpl_vars['monthNow'] == $this->_tpl_vars['keyM']): ?>bgcolor="#DDFFA7"<?php endif; ?> align="center" ><?php echo $this->_tpl_vars['mName']; ?>
</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<tr height="20" bgcolor="#B2B3B5">
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mName']):
?>
									<td align="center" class="font11b" width="5%">เกรด</td>
									<td align="center" class="font11b" width="6%">คะแนน</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<?php if ($this->_tpl_vars['dataArr']): ?>
								<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['depart']):
?>
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="12" align="left" class="font12">&nbsp;<?php echo $this->_tpl_vars['depart']['department']; ?>
</td>
								</tr>
								<?php $_from = $this->_tpl_vars['depart']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
								<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" >
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['item']['user_code']; ?>
</td>
									<td align="left" class="font12" >&nbsp;<?php echo $this->_tpl_vars['item']['user_name']; ?>
 </td>
									<td class="font11" align="left" >&nbsp;<?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td>
									<td class="font11" align="center" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<?php $this->assign('mph_grade', $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_grade']); ?>
									<td align="center" >
										<?php if ($this->_tpl_vars['mph_grade'] == 'A'): ?>
										<div class="font12BL"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_grade']; ?>
</div>
										<?php elseif ($this->_tpl_vars['mph_grade'] == 'F'): ?>
										<div class="font12R"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_grade']; ?>
</div>
										<?php else: ?>
										<div class="font12"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_grade']; ?>
</div>
										<?php endif; ?>
									</td>
									<td align="right" >
										<?php if ($this->_tpl_vars['mph_grade'] == 'A'): ?>
										<div class="font12BL"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</div>
										<?php elseif ($this->_tpl_vars['mph_grade'] == 'F'): ?>
										<div class="font12R"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</div>
										<?php else: ?>
										<div class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</div>
										<?php endif; ?>									
									</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<?php endforeach; endif; unset($_from); ?>
								<?php endforeach; endif; unset($_from); ?>
								<?php endif; ?>
				    		</table>
				    	</td>
				    </tr>
				    <?php else: ?>
				    <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#cccccc" height="25">
						   			<td class="font11" align="left" colspan="3" ><b>Select : </b>
										<select name="typeEva" id="type" class="selectBox7" onchange="jsChange(this.value);" >
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['typeOp'],'selected' => $this->_tpl_vars['typePage']), $this);?>

										</select>
										<!--input type="button" class="button" value="Search" name="btt_search" onclick="jsSearch();"-->
						   			 </td>
						   			<td class="font11" align="right" colspan="11" ><b>Department :</b>
										<select name="group" id="group" <?php if ($this->_tpl_vars['head_org']): ?>disabled<?php endif; ?> class="font12" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

										</select>
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="5%" rowspan="2" align="center" >รหัส</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >ชื่อ - สกุล</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >Position</td>
									<td class="font11b" width="4%" rowspan="2" align="center" >Level</td>
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<td class="font11b" colspan="2" <?php if ($this->_tpl_vars['monthNow'] == $this->_tpl_vars['keyM']): ?>bgcolor="#DDFFA7"<?php endif; ?> align="center" ><?php echo $this->_tpl_vars['mName']; ?>
</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<tr height="20" bgcolor="#B2B3B5">
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mName']):
?>
									<td align="center" class="font11b" width="5%">เกรด</td>
									<td align="center" class="font11b" width="5%">คะแนน</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<?php if ($this->_tpl_vars['dataArr']): ?>
								<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['depart']):
?>
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="14" align="left" class="font12">&nbsp;<?php echo $this->_tpl_vars['depart']['department']; ?>
</td>
								</tr>
								<?php $_from = $this->_tpl_vars['depart']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
								<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" >
									<td class="font12" align="center" ><?php if ($this->_tpl_vars['item']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['item']['user_code']; ?>
<?php endif; ?></td>
									<td align="left" class="font12" >&nbsp;<?php echo $this->_tpl_vars['item']['user_name']; ?>
</td>
									<td class="font11" align="left" >&nbsp;<?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td>
									<td class="font11" align="center" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<?php $this->assign('mph_grade', $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_grade']); ?>
									<td align="center" >
										<?php if ($this->_tpl_vars['mph_grade'] == 'A'): ?>
										<div class="font12BL"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_grade']; ?>
</div>
										<?php elseif ($this->_tpl_vars['mph_grade'] == 'F'): ?>
										<div class="font12R"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_grade']; ?>
</div>
										<?php else: ?>
										<div class="font12"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_grade']; ?>
</div>
										<?php endif; ?>
									</td>
									<td align="right" >
										<?php if ($this->_tpl_vars['mph_grade'] == 'A'): ?>
										<div class="font12BL"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</div>
										<?php elseif ($this->_tpl_vars['mph_grade'] == 'F'): ?>
										<div class="font12R"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</div>
										<?php else: ?>
										<div class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_totalscoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</div>
										<?php endif; ?>									
									</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<?php endforeach; endif; unset($_from); ?>
								<?php endforeach; endif; unset($_from); ?>
								<?php endif; ?>
				    		</table>
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
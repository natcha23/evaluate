<?php /* Smarty version 2.6.19, created on 2014-08-24 14:09:36
         compiled from portal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'portal.tpl', 27, false),array('function', 'cycle', 'portal.tpl', 52, false),array('function', 'add_script', 'portal.tpl', 161, false),)), $this); ?>
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
					  <tr bgcolor="#EBEBEB" height="25">
			   			<td class="font11" align="right" colspan="4" ><b>Department :</b>
							<select name="group" id="group" <?php if ($this->_tpl_vars['head_org']): ?>disabled<?php endif; ?> class="selectBox22" onchange="jsChange(this.value);" >
							<option value="">-- Show all --</option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

							</select>
							&nbsp;&nbsp;
			   			 </td>
		 			</tr>
			         <?php if ($this->_tpl_vars['typePage'] == 'MI'): ?>
			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="7%" rowspan="2" align="center" >รหัส</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >ชื่อ - สกุล </td>
									<!--td class="font11b" width="15%" rowspan="2" align="center" >Position</td-->
									<td class="font11b" width="4%" rowspan="2" align="center" >Level</td>
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<td class="font11b" align="center" <?php if ($this->_tpl_vars['monthNow'] == $this->_tpl_vars['keyM']): ?>bgcolor="#DDFFA7"<?php endif; ?> colspan="4"><?php echo $this->_tpl_vars['mName']; ?>
</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<tr height="20" bgcolor="#B2B3B5">
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mName']):
?>
									<td align="center" class="font11b" width="5%">Create</td>
									<td align="center" class="font11b" width="5%">Process</td>
									<td align="center" class="font11b" width="5%">Delay</td>
									<td align="center" class="font11b" width="5%">Finish</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr><!--bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#F5F6F7"), $this);?>
"-->
								<?php if ($this->_tpl_vars['dataArr']): ?>
								<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['depart']):
?>
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="20" align="left" class="font12">&nbsp;<?php echo $this->_tpl_vars['depart']['department']; ?>
</td>
								</tr>
								<?php $_from = $this->_tpl_vars['depart']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
								<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" >
									<td class="font11" align="center" ><?php if ($this->_tpl_vars['item']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['item']['user_code']; ?>
<?php endif; ?></td>
									<!--td align="left" class="font11" id="txt_link_user"><a href="javascript:openEvaluate('MI','<?php echo $this->_tpl_vars['item']['user_code']; ?>
');">&nbsp;<?php echo $this->_tpl_vars['item']['user_name']; ?>
</a></td-->
									<td align="left" class="font11" >&nbsp;<?php echo $this->_tpl_vars['item']['user_name']; ?>
 </td>
									<!--td class="font11" align="left" >&nbsp;<?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td-->
									<td class="font11" align="center" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<?php $this->assign('mph_user_flow', $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_user_flow']); ?>
									<td align="center" ><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_status'] == 'C'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/blue13.jpg" border="0" title="<?php echo $this->_tpl_vars['userOp'][$this->_tpl_vars['mph_user_flow']]['user_name']; ?>
"><?php endif; ?></td>
									<td align="center" ><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_status'] == 'P'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/pink13.jpg" border="0" title="<?php echo $this->_tpl_vars['userOp'][$this->_tpl_vars['mph_user_flow']]['user_name']; ?>
"><?php endif; ?></td>
									<td align="center" ><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_status'] == 'R'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/red13.jpg" border="0" title="<?php echo $this->_tpl_vars['userOp'][$this->_tpl_vars['mph_user_flow']]['user_name']; ?>
"><?php endif; ?></td>
									<td align="center" ><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_status'] == 'F'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/green13.jpg" border="0" title="<?php echo $this->_tpl_vars['userOp'][$this->_tpl_vars['mph_user_flow']]['user_name']; ?>
"><?php endif; ?></td>
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
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="7%" rowspan="2" align="center" >รหัส</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >ชื่อ - สกุล</td>
									<!--td class="font11b" width="15%" rowspan="2" align="center" >Position</td-->
									<td class="font11b" width="4%" rowspan="2" align="center" >Level</td>
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<td class="font11b" align="center" <?php if ($this->_tpl_vars['monthNow'] == $this->_tpl_vars['keyM']): ?>bgcolor="#DDFFA7"<?php endif; ?> colspan="4"><?php echo $this->_tpl_vars['mName']; ?>
</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<tr height="20" bgcolor="#B2B3B5">
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mName']):
?>
									<td align="center" class="font11b" width="5%">Create</td>
									<td align="center" class="font11b" width="5%">Process</td>
									<td align="center" class="font11b" width="5%">Delay</td>
									<td align="center" class="font11b" width="5%">Finish</td>
									<?php endforeach; endif; unset($_from); ?>
								</tr><!--bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#F5F6F7"), $this);?>
"-->
								<?php if ($this->_tpl_vars['dataArr']): ?>
								<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['depart']):
?>
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="20" align="left" class="font12">&nbsp;<?php echo $this->_tpl_vars['depart']['department']; ?>
</td>
								</tr>
								<?php $_from = $this->_tpl_vars['depart']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
								<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" >
									<td class="font11" align="center" ><?php if ($this->_tpl_vars['item']['user_code'] == '0'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['item']['user_code']; ?>
<?php endif; ?></td>
									<!--td align="left" class="font11" id="txt_link_user"><a href="javascript:openEvaluate('PI','<?php echo $this->_tpl_vars['item']['user_code']; ?>
');">&nbsp;<?php echo $this->_tpl_vars['item']['user_name']; ?>
</a></td-->
									<td align="left" class="font11">&nbsp;<?php echo $this->_tpl_vars['item']['user_name']; ?>
 </td>
									<!--td class="font11" align="left" >&nbsp;<?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td-->
									<td class="font11" align="center" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
									<?php $_from = $this->_tpl_vars['monthOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<?php $this->assign('mph_user_flow', $this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_user_flow']); ?>
									<td align="center" ><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_status'] == 'C'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/blue13.jpg" border="0" title="<?php echo $this->_tpl_vars['userOp'][$this->_tpl_vars['mph_user_flow']]['user_name']; ?>
"><?php endif; ?></td>
									<td align="center" ><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_status'] == 'P'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/pink13.jpg" border="0" title="<?php echo $this->_tpl_vars['userOp'][$this->_tpl_vars['mph_user_flow']]['user_name']; ?>
"><?php endif; ?></td>
									<td align="center" ><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_status'] == 'R'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/red13.jpg" border="0" title="<?php echo $this->_tpl_vars['userOp'][$this->_tpl_vars['mph_user_flow']]['user_name']; ?>
"><?php endif; ?></td>
									<td align="center" ><?php if ($this->_tpl_vars['rowsArr'][$this->_tpl_vars['item']['user_code']][$this->_tpl_vars['keyM']]['mph_status'] == 'F'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/green13.jpg" border="0" title="<?php echo $this->_tpl_vars['userOp'][$this->_tpl_vars['mph_user_flow']]['user_name']; ?>
"><?php endif; ?></td>
									<?php endforeach; endif; unset($_from); ?>
								</tr>
								<?php endforeach; endif; unset($_from); ?>
								<?php endforeach; endif; unset($_from); ?>
								<?php endif; ?>
				    		</table>
				    	</td>
				    </tr>
				    <?php endif; ?>
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<?php if (! $this->_tpl_vars['show'] == 'N'): ?>
								<input id="btn_list" title="View" class="btn_tools" onclick="openPage('workflow/evaluate/portal/form_id/<?php echo $this->_tpl_vars['form_id']; ?>
/form_type/<?php echo $this->_tpl_vars['form_type']; ?>
');" value=" Process " type="button">
								<?php if ($this->_tpl_vars['form_type'] == MI): ?>
								<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/createmi/form_id/<?php echo $this->_tpl_vars['form_id']; ?>
/form_type/<?php echo $this->_tpl_vars['form_type']; ?>
');" value="  Back " type="button">
								<?php else: ?>
								<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/createpi/form_id/<?php echo $this->_tpl_vars['form_id']; ?>
/form_type/<?php echo $this->_tpl_vars['form_type']; ?>
');" value="  Back " type="button">
								<?php endif; ?>
							<?php endif; ?><input type="hidden" name="show" value="<?php echo $this->_tpl_vars['show']; ?>
">
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
<?php /* Smarty version 2.6.19, created on 2014-08-24 14:09:33
         compiled from summary/portal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'summary/portal.tpl', 30, false),array('function', 'cycle', 'summary/portal.tpl', 67, false),array('function', 'add_script', 'summary/portal.tpl', 120, false),)), $this); ?>
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
					  <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#EBEBEB" height="25">
						   			<td class="font11" align="left" colspan="4" >&nbsp;<b>Select : </b>
										<select name="fields[type]" id="type" class="selectBox7" onchange="jsShowTime(this.value)" >
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['typeOp'],'selected' => $this->_tpl_vars['typenow']), $this);?>

										</select>
										<select name="fields[month]" id="month" class="selectBox10" >
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['monthOp'],'selected' => $this->_tpl_vars['monthNow']), $this);?>

										</select>
										<select name="fields[quarter]" id="quarter" class="selectBox10" style="display:none">
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['quarterOp'],'selected' => $this->_tpl_vars['monthNow']), $this);?>

										</select>
										<select name="fields[year]" id="year" class="selectBox7"  >
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yearOp'],'selected' => $this->_tpl_vars['yearNow']), $this);?>

										</select>
										<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">
						   			 </td>
						   			<td class="font11" align="right" colspan="8" ><b>Department :</b>
										<select name="group" id="group" <?php if ($this->_tpl_vars['head_org']): ?>disabled<?php endif; ?> class="selectBox25" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

										</select>
										&nbsp;&nbsp;
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="6%" align="center" >รหัส</td>
									<td class="font11b" width="15%" align="center" >ชื่อ - สกุล</td>
									<td class="font11b" width="15%" align="center" >Position</td>
									<td class="font11b" width="4%" align="center" >Level</td>
									<?php $_from = $this->_tpl_vars['levelOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mName']):
?>
									<td class="font11b" align="center" width="5%"><?php echo $this->_tpl_vars['mName']; ?>
</td>
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
									<td class="font11" align="center" ><?php if ($this->_tpl_vars['item']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['item']['user_code']; ?>
<?php endif; ?></td>
									<td align="left" class="font11" id="txt_link_user"><!--a href="javascript:openEvaluate('MI','<?php echo $this->_tpl_vars['item']['user_code']; ?>
');"-->&nbsp;<?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>
<!--/a--></td>
									<td class="font11" align="left" >&nbsp;<?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td>
									<td class="font11" align="center" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
									<?php $_from = $this->_tpl_vars['levelOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyM'] => $this->_tpl_vars['mName']):
?>
									<td align="center" >
									<?php if ($this->_tpl_vars['mName'] == $this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['level_name']): ?>
										<?php if ($this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['mph_status'] == 'C'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/blue13.jpg" border="0"  title="<?php echo $this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['name_user_flow']; ?>
"><?php endif; ?>
										<?php if ($this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['mph_status'] == 'P'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/pink13.jpg" border="0" title="<?php echo $this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['name_user_flow']; ?>
"><?php endif; ?>
										<?php if ($this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['mph_status'] == 'R'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/red13.jpg" border="0"  title="<?php echo $this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['name_user_flow']; ?>
"><?php endif; ?>
										<?php if ($this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['mph_status'] == 'F'): ?><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/button/green13.jpg" border="0" title="<?php echo $this->_tpl_vars['stepArr'][$this->_tpl_vars['item']['user_code']]['name_user_flow']; ?>
"><?php endif; ?>
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
			       <tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<?php if ($this->_tpl_vars['form_type'] == 'MI'): ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/portalmi/form_id/<?php echo $this->_tpl_vars['form_id']; ?>
/form_type/<?php echo $this->_tpl_vars['form_type']; ?>
');" value="   Back " type="button">
							<?php elseif ($this->_tpl_vars['form_type'] == 'PI'): ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/portalpi/form_id/<?php echo $this->_tpl_vars['form_id']; ?>
/form_type/<?php echo $this->_tpl_vars['form_type']; ?>
');" value="   Back " type="button">
							<?php endif; ?>
							&nbsp;
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
<script>
	var typeshow = '<?php echo $this->_tpl_vars['typenow']; ?>
';
	jsShowTime(typeshow);

</script>
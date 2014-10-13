<?php /* Smarty version 2.6.19, created on 2014-06-20 16:11:30
         compiled from summary/_printhtml.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'summary/_printhtml.tpl', 50, false),array('modifier', 'number_format', 'summary/_printhtml.tpl', 56, false),)), $this); ?>
<?php 
        header("Content-Type: text/html; charset=utf-8");
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>-:: Print Report Data ::-</title>
</head>
<body>
<div id="content-container">
	<form method="post" action="" id="_portal" enctype="multipart/form-data" >
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" bgcolor="#FFFFFF">
					<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr><td colspan="2" height="38" align="center">&nbsp;</td></tr>
						<tr>
					    	<td colspan="2" align="center">
					    		<table cellpadding="0" cellspacing="1" width="100%" border="0" >
						    		<tr align="center" >
						                <td style="font-size: 14px;" height="38" ><b><?php echo $this->_tpl_vars['headPage']; ?>
</b></td>
					              	</tr>
					    		</table>
		        			</td>
						 </tr>
						 <tr bgcolor="#EBEBEB" id="print">
							<td colspan="2" align="right" >
								<input type="button" id="btn_print" class="btn_tools" value="Print Report" onclick="jsPrint();">
								<input type="button" id="btn_colse" class="btn_tools" value="Close" onclick="window.close();">
							</td>
						</tr>
						<tr>
					    	<td colspan="2" align="center">
					    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
									<tr bgcolor="#CFCFCF" height="30">
										<td style="font-size: 12px;" width="10%" align="center" ><b>Emp. Code</b></td>
										<td style="font-size: 12px;" width="20%" align="center" ><b>Emp. Name</b></td>
										<td style="font-size: 12px;" align="center" ><b>Position</b></td>
										<td style="font-size: 12px;" width="10%" align="center" ><b>Level</b></td>
										<td style="font-size: 12px;" width="10%" align="center" ><b>Grade</b></td>
										<td style="font-size: 12px;" width="15%" align="center" ><b>Incentive</b></td>
									</tr>
									<?php if ($this->_tpl_vars['dataArr']): ?>
									<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['depart']):
?>
									<tr height="20" bgcolor="#FFE7BA" >
										<td colspan="6" align="left" style="font-size: 12px;">&nbsp;<b><?php echo $this->_tpl_vars['depart']['department']; ?>
</b></td>
									</tr>
										<?php $_from = $this->_tpl_vars['depart']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['item']):
?>
										<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#E8E8E8"), $this);?>
" >
											<td style="font-size: 11px;" align="center" ><?php if ($this->_tpl_vars['item']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['item']['user_code']; ?>
<?php endif; ?></td>
											<td align="left" style="font-size: 11px;" ><?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>
</td>
											<td align="left" style="font-size: 11px;" ><?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td>
											<td align="center" style="font-size: 11px;" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
											<td align="center" style="font-size: 11px;"><?php echo $this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['mph_grade']; ?>
</td>
											<td align="right" style="font-size: 11px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowsArr'][$this->_tpl_vars['key']][$this->_tpl_vars['key1']]['incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
										</tr>
										<?php endforeach; endif; unset($_from); ?>
										<tr height="20" bgcolor="#b9b9b9">
											<td colspan="5" align="right" style="font-size: 12px;"><b>Summary Total</b></td>
											<td align="right" style="font-size: 12px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['incArr'][$this->_tpl_vars['key']]['sum_incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
										</tr>
									<?php endforeach; endif; unset($_from); ?>
									<tr height="20" bgcolor="#b9b9b9">
										<td colspan="5" align="right" style="font-size: 12px;"><b>Summary Total All</b></td>
										<td align="right" style="font-size: 12px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['totalArr']['sum_incentive'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
									</tr>
									<?php endif; ?>

								</table>
		        			</td>
						</tr>
						<tr><td colspan="2" height="20" align="center">&nbsp;</td></tr>
						<tr>
					    	<td colspan="2" align="left">
					    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="40%" border="0" style="border:1px solid #B9B9B9;">
									<tr style="font-size: 13px;" ><td><b>Total Grade</b></td></tr>
									<tr >
										<td>
											<table cellpadding="0" cellspacing="1" width="100%" >
												<tr height="20"  >
												<?php $_from = $this->_tpl_vars['gradeOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
													<td bgcolor="#b9b9b9" style="font-size: 12px;" width="10%" align="center" ><b><?php echo $this->_tpl_vars['item']; ?>
</b></td>
												<?php endforeach; endif; unset($_from); ?>
												</tr>
												<tr height="20"  >
												<?php $_from = $this->_tpl_vars['gradeOp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
													<td style="font-size: 12px;" width="10%" align="center" ><b><?php echo $this->_tpl_vars['gradeArr'][$this->_tpl_vars['item']]; ?>
</b></td>
												<?php endforeach; endif; unset($_from); ?>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr bgcolor="#EBEBEB" id="print1">
							<td colspan="2" align="right" >
								<input type="button" id="btn_print" class="btn_tools" value="Print Report" onclick="jsPrint();">
								<input type="button" id="btn_colse" class="btn_tools" value="Close" onclick="window.close();">
							</td>
						</tr>


					</table>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
<DIV style="page-break-after:always"></DIV>
<script language="javascript">
<?php echo '
 function jsPrint(){
 	document.getElementById(\'print\').style.display=\'none\';
 	document.getElementById(\'print1\').style.display=\'none\';
 	window.print();
 	window.location.reload();
 }
 '; ?>

</script>
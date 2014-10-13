<?php /* Smarty version 2.6.19, created on 2014-06-19 15:21:14
         compiled from view_portal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'view_portal.tpl', 37, false),array('function', 'add_script', 'view_portal.tpl', 81, false),array('modifier', 'date_format', 'view_portal.tpl', 45, false),)), $this); ?>
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
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;View Evaluate Work List</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
				    <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="3%" align="center" >ลำดับ</td>
									<td class="font11b" width="20%" align="center" >ชื่อ - สกุล</td>
									<td class="font11b" width="10%" align="center" >เดือนประเมิน</td>
									<td class="font11b" width="10%" align="center" >ประเภท</td>
									<td class="font11b" width="10%" align="center" >สถานะ</td>
									<td class="font11b" width="10%" align="center" >วันที่ส่ง</td>
									<td class="font11b" width="10%" align="center" >คนที่ส่ง</td>
									<td class="font11b" width="10%" align="center" >Action</td>
								</tr>
								<?php if ($this->_tpl_vars['rowsArr']): ?>
								<?php $this->assign('i', 1); ?>
								<?php $_from = $this->_tpl_vars['rowsArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
								<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" >
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['i']; ?>
</td>
									<td class="font12" align="left" >&nbsp;<?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['item']['mph_month']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['item']['mph_type']; ?>
</td>
									<td class="font12" align="center" >
										<?php if ($this->_tpl_vars['item']['mph_status'] == C): ?>Create<?php elseif ($this->_tpl_vars['item']['mph_status'] == P): ?>Process<?php endif; ?>
									</td>
									<td class="font12" align="center" ><?php if ($this->_tpl_vars['item']['mph_datetime'] != '0000-00-00 00:00:00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mph_datetime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
<?php endif; ?></td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['item']['user_sendname']; ?>
</td>
									<td align="center" id="txt_link_user">
										<input id="btn_view" title="View" class="btn_tools" onclick="openPageEvaluate('<?php echo $this->_tpl_vars['item']['mph_type']; ?>
','<?php echo $this->_tpl_vars['item']['mph_id']; ?>
','<?php echo $this->_tpl_vars['item']['mph_user']; ?>
','<?php echo $this->_tpl_vars['item']['mph_month']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
');" value="   View" type="button">
									</td>
								</tr <?php echo $this->_tpl_vars['i']++; ?>
>
								<?php endforeach; endif; unset($_from); ?>
								<?php endif; ?>
				    		</table>
				    	</td>
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openLinkMenu('workflow/evaluate/urecive');" value="   Back " type="button">
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
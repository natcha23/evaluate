<?php /* Smarty version 2.6.19, created on 2014-08-22 15:46:42
         compiled from history.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'history.tpl', 49, false),array('function', 'html_pagination', 'history.tpl', 89, false),array('function', 'add_script', 'history.tpl', 104, false),)), $this); ?>
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
					                <td height="38" class="titlehead">&nbsp;History Send Form Active</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
				    <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
				    			<tr bgcolor="#C6DCFF" >
				    				<td class="font11b" colspan="9" align="left" >
				    					<input id="btn_delete" title="Delete" class="btn_tools" onclick="delMultiLine('delhis');" value="Delete" type="button">
									</td>
				    			</tr>
				    			<?php endif; ?>
				    			<tr bgcolor="#C6DCFF" height="30">
				    			 <?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
				    			 	<td class="font11b" width="3%" align="center" >
				    			 		<input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);">
				    			 	</td>
				    			 <?php endif; ?>
									<td class="font11b" width="4%" align="center" >No.</td>
									<td class="font11b" width="10%" align="center" >Type of flow</td>
									<td class="font11b" width="15%" align="center" >Form Month</td>
									<td class="font11b" width="15%" align="center" >User Owner</td>
									<td class="font11b" width="15%" align="center" >User Receive</td>
									<td class="font11b" width="15%" align="center" >Send Date</td>
									<td class="font11b" width="10%" align="center" >Status</td>
									<td class="font11b" width="10%" align="center" >Action</td>
								</tr>
								<?php if ($this->_tpl_vars['history']): ?>
								<?php $this->assign('loopH', 1); ?>
								<?php $_from = $this->_tpl_vars['history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['data']):
?>
								<tr height="20" <?php if ($this->_tpl_vars['data']['mph_status'] == 'C'): ?>bgcolor="#FFE7F6" <?php else: ?>bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" <?php endif; ?>id="tr_<?php echo $this->_tpl_vars['data']['mph_id']; ?>
">
									<?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
									<td class="font12" align="center" >
																				<input type='checkbox' class="border0" id="<?php echo $this->_tpl_vars['data']['mph_id']; ?>
" value='<?php echo $this->_tpl_vars['data']['mph_id']; ?>
'>
																			</td>
									<?php endif; ?>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['loopH']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['mph_type']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['mph_month']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['user_name_owner']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['user_name']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['mph_datetime']; ?>
</td>
									<td class="font12" align="center" >
									<?php if ($this->_tpl_vars['data']['mph_status'] == 'C'): ?>Create
									<?php elseif ($this->_tpl_vars['data']['mph_status'] == 'P'): ?>Process
									<?php elseif ($this->_tpl_vars['data']['mph_status'] == 'F'): ?>Finish
									<?php elseif ($this->_tpl_vars['data']['mph_status'] == 'R'): ?>Delay
									<?php endif; ?>
									</td>
									<td align="center" class="font12" id="txt_link_user">
										<input id="btn_edit" title="Edit" class="btn_tools" onclick="openPageEvaluate('<?php echo $this->_tpl_vars['data']['mph_type']; ?>
','<?php echo $this->_tpl_vars['data']['mph_id']; ?>
','<?php echo $this->_tpl_vars['data']['mph_user']; ?>
','<?php echo $this->_tpl_vars['data']['mph_month']; ?>
','E');" value="   Edit" type="button">
									</td>
								</tr <?php echo $this->_tpl_vars['loopH']++; ?>
>
								<?php endforeach; endif; unset($_from); ?>
								<?php endif; ?>
				    		</table>
				    	</td>
					<!--tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openLinkMenu('workflow/evaluate/urecive');" value="   Back " type="button">
						</td>
					</tr-->
				  <tr align="right">
				   		<td >
							<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
						   	<tbody>
						       	<tr align="right">
						           	<td width="12"><img width="12" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuleft.gif"/></td>
						            <td><?php echo $this->_plugins['function']['html_pagination'][0][0]->html_pagination(array('url' => $this->_tpl_vars['url'],'total' => $this->_tpl_vars['totalRecord'],'page' => $this->_tpl_vars['page'],'perpage' => $this->_tpl_vars['perpage']), $this);?>
&nbsp;</td>
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
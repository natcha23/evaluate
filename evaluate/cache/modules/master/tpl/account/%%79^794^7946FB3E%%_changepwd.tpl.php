<?php /* Smarty version 2.6.19, created on 2014-06-06 13:01:43
         compiled from account/_changepwd.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'add_script', 'account/_changepwd.tpl', 97, false),)), $this); ?>
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
										<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="changePwd();" value=" Save " type="button"><?php endif; ?>
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');" value=" Back " type="button">
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
										<input type="hidden" name="pwd" id="pwd" value="<?php echo $this->_tpl_vars['rows']['u_password']; ?>
" >
									</td>
								</tr>
								<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="98%" border="0" >
									    	<tr height="25">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">User Login</td>
										    	<td colspan="2" class="font12"><input type="text" name="fields[u_login]" id="u_login" value="<?php echo $this->_tpl_vars['rows']['u_login']; ?>
" class="textfield_5c" ></td>
									    	</tr>
									    	<tr height="25">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Password New</td>
										    	<td colspan="2" class="font12">
										    		<input type="password" name="fields[u_password]" id="u_password" value="" class="textfield_5c" >
										    		<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="button" onclick="$('#u_password').val('')">
										   		</td>
									    	</tr>
									    	<tr height="25">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Confirm Password</td>
										    	<td class="font12"><input type="password" name="pwd_con" id="pwd_con" value="" class="textfield_5c" ></td>
									    	</tr>

									    	<tr><td colspan="4" height="10" class="font12"></td></tr>
									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td colspan="2" align="right" >
										<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="changePwd();" value=" Save " type="button"><?php endif; ?>
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');" value=" Back " type="button">
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
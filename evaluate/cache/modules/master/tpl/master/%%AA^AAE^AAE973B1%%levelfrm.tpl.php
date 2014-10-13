<?php /* Smarty version 2.6.19, created on 2014-08-28 15:07:11
         compiled from levelfrm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'levelfrm.tpl', 53, false),array('function', 'html_options', 'levelfrm.tpl', 64, false),array('function', 'add_script', 'levelfrm.tpl', 113, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_levelfrm" enctype="multipart/form-data">
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
									<td align="right" >
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitLevel('<?php echo $this->_tpl_vars['grid']; ?>
');" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openLevelGrade('<?php echo $this->_tpl_vars['grade']; ?>
','<?php echo $this->_tpl_vars['grid']; ?>
');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" >
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="<?php echo $this->_tpl_vars['mode']; ?>
">
										<input type="hidden" name="grade" value="<?php echo $this->_tpl_vars['grid']; ?>
" >
										<input type="hidden" name="fields[lv_id]" value="<?php echo $this->_tpl_vars['rows']['lv_id']; ?>
" >
									</td>
								</tr>
				    			<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">เกรด</td>
										    	<td class="font12"><?php echo $this->_tpl_vars['grade']; ?>
</td>
									    	</tr>


									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">กลุ่มพนักงาน</td>
										    	<td class="font12">
										    	<?php echo smarty_function_html_radios(array('name' => "fields[lv_shotname]",'id' => 'lv_shotname','options' => $this->_tpl_vars['groupOp'],'checked' => $this->_tpl_vars['rows']['lv_shotname']), $this);?>


										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Code ระดับ</td>
										    	<td class="font12">
											    	<!--input type="text" name="fields[lv_code]" id="lv_code" value="<?php echo $this->_tpl_vars['rows']['lv_code']; ?>
" class="textfield_2c" maxLength="2" onKeyup="ckvNum(this);"-->
											    	<select name="fields[lv_code]" id="lv_code" class="selectBox7"  >
											    	<option value="">- Select -</option>
														<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['levelOp'],'selected' => $this->_tpl_vars['rows']['lv_code']), $this);?>

													</select>
										    	</td>
									    	</tr>
									    	<!--tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ชื่อเต็ม</td>
										    	<td class="font12"><input type="text" name="fields[lv_fullname]" id="lv_fullname" value="<?php echo $this->_tpl_vars['rows']['lv_fullname']; ?>
" class="textfield_5c" ></td>
									    	</tr-->
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">รายได้ (บาท)</td>
										    	<td class="font12"><input type="text" name="fields[money]" id="money" value="<?php echo $this->_tpl_vars['rows']['money']; ?>
" class="textfield_5c" onKeyup="ckvNum(this);"></td>
									    	</tr>

									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td align="right" >
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitLevel('<?php echo $this->_tpl_vars['grid']; ?>
');" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openLevelGrade('<?php echo $this->_tpl_vars['grade']; ?>
','<?php echo $this->_tpl_vars['grid']; ?>
');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    		</table>
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/master.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
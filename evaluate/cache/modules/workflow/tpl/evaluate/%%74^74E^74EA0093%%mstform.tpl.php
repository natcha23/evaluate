<?php /* Smarty version 2.6.19, created on 2014-06-03 14:55:48
         compiled from mstform.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'mstform.tpl', 60, false),array('function', 'add_script', 'mstform.tpl', 104, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_mstfrm" enctype="multipart/form-data"  onSubmit="">
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
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="chekSavemst();" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/index/menu_id/<?php echo $this->_tpl_vars['mId']; ?>
');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" >
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="<?php echo $this->_tpl_vars['mode']; ?>
">
										<input type="hidden" name="fields[mst_eva_level]" value="<?php echo $this->_tpl_vars['level']; ?>
" >
										<input type="hidden" name="fields[mst_eva_id]" value="<?php echo $this->_tpl_vars['rows']['mst_eva_id']; ?>
" >
									</td>
								</tr>
								<tr>
									<td align="center">
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="98%" border="0" >
									    	<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">หัวข้อการประเมิน</td>
										    	<td class="font12"><input type="text" name="fields[mst_eva_name]" id="mst_eva_name" value="<?php echo $this->_tpl_vars['rows']['mst_eva_name']; ?>
" class="textfield_8c" maxLength=""></td>
									    	</tr>
									    	<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b" valign="top">รายละเอียดการประเมิน </td>
										    	<td>
										    		<TEXTAREA STYLE="width:300px; height:100px" name="fields[mst_eva_dsc]" id="mst_eva_dsc"><?php echo $this->_tpl_vars['rows']['mst_eva_dsc']; ?>
</TEXTAREA>
										    	</td>
									    	</tr>
									    	<?php if ($this->_tpl_vars['level'] == '1'): ?>
									    	<tr  height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ประเภท </td>
										    	<td class="font12">
										    		<select name="fields[mst_eva_type]" id="mst_eva_type" class="selectBox10" >
														<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['typeOp'],'selected' => $this->_tpl_vars['rows']['mst_eva_type']), $this);?>

													</select>
										    	</td>
									    	</tr>
											<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Order By</td>
										    	<td class="font12"><input type="text" name="fields[mst_eva_order]" id="mst_eva_order" value="<?php echo $this->_tpl_vars['rows']['mst_eva_order']; ?>
" class="textfield_2c" onKeyup="ckvNum(this);"></td>
									    	</tr>
									    	<?php endif; ?>
									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td align="right" >
											<?php if ($this->_tpl_vars['mode'] != 'view'): ?><input id="btn_save" title="Save" class="btn_tools" onclick="chekSavemst();" value=" Save " type="button"><?php endif; ?>
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/index/menu_id/<?php echo $this->_tpl_vars['mId']; ?>
');" value=" Back " type="button">
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
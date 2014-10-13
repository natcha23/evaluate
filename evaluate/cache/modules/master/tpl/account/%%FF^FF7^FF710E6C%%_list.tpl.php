<?php /* Smarty version 2.6.19, created on 2014-08-24 14:09:49
         compiled from account/_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'account/_list.tpl', 35, false),array('function', 'cycle', 'account/_list.tpl', 60, false),array('function', 'html_pagination', 'account/_list.tpl', 93, false),array('function', 'add_script', 'account/_list.tpl', 108, false),array('modifier', 'date_format', 'account/_list.tpl', 74, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="mst_list">
<form method="post" action="" id="_frm" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<input type="hidden" name="fields_sort" id="fields_sort" value="<?php echo $_POST['fields_sort']; ?>
">
<input type="hidden" name="order" id="order" value="<?php echo $_POST['order']; ?>
">
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
				    			<tr height="25" >
					    			<td colspan="5" align="left" >
					    				<?php if ($this->_tpl_vars['type'] != Sal): ?>
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="pageAccount('','new');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('account');" value=" Delete" type="button">
					    				<?php endif; ?>
					    			</td>
					    			<td colspan="8" align="right">
					    				<select name="status" id="status" class="selectBox3cm" onchange="jsSearch();">
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statusOp'],'selected' => $this->_tpl_vars['status']), $this);?>

										</select>
					    				<input type="text" name="keyword" id="keyword" value="<?php echo $this->_tpl_vars['keyword']; ?>
" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<?php if ($this->_tpl_vars['type'] != Sal): ?>
				    				<td class="font11b" align="center" width="2%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				<?php endif; ?>
				    				<td class="font11b" align="center" width="3%"> No. </td>
				    				<td class="font11b" align="center" width="7%" onClick="SortData('user_code');">Emp.Code <?php echo $this->_tpl_vars['order_by']['user_code']; ?>
</td>
				    				<td class="font11b" align="center" width="20%" onClick="SortData('user_name');"> Emp. Name <?php echo $this->_tpl_vars['order_by']['user_name']; ?>
</td>
				    				<td class="font11b" align="center" width="15%" onClick="SortData('user_email');"> E-mail <?php echo $this->_tpl_vars['order_by']['user_email']; ?>
</td>
				    				<td class="font11b" align="center" width="9%" onClick="SortData('user_mobile');"> Mobile <?php echo $this->_tpl_vars['order_by']['user_mobile']; ?>
</td>
				    				<td class="font11b" align="center" width="15%" onClick="SortData('org_position_name_th');"> Position <?php echo $this->_tpl_vars['order_by']['org_position_name_th']; ?>
</td>
				    				<td class="font11b" align="center" width="5%" onClick="SortData('org_position_level');"> Level <?php echo $this->_tpl_vars['order_by']['org_position_level']; ?>
</td>
				    				<td class="font11b" align="center" width="5%"> Group Menu </td>
				    				<td class="font11b" align="center" width="5%"> Header </td>
				    				<td class="font11b" align="center" width="7%"> Status </td>
				    				<td class="font11b" align="center" width="10%"> Time update </td>
				    				<td class="font11b" align="center" width="7%"> Action </td>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" id="tr_<?php echo $this->_tpl_vars['item']['user_id']; ?>
">
				    				<?php if ($this->_tpl_vars['type'] != Sal): ?>
				    				<td align="center" ><input type='checkbox' class="border0" id="<?php echo $this->_tpl_vars['item']['user_id']; ?>
" value='<?php echo $this->_tpl_vars['item']['user_id']; ?>
'></td>
				    				<?php endif; ?>
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['loopH']; ?>
</td>
				    				<td align="center" class="font11" width="7%"><?php if ($this->_tpl_vars['item']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['item']['user_code']; ?>
<?php endif; ?></td>
				    				<td align="left" class="font11" ><?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>
</td>
				    				<td align="left" class="font11" ><?php echo $this->_tpl_vars['item']['user_email']; ?>
</td>
				    				<td align="center" class="font11" ><?php echo $this->_tpl_vars['item']['user_mobile']; ?>
</td>
				    				<td align="left" class="font11"><?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td>
				    				<td align="center" class="font11" ><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
				    				<td align="center" class="font11" ><?php echo $this->_tpl_vars['item']['lookup_code']; ?>
</td>
				    				<td align="center" class="font11" ><?php echo $this->_tpl_vars['item']['user_header']; ?>
</td>
				    				<td align="center" class="font11" ><?php if ($this->_tpl_vars['item']['user_active'] == Y): ?>Active<?php else: ?>Inactive<?php endif; ?></td>
				    				<td align="center" class="font11"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['updatetime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
				    				<td align="center" class="font11" id="txt_link_user" nowrap>
				    					<?php if ($this->_tpl_vars['type'] != Sal): ?>
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="pageAccount('<?php echo $this->_tpl_vars['item']['user_id']; ?>
','edit');" value="  Edit" type="button">
				    					<?php else: ?>
				    					<input id="btn_view" title="Salary" class="btn_tools" onclick="pageSalary('<?php echo $this->_tpl_vars['item']['user_code']; ?>
');" value="  Salary" type="button">
				    					<?php endif; ?>
				    				</td>
				    			</tr <?php echo $this->_tpl_vars['loopH']++; ?>
>
					    		<?php endforeach; endif; unset($_from); ?>
				    		</table>
				    	</td>
				    </tr>
			        <tr align="right">
			            <td colspan="2">
			            <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
			                <tbody>
			                    <tr align="right">
			                        <td width="12"><img width="12" height="19" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuleft.gif"/></td>
			                        <td><?php echo $this->_plugins['function']['html_pagination'][0][0]->html_pagination(array('url' => $this->_tpl_vars['url'],'total' => $this->_tpl_vars['totalRecord'],'page' => $this->_tpl_vars['page'],'perpage' => $this->_tpl_vars['perpage']), $this);?>
</td>
			                        <td width="12"><img width="12" height="19" src="<?php echo $this->_tpl_vars['g_image']; ?>
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/account.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
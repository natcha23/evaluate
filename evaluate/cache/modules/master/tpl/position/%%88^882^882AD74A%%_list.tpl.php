<?php /* Smarty version 2.6.19, created on 2014-09-02 15:40:58
         compiled from position/_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'position/_list.tpl', 35, false),array('function', 'cycle', 'position/_list.tpl', 53, false),array('function', 'html_pagination', 'position/_list.tpl', 75, false),array('function', 'add_script', 'position/_list.tpl', 90, false),)), $this); ?>
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
					    			<td colspan="3" align="left" >
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="pagePosition('','new');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('position');" value=" Delete" type="button">
					    			</td>
					    			<td colspan="4" align="right">
					    				<span class="font11b">Status :</span>
					    				<select name="status" id="status" class="selectBox3cm" onchange="jsSearch();">
										<option value="">--Select All--</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statusOp'],'selected' => $this->_tpl_vars['status']), $this);?>

										</select>
					    				<input type="text" name="keyword" id="keyword" value="<?php echo $this->_tpl_vars['keyword']; ?>
" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    								    				<td class="font11b" align="center" width="10%" style="cursor:pointer" onClick="SortData('org_position_code');"> Code <?php echo $this->_tpl_vars['order_by']['org_position_code']; ?>
</td>
				    				<td class="font11b" align="center" width="30%" style="cursor:pointer" onClick="SortData('org_position_name_th');"> Position TH <?php echo $this->_tpl_vars['order_by']['org_position_name_th']; ?>
</td>
				    				<td class="font11b" align="center" width="30%" style="cursor:pointer" onClick="SortData('org_position_name_en');"> Position EN <?php echo $this->_tpl_vars['order_by']['org_position_name_en']; ?>
</td>
				    				<td class="font11b" align="center" width="10%" style="cursor:pointer" onClick="SortData('org_position_level');"> Position Level <?php echo $this->_tpl_vars['order_by']['org_position_level']; ?>
</td>
				    				<td class="font11b" align="center" width="10%"> Status </td>
				    				<td class="font11b" align="center" width="10%"> แก้ไข </td>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" id="tr_<?php echo $this->_tpl_vars['item']['org_position_id']; ?>
">
				    				<td align="center" ><input type='checkbox' class="border0" id="<?php echo $this->_tpl_vars['item']['org_position_id']; ?>
" value="<?php echo $this->_tpl_vars['item']['org_position_id']; ?>
"></td>
				    								    				<td align="center" class="font12" ><?php echo $this->_tpl_vars['item']['org_position_code']; ?>
</td>
				    				<td align="left" class="font12" ><?php echo $this->_tpl_vars['item']['org_position_name_th']; ?>
</td>
				    				<td align="left" class="font12" ><?php echo $this->_tpl_vars['item']['org_position_name_en']; ?>
</td>
				    				<td align="center" class="font12"><?php echo $this->_tpl_vars['item']['org_position_level']; ?>
</td>
				    				<td align="center" class="font12" ><?php echo $this->_tpl_vars['statusOp'][$this->_tpl_vars['item']['org_position_status']]; ?>
</td>
				    				<td align="center" class="font12" id="txt_link_user" nowrap>
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="pagePosition('<?php echo $this->_tpl_vars['item']['org_position_id']; ?>
','edit');" value="  Edit" type="button">
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/position.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
<?php /* Smarty version 2.6.19, created on 2014-08-21 16:34:02
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 51, false),array('function', 'add_script', 'index.tpl', 98, false),)), $this); ?>
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
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="openPageEvalmst('new','','<?php echo $this->_tpl_vars['mId']; ?>
','1');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('evaluate','master_evaluate','mst_eva_id');" value=" Delete" type="button">
					    			</td>
					    			<td colspan="4" align="right">
					    				<input type="text" name="keyword" id="keyword" value="<?php echo $this->_tpl_vars['keyword']; ?>
" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="tdhead" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font11b" align="center" width="4%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="25%"> หัวข้อการประเมิน </td>
				    				<td class="font11b" align="center"> รายละเอียดการประเมิน </td>
				    				<td class="font11b" align="center" width="8%"> ประเภท </td>
				    				<td class="font11b" align="center" width="8%"> วันที่แก้ไข </td>
				    				<td class="font11b" align="center" width="10%"> Action </td>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="#EBEBEB" id="tr_<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
">
				    				<td align="center" ><input type='checkbox' class="border0" id="<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
" value='<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
'></td>
				    				<td class="font11" align="center"><?php echo $this->_tpl_vars['loopH']; ?>
</td>
				    				<td class="font11" align="left">&nbsp;<?php echo $this->_tpl_vars['item']['mst_eva_name']; ?>
</td>
				    				<td class="font11" align="left">&nbsp;<?php echo $this->_tpl_vars['item']['mst_eva_dsc']; ?>
</td>
				    				<td class="font11" align="center"><?php echo $this->_tpl_vars['item']['mst_eva_type']; ?>
</td>
				    				<td class="font11" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['datetime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
				    				<td class="font11" align="center" nowrap>
				    					<?php if ($this->_tpl_vars['item']['mst_eva_type'] == PI): ?>
				    					<input id="btn_new" title="Add Sub" class="btn_tools" onclick="addSubEval('new','<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
','<?php echo $this->_tpl_vars['item']['mst_eva_type']; ?>
','<?php echo $this->_tpl_vars['mId']; ?>
');" value="  Add Sub" type="button">
				    					<?php else: ?>
				    					<input id="btn_disabled_new" title="Add Sub" class="btn_tools" value="  Add Sub" type="button">
				    					<?php endif; ?>
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="openPageEvalmst('edit','<?php echo $this->_tpl_vars['item']['mst_eva_id']; ?>
','<?php echo $this->_tpl_vars['mId']; ?>
','<?php echo $this->_tpl_vars['item']['mst_eva_level']; ?>
');" value="  Edit" type="button">
									</td>
				    			</tr>
				    			<?php $this->assign('loopH', $this->_tpl_vars['loopH']+1); ?>
				    			<?php $_from = $this->_tpl_vars['item']['dataLine']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyL'] => $this->_tpl_vars['line']):
?>
								<tr height="20" id="tr_<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
">
								    	<td class="font11" align="right"></td>
								    	<td class="font11" align="right">-</td>
								    	<td class="font11" align="left">&nbsp;<?php echo $this->_tpl_vars['line']['mst_eva_name']; ?>
</td>
								    	<td class="font11" align="left">&nbsp;<?php echo $this->_tpl_vars['line']['mst_eva_dsc']; ?>
</td>
								    	<td class="font11" align="left">&nbsp;</td>
								    	<td class="font11" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['line']['datetime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
								    	<td class="font11" align="left">
								    		<input id="btn_edit" title="Edit" class="btn_tools" onclick="openPageEvalmst('edit','<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
','<?php echo $this->_tpl_vars['mId']; ?>
','<?php echo $this->_tpl_vars['line']['mst_eva_level']; ?>
');" value="  Edit" type="button">
								    		<input id="btn_delete" title="Dellete" class="btn_tools" onclick="DelRecord('<?php echo $this->_tpl_vars['line']['mst_eva_id']; ?>
');" value="  Delete" type="button">
					    		    	</td>
								 </tr>
								 <?php endforeach; endif; unset($_from); ?>
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
				                        <td></td>
				                        <td width="12"><img width="12" height="19" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuright.gif"/></td>
				                    </tr>
				                </tbody>
				            </table>
			            </td>
			        </tr>
	        <!-- end detail-->
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
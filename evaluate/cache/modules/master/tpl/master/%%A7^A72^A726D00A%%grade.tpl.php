<?php /* Smarty version 2.6.19, created on 2014-09-09 13:09:06
         compiled from grade.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'grade.tpl', 44, false),array('function', 'add_script', 'grade.tpl', 84, false),array('modifier', 'number_format', 'grade.tpl', 47, false),array('modifier', 'date_format', 'grade.tpl', 49, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_grade" enctype="multipart/form-data">
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
					    			<td colspan="2" align="left" >
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="openPageGrade('new','');" value= "Create New" type="button">
					    				<!--input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('form');" value=" Delete" type="button"-->
					    			</td>
					    			<td colspan="4" align="right">
					    				<!--input type="text" name="keyword" id="keyword" value="<?php echo $this->_tpl_vars['keyword']; ?>
" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button"-->
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="5%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="25%"> ระดับเกรด </td>
				    				<td class="font11b" align="center" width="10%"> คะแนนเริ่มต้น </td>
				    				<td class="font11b" align="center" width="10%"> คะแนนสิ้นสุด </td>
				    				<td class="font11b" align="center" width="10%"> วันที่แก้ไข </td>
				    				<td class="font11b" align="center" width="15%"> แก้ไข </td>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" id="tr_<?php echo $this->_tpl_vars['item']['gr_id']; ?>
">
				    				<td align="center" class="font12"><?php echo $this->_tpl_vars['loopH']; ?>
</td>
				    				<td align="center" class="font12" ><?php echo $this->_tpl_vars['item']['grade']; ?>
</td>
				    				<td align="center" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['start_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td>
				    				<td align="center" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['end_scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td>
				    				<td align="center" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['datetime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
				    				<td align="center" class="font12" id="txt_link_user" nowrap>
				    					<input id="btn_new" title="Add Level" class="btn_tools" onclick="openLevelGrade('<?php echo $this->_tpl_vars['item']['grade']; ?>
','<?php echo $this->_tpl_vars['item']['gr_id']; ?>
');" value="  Level" type="button">
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="openPageGrade('edit','<?php echo $this->_tpl_vars['item']['gr_id']; ?>
');" value="  Edit" type="button">
										<input id="btn_del_line" title="Delete" class="btn_tools" onclick="deleteRow('<?php echo $this->_tpl_vars['item']['gr_id']; ?>
');" value="  Delete" type="button">
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
			                        <td></td>
			                        <td width="12"><img width="12" height="19" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuright.gif"/></td>
			                    </tr>
			                </tbody>
			            </table>
			            </td>
			        </tr>
			        <tr>
			            <td colspan="2">&nbsp;</td>
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
<?php /* Smarty version 2.6.19, created on 2014-10-01 15:50:49
         compiled from form/_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'form/_list.tpl', 53, false),array('function', 'html_pagination', 'form/_list.tpl', 77, false),array('function', 'cycle', 'form/_list.tpl', 127, false),array('function', 'add_script', 'form/_list.tpl', 168, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="mst_list2">
<form method="post" action="" id="_frm" enctype="multipart/form-data">
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
				    		<table id="mst_list" bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr height="25" >
					    			<td colspan="4" align="left" >
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="pageFormEva('','new');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('form');" value=" Delete" type="button">
					    			</td>
					    			<td colspan="7" align="right">
					    				<input type="text" name="keyword" id="keyword" value="<?php echo $this->_tpl_vars['keyword']; ?>
" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font11b" align="center" width="5%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="10%"> เลขที่ฟอร์ม </td>
				    				<td class="font11b" align="center" width="25%"> ชื่อฟอร์ม </td>
				    				<td class="font11b" align="center" width="10%"> วันเริ่มใช้ฟอร์ม </td>
				    				<td class="font11b" align="center" width="10%"> วันสิ้นสุดใช้ฟอร์ม </td>
				    				<td class="font11b" align="center" width="10%"> ประเภท </td>
				    				<td class="font11b" align="center" width="10%"> สถานะ </td>
				    				<td class="font11b" align="center" width="10%"> วันที่แก้ไขล่าสุด </td>
				    				<td class="font11b" align="center" width="13%"> แก้ไข </td>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="#F5F6F7" id="tr_<?php echo $this->_tpl_vars['item']['form_id']; ?>
">
				    				<td align="center" ><input type='checkbox' class="border0" id="<?php echo $this->_tpl_vars['item']['form_id']; ?>
" value='<?php echo $this->_tpl_vars['item']['form_id']; ?>
'></td>
				    				<td align="center" class="font12"><?php echo $this->_tpl_vars['loopH']; ?>
</td>
				    				<td align="center" class="font12" ><?php echo $this->_tpl_vars['item']['form_code']; ?>
</td>
				    				<td align="left" class="font12" ><?php echo $this->_tpl_vars['item']['form_name']; ?>
</td>
				    				<td align="center" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['form_stdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
				    				<td align="center" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['form_enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
				    				<td align="center" class="font12" ><?php echo $this->_tpl_vars['item']['form_type']; ?>
</td>
				    				<td align="center" class="font12" ><?php if ($this->_tpl_vars['item']['form_status'] == Y): ?>Active<?php else: ?>Inactive<?php endif; ?></td>
				    				<td align="center" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['updatetime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
				    				<td align="center" class="font12" id="txt_link_user" nowrap>
				    					<?php if ($this->_tpl_vars['item']['create'] == N): ?>
				    					<input id="btn_disabled_new" title="Template" class="btn_tools" value="  Template" type="button">
				    					<?php else: ?>
				    					<input id="btn_new" title="Template" class="btn_tools" onclick="pageFormCreate('<?php echo $this->_tpl_vars['item']['form_id']; ?>
','<?php echo $this->_tpl_vars['item']['form_type']; ?>
');" value="  Template" type="button">
				    					<?php endif; ?>
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="pageFormEva('<?php echo $this->_tpl_vars['item']['form_id']; ?>
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
&nbsp;</td>
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
	      	<tr><td height="20" ></td></tr>
	      	<tr>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;Draft Form Evaluate of Header</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
			           <tr>
				    	<td colspan="2" align="center">
				    		<table id="mst_list1" bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr height="25" >
					    			<td colspan="9" align="left" >
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="delDraftMultiLine('form');" value=" Delete" type="button">
					    				<input id="btn_sent" title="Send Data" class="btn_tools" onclick="sendMultiLine('form');" value=" Send Data" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font11b" align="center" width="5%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="8%"> รหัสพนักงาน </td>
				    				<td class="font11b" align="center" width="20%"> คนรับคนแรก </td>
				    				<td class="font11b" align="center" width="5%"> ประเภท </td>
				    				<td class="font11b" align="center" width="8%"> ประเมินเดือน </td>
				    				<td class="font11b" align="center" > เจ้าของใบประเมิน </td>
				    				<td class="font11b" align="center" width="10%"> วันที่สร้าง </td>
				    				<td class="font11b" align="center" width="8%"> Group<br>Menu </td>
				    				<td class="font11b" align="center" width="8%" title="ผู้ใชัฟอร์มเริ่มต้น"> start flow </td>
				    				<td class="font11b" align="center" width="8%" title="ผู้ใช้ฟอร์มสิ้นสุด"> end flow </td>
				    				<td class="font11b" align="center" width="8%"> Action </td>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['copyArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#ECECED"), $this);?>
" id="trd_<?php echo $this->_tpl_vars['item']['drf_id']; ?>
">
				    				<td align="center" ><input type='checkbox' class="border0" id="<?php echo $this->_tpl_vars['item']['drf_id']; ?>
" value='<?php echo $this->_tpl_vars['item']['drf_id']; ?>
'></td>
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['loopH']; ?>
</td>
				    				<td align="center" class="font11" ><?php echo $this->_tpl_vars['item']['user_rec']; ?>
</td>
				    				<td align="left" class="font11" ><?php echo $this->_tpl_vars['item']['user_name']; ?>
 <?php echo $this->_tpl_vars['item']['user_lname']; ?>
</td>
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['item']['mph_type']; ?>
</td>
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['item']['month']; ?>
/<?php echo $this->_tpl_vars['item']['year']; ?>
</td>
				    				<td align="left" class="font11"><?php echo $this->_tpl_vars['item']['user_eva']; ?>
</td>
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['item']['createdate']; ?>
</td>
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['item']['lookup_code']; ?>
</td>
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['item']['mph_sflow']; ?>
</td>
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['item']['mph_eflow']; ?>
</td>
				    				<td align="center" class="font11" id="txt_link_user" nowrap>
				    					<input id="btn_view" title="View Draft" class="btn_tools" onclick="pageFormDraft('<?php echo $this->_tpl_vars['item']['drf_id']; ?>
','<?php echo $this->_tpl_vars['item']['form_code']; ?>
','<?php echo $this->_tpl_vars['item']['mph_type']; ?>
');" value="  View Draft" type="button">
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
			                        <td>&nbsp;</td>
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/form.js,".($this->_tpl_vars['g_js'])."/tinybox.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
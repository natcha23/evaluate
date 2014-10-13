<?php /* Smarty version 2.6.19, created on 2014-09-02 15:41:37
         compiled from userpopup.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'userpopup.tpl', 31, false),array('function', 'cycle', 'userpopup.tpl', 57, false),array('function', 'add_script', 'userpopup.tpl', 101, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header_popup.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form  method="post" action="" id="frmpopup" enctype="multipart/form-data">
	<table width="98%" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="1" style="border:0px solid #cccccc;" align="center">
		<tr >
			<td align="center" height="25" style="font-size: 14px;" width="98%" ><b><?php echo $this->_tpl_vars['headPage']; ?>
<b></td>
		</tr>
		<tr>
			<td align="right" >
				<?php if ($this->_tpl_vars['chk_code']): ?>
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="bttChkSubmit('<?php echo $this->_tpl_vars['pageview']; ?>
','<?php echo $this->_tpl_vars['accept']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['head']; ?>
');">
				<?php else: ?>
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="chekSubmit('<?php echo $this->_tpl_vars['pageview']; ?>
','<?php echo $this->_tpl_vars['accept']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['head']; ?>
');">
				<?php endif; ?>
				<input id="btn_close" title="Close" class="btn_tools" type="button" value=" Close " onclick="window.close();">&nbsp;
				<input type='hidden' name='search' id="search">
				<input type='hidden' name='search[month]' value="">
				<input type='hidden' name='search[year]' value="">
				<input type="hidden" name="pageview" value="<?php echo $this->_tpl_vars['pageview']; ?>
">
				<input type="hidden" name="accept" value="<?php echo $this->_tpl_vars['accept']; ?>
">
				<input type="hidden" name="status" value="<?php echo $this->_tpl_vars['status']; ?>
">
				<input type="hidden" name="chk_code" id="chk_code" value="<?php echo $this->_tpl_vars['chk_code']; ?>
">
			</td>
		</tr>
		<tr>
			<td align="center" >
				<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
			    	<tr bgcolor="#cccccc" height="25">
			   			<td class="font11" align="right" colspan="5" ><b>Department :</b>
							<select name="group" id="group" class="selectBox25" onchange="jsChange(this.value);" >
							<option value="all">-- Show all --</option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

							</select>
							<input type='text' name="keyword" value='<?php echo $this->_tpl_vars['keyword']; ?>
' size="20">
							<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">
			   			 	<!--&nbsp;<b>Position :</b>
							<select name="group" id="group" class="font12" onchange="jsChange(this.value);" >
							<option value="">-- Please Select --</option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

							</select-->
			   			 </td>
		 			</tr>
		 			<tr bgcolor="#cccccc" height="25">
			   			<td class="font11b" align="center" width="4%">
			   			<?php if ($this->_tpl_vars['pageview'] != 'mi' && $this->_tpl_vars['pageview'] != 'pi' && $this->_tpl_vars['head'] != 'Y'): ?>
			   			<input type='checkbox' name='checkId' value='checkId' onclick="selectChkAll(this);">
			   			<?php endif; ?>
			   			</td>
			   			<td class="font11b" align="center" width="8%"> รหัสพนักงาน</td>
		 				<td class="font11b" align="center" width="25%"> ชื่อ - สกุล </td>
		 				<?php if ($this->_tpl_vars['pageview'] != 'mi' && $this->_tpl_vars['pageview'] != 'pi' && $this->_tpl_vars['head'] != 'Y'): ?>
		 				<td class="font11b" align="center" width="7%"> Level </td>
		 				<?php endif; ?>
		 				<td class="font11b" align="center" width="35%"> ตำแหน่ง </td>
		 			</tr>
	    			<?php $this->assign('loopH', 1); ?>
			    	<?php $_from = $this->_tpl_vars['userEva']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['user']):
?>
			   		<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
">
		 				<td align="center" width="4%">
		 				<?php if ($this->_tpl_vars['pageview'] == 'mi' || $this->_tpl_vars['pageview'] == 'pi' || $this->_tpl_vars['head'] == 'Y'): ?>
		 				<input type='radio' name='checkId' id="<?php echo $this->_tpl_vars['user']['user_code']; ?>
" value='<?php echo $this->_tpl_vars['user']['user_code']; ?>
' title="<?php echo $this->_tpl_vars['user']['user_name']; ?>
 <?php echo $this->_tpl_vars['user']['user_lname']; ?>
">
		 				<?php else: ?>
		 				<input type='checkbox' name='uowner[<?php echo $this->_tpl_vars['user']['user_code']; ?>
][check]' id="<?php echo $this->_tpl_vars['user']['user_code']; ?>
" value='<?php echo $this->_tpl_vars['user']['user_code']; ?>
' title="<?php echo $this->_tpl_vars['user']['user_name']; ?>
 ">
		 				<?php endif; ?>
		 				</td>
			    		<td align="center" class="font12" width="8%"><?php if ($this->_tpl_vars['user']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['user']['user_code']; ?>
<?php endif; ?> </td>
			    		<td align="left" class="font12" width="25%">&nbsp;<?php echo $this->_tpl_vars['user']['user_name']; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['user']['user_lname']; ?>
</td>
			    		<?php if ($this->_tpl_vars['pageview'] != 'mi' && $this->_tpl_vars['pageview'] != 'pi' && $this->_tpl_vars['head'] != 'Y'): ?>
			    		<td align="center" class="font12" width="7%"><?php echo $this->_tpl_vars['user']['org_position_level']; ?>
</td>
			    		<?php endif; ?>
			    		<td align="left" class="font12" width="35%">&nbsp;<?php echo $this->_tpl_vars['user']['org_position_name_th']; ?>
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
		<tr>
			<td align="right" >
				<?php if ($this->_tpl_vars['chk_code']): ?>
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="bttChkSubmit('<?php echo $this->_tpl_vars['pageview']; ?>
','<?php echo $this->_tpl_vars['accept']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['head']; ?>
');">
				<?php else: ?>
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="chekSubmit('<?php echo $this->_tpl_vars['pageview']; ?>
','<?php echo $this->_tpl_vars['accept']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['head']; ?>
');">
				<?php endif; ?>
				<input id="btn_close" title="Close" class="btn_tools" type="button" value=" Close " onclick="window.close();">&nbsp;
			</td>
		</tr>
	</table>
</form>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
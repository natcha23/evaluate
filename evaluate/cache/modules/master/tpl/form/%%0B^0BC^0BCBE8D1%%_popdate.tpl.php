<?php /* Smarty version 2.6.19, created on 2014-10-01 15:50:55
         compiled from form/_popdate.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'form/_popdate.tpl', 34, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header_popup.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table width="100%"  border="0" cellspacing="0" cellpadding="2" style="border:1px solid #cccccc;" align="center">
	    <tr>
	    	<td align="center" bgcolor="#AEAECD" height="25" class="font12">
	    	<B><font color="#3333CC">Generate PI</font></B>
			</td>
		</tr>
		<tr>
			<td>

				<form name="maintanCredit" method="post" action="" id="maintanCredit" enctype="multipart/form-data">
				 <table width="100%"  border="0" cellspacing="0" cellpadding="2" style="border:1px solid #cccccc;">
		
					<tr height="25" valign="top" bgcolor="#C2D5FC">
						<td width="20%" align="right" class="font11"><b>User Receive (1st): </b>&nbsp;</td>
						<td align="left" class="font11">
							<textarea name="qhquono" id="" cols="60" rows="7" readonly><?php echo $this->_tpl_vars['rows']['uname']; ?>
</textarea>
							<input type="hidden" name="fields[uid]" size="7" value="<?php echo $this->_tpl_vars['rows']['uid']; ?>
" >
							<input type="hidden" name="fields[sid]" size="7" value="<?php echo $this->_tpl_vars['sid']; ?>
" >
						</td>
					</tr>
					<tr height="25" valign="top" bgcolor="#C2D5FC">
						<td width="20%" align="right" class="font11"><b>PI of Month (old): </b>&nbsp;</td>
						<td align="left" class="font11">
							<input type="text" name="month_old" size="13" readonly value="<?php echo $this->_tpl_vars['rows']['month']; ?>
" >
						</td>
					</tr>
					<tr height="25" valign="top" bgcolor="#C2D5FC">
						<td width="20%" align="right" class="font11"><b>PI of Month: </b>&nbsp;</td>
						<td align="left" class="font11">
							<select name="fields[month]" id="month" style="width:95px"  >
							<option value="">-- Select --</option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['MonthOp'],'selected' => $this->_tpl_vars['rows']['month']), $this);?>

							</select>
							* เลือกเพื่อเปลี่ยนเดือนประเมิน PI
						</td>
					</tr>
					

			</table>
			<input type="hidden" id="i"  size="5" >
			<table width="100%"  border="0" cellspacing="2" cellpadding="2" bgcolor="#dddddd">				
				<tr bgcolor="#EBEBEB">
					<td align="right" >
						<input id="btn_save" title="Save" class="btn_tools" value=" Generate PI " onclick="submitForm();" type="button">
						<input id="btn_close" title="Close" class="btn_tools" onclick="window.parent.TINY.box.hide();" value=" Close " type="button">
						&nbsp;
					</td>
				</tr>				
			</table>
		</form>
		</td>
	   </tr>
	  </table>

<script>
var reload = '<?php echo $this->_tpl_vars['reload']; ?>
';
<?php echo '
function submitForm(){
	if(confirm(\'Do you want to generate pi ?\')){
		document.forms[0].submit();
	}	
}
'; ?>

</script>
<?php if ($this->_tpl_vars['reload'] == 1): ?>
<script>
<?php echo '
	window.parent.location.reload();
	window.parent.TINY.box.hide();
'; ?>

</script>
<?php endif; ?>
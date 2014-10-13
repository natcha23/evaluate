<?php /* Smarty version 2.6.19, created on 2014-06-17 14:40:31
         compiled from PI/_formdetail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'PI/_formdetail.tpl', 147, false),array('modifier', 'number_format', 'PI/_formdetail.tpl', 154, false),array('function', 'cycle', 'PI/_formdetail.tpl', 176, false),array('function', 'add_script', 'PI/_formdetail.tpl', 344, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
	var IMG_URL = '<?php echo $this->_tpl_vars['IMG_URL']; ?>
';
	var user_code = '<?php echo $this->_tpl_vars['_profile']->user_code; ?>
';
	var stpage = '<?php echo $this->_tpl_vars['status']; ?>
';

<?php echo '
function ChkInt(obj) {
	if (ckvNumeric(obj.value) == false){
 			alert(\'pleases input number only.\');
 			obj.value = \'\';
 			obj.focus();
 			return false;
 	}
}
function ckvNumeric(sText) {
	   var ValidChars = \'0123456789.\';
	   var IsNumber=true;
	   var Char;
	   var Dot=0;
	   for (i = 0; i < sText.length && IsNumber == true; i++){
		      Char = sText.charAt(i);

		      if (ValidChars.indexOf(Char) == -1){
		         	IsNumber = false;
		      }
	   }
	   return IsNumber;
}
function ChkVal(elm){
	if(elm.value > 10){
		alert(\'You input point more than 10,Please check again.\');
		$(\'#\'+elm.id).val(\'\');
		return false;
	}
}
function _SumT(k,i){
	var sum_tscoll = 0;	
	var wscoll = $(\'#wscoll_\'+i).val().replace(/[\\,]/g,\'\')*1;
	var rscoll = $(\'#rscoll_\'+i).val().replace(/[\\,]/g,\'\')*1;

	if(rscoll > 10){
		alert(\'You input point more than 10,Please check again.\');
		$(\'#rscoll_\'+i).val(\'\');
		return false;
	}else{	
		var tscoll = wscoll * rscoll;
		$(\'#tscoll_\'+i).val(tscoll)		
		var sum_wscoll = 0;
		$(\'input[@id^=tscoll_\'+k+\'\\_]\').each(function(){
			sum_tscoll += $(this).val().replace(/[\\,]/g,\'\')*1;
		});
		$(\'#point_total_\'+k).html(sum_tscoll);	
	
		var params = \'_output=json&key=\'+k+\'&total=\'+sum_tscoll;
		var baseUrl = \'/\'+projectName+\'/workflow/evaluate/calgrade/\';
		AjaxContent.init({
			proxy : baseUrl,
		    container : \'content-container\',
		    overlay : true,
		    showLoadding: false,
		    htmlTemplate: null
		});
		AjaxContent.send(params,function(returnText){
		  	 if(returnText){
	    		eval(returnText);
	      		var sum_total ;
	       	 }
	   	});		
	}
}
function _SumW(){
	var sum_wscoll = 0;
	$(\'input[@id^=wscoll\\_]\').each(function(){
		sum_wscoll += $(this).val().replace(/[\\,]/g,\'\')*1;
	});
	$(\'#weight\').html(sum_wscoll);
	$(\'#sum_weight\').val(sum_wscoll);
}

'; ?>

</script>
<div id="content-container">
<form method="post" action="" id="_pifrm" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td width="3" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/line.jpg"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/line.jpg" width="3" height="6" /></td>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr bgcolor="#EBEBEB">
						<td colspan="2" align="right">
						
													
							<input id="btn_list" title="Send to approve" class="btn_tools" value="  Send to approve" onclick="bttSendTo('workflow/evaluate/userpopup/pageview/pi/code/<?php echo $this->_tpl_vars['key_chk']; ?>
/status/<?php echo $this->_tpl_vars['status']; ?>
');" type="button">
							<?php if ($this->_tpl_vars['lookup_code'] == 'AM'): ?>
							<input id="btn_accept" title="Approve" class="btn_tools" onclick="bttFinish('F','pi_admin','<?php echo $this->_tpl_vars['status']; ?>
','finish');" value="  Approve" type="button">
							<?php else: ?>
							<input id="btn_accept" title="Approve" class="btn_tools" onclick="bttFinish('F','pi','<?php echo $this->_tpl_vars['status']; ?>
','finish');" value="  Approve" type="button">
							<?php endif; ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/accept/type/PI');"  value="  Back" type="button">
							
						</td>
					  </tr>
					  <?php $_from = $this->_tpl_vars['headRows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keyH'] => $this->_tpl_vars['headArr']):
?>						  				  
					  <tr><td height="3"></td></tr>
			          <tr>
			            <td>			            	
			            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
				              <tr>
				                <td width="40"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Arrow-Left.gif" width="40" height="40" /></td>				                
				              	<td >&nbsp;&nbsp;&nbsp;<span class="style15"><?php echo $this->_tpl_vars['TabName']; ?>
 ของคุณ <?php echo $this->_tpl_vars['headArr']['user_name']; ?>
 <?php echo $this->_tpl_vars['headArr']['user_lname']; ?>
 (<?php if ($this->_tpl_vars['headArr']['mph_user'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
<?php endif; ?>) </span></td>
				              </tr>
			            	</table>
			            </td>
			          </tr>
			          
			          <tr>
			            <td>
							<table id="table_list" bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
									<tr bgcolor="#C6DCFF" height="30">
										<td class="font11b" width="3%" align="center" >ลำดับ</td>
								    	<td class="font11b" align="center" width="250">หัวข้อของการประเมิน</td>
								    	<td class="font11b" width="7%" align="center" >น้ำหนักคะแนน</td>								  
								    	<?php $this->assign('i', 1); ?>
								    	<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column'][$this->_tpl_vars['keyH']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
								    	<td class="font11" width="6%" align="center" style="cursor: pointer;" title="<?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['keyH']][$this->_tpl_vars['i']]; ?>
"><b>ครั้ง <?php echo $this->_tpl_vars['i']; ?>
</b><br><?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['keyH']][$this->_tpl_vars['i']]; ?>
</td <?php echo $this->_tpl_vars['i']++; ?>
>
								    	<?php endfor; endif; ?>
										<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'R'): ?>
								    	<td class="font11b" width="7%" align="center" >คะแนนที่ได้ <br/>(เต็ม 10)</td>
								    	<?php endif; ?>
								    	<td class="font11b" width="7%" align="center" >คะแนนรวม</td>
								    	<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
								    	<td class="font11b" width="5%" align="center" >Action</td>
								    	<?php endif; ?>
									</tr>
									<?php if ($this->_tpl_vars['dataRows'][$this->_tpl_vars['keyH']]): ?>
									<?php $this->assign('i', 0); ?>
									<?php $_from = $this->_tpl_vars['dataRows'][$this->_tpl_vars['keyH']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['head2']):
?>
										<?php $_from = $this->_tpl_vars['head2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['head']):
?>
											<?php if ($this->_tpl_vars['key'] == 'subject'): ?>
											<tr bgcolor="#DAECF4" id="main_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
" height="20" >
												<td class="font11" align="center" width="3%"><?php echo $this->_tpl_vars['i']+1; ?>
</td>
												<td class="font11" align="left" ><?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>

													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][mpl_id]" id="id_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
" size="10" value="<?php echo $this->_tpl_vars['head']['mpl_id']; ?>
">
													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][mpl_type]" id="type_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
" size="10" value="<?php echo $this->_tpl_vars['head']['mpl_type']; ?>
">
													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][mpl_status]" id="status_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
" size="10" value="<?php echo $this->_tpl_vars['head']['mpl_status']; ?>
">
													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][mpl_subject]" id="subject_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>
">
												</td>
												<td class="font11b" align="center" >
													<?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>

													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][mpl_weight]" size="5" readonly id="mwscoll_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
">										
												</td>
												<?php $this->assign('i2', 1); ?>
									    		<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column'][$this->_tpl_vars['keyH']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
												<td class="font11" align="left" ></td>
												<?php endfor; endif; ?>
												<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'R'): ?>
												<td class="font11" align="left" ></td>
												<?php endif; ?>
												<td class="font11" align="left" ></td>
												<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
												<td class="font11" align="center" >												
													<a href="javascript:void(0)" onClick="AddRowsParent('<?php echo $this->_tpl_vars['i']; ?>
');">
														<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/add.gif" border="0" >
													</a>												
												</td>
												<?php endif; ?>
											</tr>										
											<?php elseif ($this->_tpl_vars['key'] == 'detail'): ?>
												<?php $this->assign('ii', 1); ?>
												<?php $_from = $this->_tpl_vars['head']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
												<tr id="sub_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#F9FAFB"), $this);?>
">
													<td class="font11" align="left" width="3%">&nbsp;</td>
													<td class="font11" align="left" >
														<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>

														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_subject]" id="subject_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>
">
													
														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_id]" id="id_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="10" value="<?php echo $this->_tpl_vars['item']['mpl_id']; ?>
">
														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_type]" id="type_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="10" value="D">
														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_status]" id="status_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="10" value="N">
													</td>
													<td class="font11" align="center" >
														<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>
														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_weight]" id="wscoll_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" readonly value="<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">																									
													</td>
													<?php $this->assign('i2', 0); ?>
										    		<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column'][$this->_tpl_vars['keyH']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
													<td class="font11" align="center" >
														<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['subCol'][$this->_tpl_vars['i2']]['sl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>

													</td <?php echo $this->_tpl_vars['i2']++; ?>
>
													<?php endfor; endif; ?>
													<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'R'): ?>
													<td class="font11" align="center" >
														<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>
															<?php if ($this->_tpl_vars['item']['mpl_point'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>
														<?php elseif ($this->_tpl_vars['headArr']['mph_status'] != 'C'): ?>
														<input type="text" name="detail[<?php echo $this->_tpl_vars['keyH']; ?>
][<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_point]" id="rscoll_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" onKeyup="ChkInt(this);_SumT('<?php echo $this->_tpl_vars['keyH']; ?>
','<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
');" value="<?php if ($this->_tpl_vars['item']['mpl_point'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
														<?php endif; ?>
													</td>
													<?php endif; ?>
													<td class="font11" align="center" >
														<input type="text" id="tscoll_<?php echo $this->_tpl_vars['keyH']; ?>
_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" readonly value="<?php if ($this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point']>0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
													</td>
													<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
													<td class="font11" align="center" >
														<a href="javascript:void(0)" onClick="DelRowParent('<?php echo $this->_tpl_vars['i']; ?>
','<?php echo $this->_tpl_vars['ii']; ?>
');">
															<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/deletep.gif" border="0" >
														</a>
													</td>
													<?php endif; ?>
												</tr <?php echo $this->_tpl_vars['ii']++; ?>
>
												<?php endforeach; endif; unset($_from); ?>												
											<?php endif; ?>											
										<?php endforeach; endif; unset($_from); ?>
										<tbody id="show_parant<?php echo $this->_tpl_vars['i']; ?>
"></tbody>
									<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
									<?php endforeach; endif; unset($_from); ?>
									<?php endif; ?>
									<tbody id="show_main"></tbody>									
									<tr height="20" bgcolor="#CCCCCC">
								    	<td colspan="2" align="right" class="font11b">คะแนนรวม &nbsp;</td>
								    	<td align="center" ><span id="weight_<?php echo $this->_tpl_vars['keyH']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['headArr']['sum_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
</span></td>
								     	<?php $this->assign('t', 1); ?>
								     	<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column'][$this->_tpl_vars['keyH']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
								     	<td align="center"><?php echo $this->_tpl_vars['totalLine'][$this->_tpl_vars['keyH']][$this->_tpl_vars['t']]['grade']; ?>
:<?php echo ((is_array($_tmp=$this->_tpl_vars['totalLine'][$this->_tpl_vars['keyH']][$this->_tpl_vars['t']]['scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td <?php echo $this->_tpl_vars['t']++; ?>
>
								     	<?php endfor; endif; ?>
								     	<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'R'): ?>
								    	<td align="center" ><span id="point_<?php echo $this->_tpl_vars['keyH']; ?>
"></span></td>
								    	<?php endif; ?>
								    	<td align="center" ><span id="point_grade_<?php echo $this->_tpl_vars['keyH']; ?>
"><?php if ($this->_tpl_vars['headArr']['mph_grade']): ?><?php echo $this->_tpl_vars['headArr']['mph_grade']; ?>
:<?php endif; ?></span><span id="point_total_<?php echo $this->_tpl_vars['keyH']; ?>
"><?php if ($this->_tpl_vars['headArr']['sum_point']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['headArr']['sum_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
<?php endif; ?></span></td>
								    	<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
								    	<td align="center" ></td>
								    	<?php endif; ?>
									</tr>
							</table>
						</td>
			          </tr>
			          
			        <tr>
			             <td valign="top">
				            <table valign="top" width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				               <tr valign="top">
						             <td width="65%" valign="top">
						              	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							                <tr>
								                <td valign="top" align="left" class="font12">&nbsp; Remark : (ประเมินตนเองคะแนนมากกว่า 8 กรุณาใส่รายละเอียดเพิ่มเติม)</td>
								            </tr>
							                <tr>
								                <td valign="top" align="left" class="font12">&nbsp;
								                    <textarea name="head[<?php echo $this->_tpl_vars['keyH']; ?>
][mph_desc]" id="detail" rows="7" class="textfield_10c"><?php echo ((is_array($_tmp=$this->_tpl_vars['headArr']['mph_desc'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>
</textarea>
								            	</td>
								            </tr>
							            </table>
				            		</td>
				            		<td valign="top">
					            		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
					            			<tr height="30">
						            			<td nowrap>
						            			<?php if ($this->_tpl_vars['dataRows']): ?>
							            			<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/start.png" border="0" title="[ ฝ่ายบุคคล ]">
							            			<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/next.gif" border="0" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/user.png" title="[ <?php echo $this->_tpl_vars['headArr']['first_recive']; ?>
 ]" border="0" width="20" height="20">
							            			<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'P' || $this->_tpl_vars['headArr']['mph_status'] == 'R' || $this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>
														<?php $this->assign('u', 1); ?>
									    				<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column'][$this->_tpl_vars['keyH']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
								            				<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/next.gif" border="0" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/user.png" title="[ <?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['keyH']][$this->_tpl_vars['u']]; ?>
 ]" border="0" width="20" height="20">
							            				<?php $this->assign('u', $this->_tpl_vars['u']+1); ?>
							            				<?php endfor; endif; ?>
						            					<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'P'): ?>
							            					<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/next.gif" border="0" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/pink.png" title="[ <?php echo $this->_tpl_vars['user_flow']; ?>
 ]" border="0" width="16" height="16">
							            				<?php endif; ?>
						            				<?php endif; ?>
						            				<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>
						            				<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/next.gif" border="0" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/end.gif" title="[ การเงิน ]" border="0" >
						            				<?php endif; ?>
						            			<?php endif; ?>
						            			</td>
					            			</tr>
					            		</table>
				            		</td>
				                </tr>
				            </table>
			             </td>
			        </tr>
			        
			        <input type="hidden" name="sum_weight[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="sum_weight" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['headArr']['sum_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
">
					<input type="hidden" name="loopCol[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="loopCol" value="<?php echo $this->_tpl_vars['column'][$this->_tpl_vars['keyH']]; ?>
">
					<input type="hidden" name="receive_old[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="receive_old" value="<?php echo $this->_tpl_vars['headArr']['mph_user_flow']; ?>
">
					<input type="hidden" name="user_recive[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="user_recive" value="<?php echo $this->_tpl_vars['headArr']['mph_user_flow']; ?>
">
					<input type="hidden" name="user_send[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="user_send" value="<?php echo $this->_tpl_vars['user_send']; ?>
">
					<input type="hidden" name="mode[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="mode">
					<input type="hidden" name="checksend[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="checksend">
					<input type="hidden" name="change[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="change" value="<?php echo $this->_tpl_vars['change']; ?>
">
					<input type="hidden" name="page_status[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="page_status" value="<?php echo $this->_tpl_vars['status']; ?>
">
					<input type="hidden" name="copy_to[<?php echo $this->_tpl_vars['keyH']; ?>
]" value="<?php echo $this->_tpl_vars['copy_to']; ?>
">
					<input type="hidden" name="level_user[<?php echo $this->_tpl_vars['keyH']; ?>
]" value="<?php echo $this->_tpl_vars['headArr']['org_position_level']; ?>
">
					<input type="hidden" name="head[<?php echo $this->_tpl_vars['keyH']; ?>
][mph_id]" value="<?php echo $this->_tpl_vars['headArr']['mph_id']; ?>
">
					<input type="hidden" name="head[<?php echo $this->_tpl_vars['keyH']; ?>
][mph_month]" value="<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
">
					<input type="hidden" name="head[<?php echo $this->_tpl_vars['keyH']; ?>
][mph_status]" id="status" value="<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
">
					<input type="hidden" name="head[<?php echo $this->_tpl_vars['keyH']; ?>
][mph_user]" value="<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
">
					<input type="hidden" name="old_status[<?php echo $this->_tpl_vars['keyH']; ?>
]" id="old_status" value="<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
">
					<?php endforeach; endif; unset($_from); ?>
			        
			        <tr ><td colspan="2"height="20"></td></tr>
			    	<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
													
							<input id="btn_list" title="Send to approve" class="btn_tools" value="  Send to approve" onclick="bttSendTo('workflow/evaluate/userpopup/pageview/pi/code/<?php echo $this->_tpl_vars['key_chk']; ?>
/status/<?php echo $this->_tpl_vars['status']; ?>
');" type="button">
							<?php if ($this->_tpl_vars['lookup_code'] == 'AM'): ?>
							<input id="btn_accept" title="Approve" class="btn_tools" onclick="bttFinish('F','pi_admin','<?php echo $this->_tpl_vars['status']; ?>
','finish');" value="  Approve" type="button">
							<?php else: ?>
							<input id="btn_accept" title="Approve" class="btn_tools" onclick="bttFinish('F','pi','<?php echo $this->_tpl_vars['status']; ?>
','finish');" value="  Approve" type="button">
							<?php endif; ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/accept/type/PI');"  value="  Back" type="button">
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
<input type="hidden" name="key_chk" id="key_chk" value="<?php echo $this->_tpl_vars['key_chk']; ?>
">
<input type="hidden" name="user_recive_popup" id="user_recive_popup" >

</table>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js,".($this->_tpl_vars['_js'])."/action.js,".($this->_tpl_vars['_js'])."/_pi.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
<?php /* Smarty version 2.6.19, created on 2014-10-01 18:14:11
         compiled from PI/_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'PI/_form.tpl', 473, false),array('modifier', 'number_format', 'PI/_form.tpl', 481, false),array('function', 'cycle', 'PI/_form.tpl', 510, false),array('function', 'add_script', 'PI/_form.tpl', 848, false),)), $this); ?>
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
function ChkIntNoDot(obj) {
	if (ckvNumericNoDot(obj.value) == false){
 			alert(\'pleases input number only.\');
 			obj.value = \'\';
 			obj.focus();
 			return false;
 	}
}


// natcharee
function CheckRangeScore(obj) {
	if(chkRangeNum(obj.value) == false) {
 		_alert(\'Please input number 1-5 only.\');
		obj.value = \'\';
		obj.focus();
		return false;
 	}
}
function chkRangeNum(value) {
	if(value < 0 || value > 5) {
		return false;
	}
	
	return true;
}
function chkRangeWeight(obj,i) {
	var no = i.split(\'_\')[0];
	var weight = $(\'#mwscoll_\'+no).val();
	if(_SumsubW(no) > weight) {
		_alert(\'You input weight over \'+weight+ \'!!\');
		obj.value = \'\';
		obj.focus();
		return false;
	}

	return true;
}
function _SumsubW(no){
	var sum = 0;
	$(\'input[@id^=wscoll\\_\'+no+\'_]\').each(function(){
		sum += $(this).val().replace(/[\\,]/g,\'\')*1;
	});
	
	return sum;
	
}
function checkTotalBeforeSave() {
	var sum_score = $(\'#sum_weight\').val();

	if(sum_score != 100) {
		_alert(\'Point weight more than 100 or less than 100,Please check again.\'); 
		return false;
	}
	return true;
}
function ckvNumericNoDot(sText) {
	   var ValidChars = \'0123456789\';
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
function _SumTAdd(m,i){
	if(m) var no = m+\'_\'+i;
	else var no = \'0_\'+i;
	_SumT(no);
}
//edited
function _SumT(i){
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
		$(\'input[@id^=tscoll\\_]\').each(function(){
			sum_tscoll += $(this).val().replace(/[\\,]/g,\'\')*1;
		});
		$(\'#point_total\').html(sum_tscoll);	
	
		var params = \'_output=json&total=\'+sum_tscoll;
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
function AddRows(main){
	var subname = $(\'#subject\').val();
	var wscoll = $(\'#wscoll\').val();

	var len = $(\'tr[@id^=main_]\').length;
	var no = (len*1)+1;
	$(\'<tr id="main_\'+no+\'" bgcolor="#DAECF4" height="20">\'+
			\'<td colspan="6" ><table bgcolor="#DAECF4" cellpadding="0" cellspacing="1" width="100%" border="0" >\'+
				\'<tr>\'+
					\'<td align="center" width="3%">\'+no+\'</td>\'+
					\'<td align="left">\'+
						\'<input type="hidden" name="detail[\'+no+\'][mpl_id]" value="" >\'+
						\'<input type="hidden" name="detail[\'+no+\'][mpl_type]" value="D" >\'+
						\'<input type="hidden" name="detail[\'+no+\'][mpl_status]" value="N" >\'+
						\'<input type="text" name="detail[\'+no+\'][mpl_subject]" value="\'+subname+\'" size="70" >\'+
					\'</td>\'+
					\'<td width="7%" align="center"><input type="text" name="detail[\'+no+\'][mpl_weight]" id="mwscoll_\'+no+\'" onKeyup="ChkIntNoDot(this);" value="\'+wscoll+\'" size="5"></td>\'+
					\'<td width="7%"></td>\'+
					\'<td width="7%" ></td>\'+
					\'<td width="5%" align="center" nowrap><a href="javascript:void(0)" onclick="AddRowsParent(\'+no+\');"><img src="\'+IMG_URL+\'/add.gif" border="0" ></a><a href="javascript:void(0)" onclick="DelRow(\'+no+\');"><img src="\'+IMG_URL+\'/deletep.gif" border="0" ></a></td>\'+
				\'</tr>\'+
				\'<tbody id="show_parant\'+no+\'"></tbody>\'+
			\'</table></td>\'+
	  \'</tr>\').appendTo($(\'#show_main\'));

	$(\'#subject\').val(\'\');
	$(\'#wscoll\').val(\'\');
}
function AddRowsParent(main){
	var len = $(\'tr[@id^=sub_\'+main+\'_]\').length;
	var no = (len*1)+1;
	var line_id = main+\'_\'+no;
	
	var childrow = $(\'tr[@id^=sub_\'+main+\'_\'+no+\']\').length;
	while (childrow > 0) {
		no++;
		childrow = $(\'tr[@id^=sub_\'+main+\'_\'+no+\']\').length;
	}
	
	$(\'<tr id="sub_\'+main+\'_\'+no+\'" height="20" bgcolor="#ffffff" >\'+
			\'<td >&nbsp;</td>\'+
			\'<td align="left">\'+
				\'<input type="hidden" name="detail[\'+main+\'][line][\'+no+\'][mpl_id]" value="" >\'+
				\'<input type="hidden" name="detail[\'+main+\'][line][\'+no+\'][mpl_type]" value="D" >\'+
				\'<input type="hidden" name="detail[\'+main+\'][line][\'+no+\'][mpl_status]" value="N" >\'+
				\'<input type="text" name="detail[\'+main+\'][line][\'+no+\'][mpl_subject]" value="" size="70"  >\'+
			\'</td>\'+
			\'<td align="center"><input type="text" name="detail[\'+main+\'][line][\'+no+\'][mpl_weight]" id="wscoll_\'+main+\'_\'+no+\'" value="" onKeyup="ChkIntNoDot(this);_SumW();chkRangeWeight(this,\\\'\'+line_id+\'\\\');_SumTAdd(\'+main+\',\'+no+\');" size="5"></td>\'+
			\'<td align="center"><input type="text" name="detail[\'+main+\'][line][\'+no+\'][mpl_point]" id="rscoll_\'+main+\'_\'+no+\'" value="" onKeyup="ChkIntNoDot(this);CheckRangeScore(this);_SumTAdd(\'+main+\',\'+no+\');" size="5"></td>\'+
			\'<td align="center"><input type="text" id="tscoll_\'+main+\'_\'+no+\'" value="" readonly size="5"></td>\'+
			\'<td align="center" nowrap><a href="javascript:void(0)" onclick="DelRowParent(\'+main+\',\'+no+\');"><img src="\'+IMG_URL+\'/deletep.gif" border="0" ></a></td>\'+
	  \'</tr>\').appendTo($(\'#show_parant\'+main));
}
function DelRowParent(r1,r2){
	var id = r1+\'_\'+r2;
    //$(\'tr[@id^=sub_\'+id+\']\').remove();
    $(\'#sub_\'+id).remove();
    _SumW();
}
function DelRow(id){
	//$(\'tr[@id^=main_\'+id+\']\').remove();
	$(\'#main_\'+id).remove();
    $(\'tr[@id^=sub_\'+id+\'_]\').remove();
    _SumW();
}

'; ?>

</script>
<div id="content-container">
<!--
onload="MM_preloadImages('<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_04.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_05.gif',
'<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_06.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_07.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_08.gif',
'<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_11.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_12.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_13.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_14.gif',
'<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_15.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_16.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_17.gif')"
-->
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
					  <tr><td height="3"></td></tr>
			          <tr>
			            <td>
			            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
					            <tr>
					                <td width="68%">&nbsp;</td>
					                <td width="10%">&nbsp;</td>
					                <td width="10%" rowspan="5">
					                	<table width="303" border="0" cellspacing="0" cellpadding="0">
						                    <tr>
						                      <td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/namebox_top.png" width="303" height="14" /></td>
						                    </tr>
						                    <tr>
						                      <td background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/namebox.png">
							                      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
							                          <tr>
							                            <td width="30%">
							                            <?php if (! $this->_tpl_vars['user_image']): ?>
															<img src="<?php echo $this->_tpl_vars['UPLOAD_URL']; ?>
/default.gif" id="PreviewImage" width="80" height="100">
														<?php else: ?>
							                            	<img src="<?php echo $this->_tpl_vars['UPLOAD_URL']; ?>
/account/<?php echo $this->_tpl_vars['userArr']['user_image']; ?>
?<?php echo $this->_tpl_vars['rand']; ?>
" width="80" height="100"/>
							                            <?php endif; ?>
							                            </td>
							                            <td width="70%">
								                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								                                <tr>
								                                  <td valign="top" width="22%" class="style24" height="18">ชื่อ-สกุล</td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> <?php echo $this->_tpl_vars['userArr']['user_name']; ?>
 <?php echo $this->_tpl_vars['userArr']['user_lname']; ?>
</td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">รหัส </td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> <?php if ($this->_tpl_vars['userArr']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['userArr']['user_code']; ?>
<?php endif; ?></td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">ตำแหน่ง</td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> <?php echo $this->_tpl_vars['userArr']['org_position_name_th']; ?>
</td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">แผนก</td>
								                                  <td valign="top" align="left">:&nbsp;</td>
								                                  <td valign="top" height="18" class="style24"> <?php echo $this->_tpl_vars['userArr']['org_sec_name_th']; ?>
</td>
								                                </tr>
								                            </table>
							                            </td>
							                          </tr>
							                      </table>
						                      </td>
						                    </tr>
						                    <tr>
						                      <td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/namebox_bottom.png" width="303" height="15" /></td>
						                    </tr>
					                	</table>
					                </td>
					                <td width="3%">&nbsp;</td>
					            </tr>
					            <!-- Month Tab-->
			              		<tr>
			                		<td>
			                			<table width="100%" border="0" cellspacing="0" cellpadding="0">
						                    <tr>
						                      <td width="97%">
							                      <table width="65%" border="0" cellspacing="0" cellpadding="0">
							                          <tr>
							                            <td><table width="444" border="0" cellspacing="0" cellpadding="0">
							                                <tr>
							                                  <td width="25"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_03.gif" width="26" height="24" /></td>
							                                  <td width="83"><a href="javascript:tabSubmit('pitab','08<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month04','',1)" onmouseover="MM_nbGroup('over','month04','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_04.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '08'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_04.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_04.gif"<?php endif; ?> alt="" width="82" height="24" border="0" id="month04" /></a></td>
							                                  <td width="84"><a href="javascript:tabSubmit('pitab','09<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month05','',1)" onmouseover="MM_nbGroup('over','month05','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_05.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '09'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_05.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_05.gif"<?php endif; ?> alt="" width="84" height="24" border="0" id="month05" /></a></td>
							                                  <td width="84"><a href="javascript:tabSubmit('pitab','10<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month06','',1)" onmouseover="MM_nbGroup('over','month06','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_06.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '10'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_06.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_06.gif"<?php endif; ?> alt="" width="84" height="24" border="0" id="month06" /></a></td>
							                                  <td width="84"><a href="javascript:tabSubmit('pitab','11<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month07','',1)" onmouseover="MM_nbGroup('over','month07','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_07.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '11'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_07.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_07.gif"<?php endif; ?> alt="" width="84" height="24" border="0" id="month07" /></a></td>
							                                  <td width="84"><a href="javascript:tabSubmit('pitab','12<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month08','',1)" onmouseover="MM_nbGroup('over','month08','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_08.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '12'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_08.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_08.gif"<?php endif; ?> alt="" width="83" height="24" border="0" id="month08" /></a></td>
							                                  <!-- <td width="83"><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','08<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month04','',1)" onmouseover="MM_nbGroup('over','month04','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_04.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '08'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_04.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_04.gif"<?php endif; ?> alt="" width="82" height="24" border="0" id="month04" /></a></td>
							                                  <td width="84"><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','09<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month05','',1)" onmouseover="MM_nbGroup('over','month05','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_05.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '09'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_05.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_05.gif"<?php endif; ?> alt="" width="84" height="24" border="0" id="month05" /></a></td>
							                                  <td width="84"><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','10<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month06','',1)" onmouseover="MM_nbGroup('over','month06','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_06.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '10'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_06.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_06.gif"<?php endif; ?> alt="" width="84" height="24" border="0" id="month06" /></a></td>
							                                  <td width="84"><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','11<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month07','',1)" onmouseover="MM_nbGroup('over','month07','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_07.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '11'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_07.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_07.gif"<?php endif; ?> alt="" width="84" height="24" border="0" id="month07" /></a></td>
							                                  <td width="84"><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','12<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month08','',1)" onmouseover="MM_nbGroup('over','month08','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_08.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '12'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_08.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_08.gif"<?php endif; ?> alt="" width="83" height="24" border="0" id="month08" /></a></td>
							                                   -->
							                                  <td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_09.gif" width="29" height="24" /></td>
							                                </tr>
							                            </table></td>
							                          </tr>
							                          <tr>
							                            <td><table width="444" border="0" cellspacing="0" cellpadding="0">
							                                <tr>
							                                							                                  <td><a href="javascript:tabSubmit('pitab','01<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month11','',1)" onmouseover="MM_nbGroup('over','month11','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_11.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '01'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_11.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_11.gif"<?php endif; ?> alt="" width="83" height="30" border="0" id="month11"/></a></td>
							                                  <td><a href="javascript:tabSubmit('pitab','02<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month12','',1)" onmouseover="MM_nbGroup('over','month12','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_12.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '02'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_12.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_12.gif"<?php endif; ?> alt="" width="83" height="30" border="0" id="month12" /></a></td>
							                                							                                  <!-- td><a href="javascript:#;" target="_top" onclick="javascript:_alert('Can\'t display history January 2014.');" ><img <?php if ($this->_tpl_vars['monthNow'] == '01'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_11.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_11.gif"<?php endif; ?> alt="" width="83" height="30" border="0" id="month11"/></a></td>
							                                  <td><a href="javascript:#;" target="_top" onclick="javascript:_alert('Can\'t display history February 2014.');" ><img <?php if ($this->_tpl_vars['monthNow'] == '02'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_12.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_12.gif"<?php endif; ?> alt="" width="83" height="30" border="0" id="month12" /></a></td-->
							                                							                                  <td><a href="javascript:tabSubmit('pitab','03<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month13','',1)" onmouseover="MM_nbGroup('over','month13','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_13.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '03'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_13.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_13.gif"<?php endif; ?> alt="" width="71" height="30" border="0" id="month13" /></a></td>
							                                  <td><a href="javascript:tabSubmit('pitab','04<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month14','',1)" onmouseover="MM_nbGroup('over','month14','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_14.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '04'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_14.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_14.gif"<?php endif; ?> alt="" width="60" height="30" border="0" id="month14" /></a></td>
							                                  <td><a href="javascript:tabSubmit('pitab','05<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month15','',1)" onmouseover="MM_nbGroup('over','month15','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_15.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '05'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_15.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_15.gif"<?php endif; ?> alt="" width="59" height="30" border="0" id="month15" /></a></td>
							                                  <td><a href="javascript:tabSubmit('pitab','06<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month16','',1)" onmouseover="MM_nbGroup('over','month16','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_16.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '06'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_16.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_16.gif"<?php endif; ?> alt="" width="59" height="30" border="0" id="month16" /></a></td>
							                                  <td><a href="javascript:tabSubmit('pitab','07<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month17','',1)" onmouseover="MM_nbGroup('over','month17','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_17.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '07'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_17.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_17.gif"<?php endif; ?> alt="" width="57" height="30" border="0" id="month17" /></a></td>
							                                  <!-- <td><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','01<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month11','',1)" onmouseover="MM_nbGroup('over','month11','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_11.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '01'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_11.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_11.gif"<?php endif; ?> alt="" width="83" height="30" border="0" id="month11" /></a></td>
							                                  <td><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','02<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month12','',1)" onmouseover="MM_nbGroup('over','month12','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_12.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '02'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_12.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_12.gif"<?php endif; ?> alt="" width="83" height="30" border="0" id="month12" /></a></td>
							                                  <td><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','03<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month13','',1)" onmouseover="MM_nbGroup('over','month13','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_13.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '03'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_13.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_13.gif"<?php endif; ?> alt="" width="71" height="30" border="0" id="month13" /></a></td>
							                                  <td><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','04<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month14','',1)" onmouseover="MM_nbGroup('over','month14','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_14.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '04'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_14.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_14.gif"<?php endif; ?> alt="" width="60" height="30" border="0" id="month14" /></a></td>
							                                  <td><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','05<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month15','',1)" onmouseover="MM_nbGroup('over','month15','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_15.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '05'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_15.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_15.gif"<?php endif; ?> alt="" width="59" height="30" border="0" id="month15" /></a></td>
							                                  <td><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','06<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month16','',1)" onmouseover="MM_nbGroup('over','month16','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_16.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '06'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_16.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_16.gif"<?php endif; ?> alt="" width="59" height="30" border="0" id="month16" /></a></td>
							                                  <td><a href="javascript:openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','','07<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month17','',1)" onmouseover="MM_nbGroup('over','month17','<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_17.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == '07'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month-over_17.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/month_17.gif"<?php endif; ?> alt="" width="57" height="30" border="0" id="month17" /></a></td> -->
							                                </tr>
							                            </table></td>
							                          </tr>
							                      </table>
							                   </td>
						                    </tr>

						                </table>
						            </td>
				              </tr>
				              <!-- End Month Tab-->

				              <!-- Line -->
				              <tr valign="top">
				                <td height="3" valign="top">
					                <table width="100%" border="0" cellspacing="0" cellpadding="0">
					                    <tr>
					                    	<td background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
					                </table>
				                </td>
				                <td valign="top">
					                <table width="100%" border="0" cellspacing="0" cellpadding="0">
					                    <tr>
					                      <td valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
					                </table>
				                </td>
				                <td valign="top">
				                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
					                    <tr>
					                      <td valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
				                  	</table>
				                </td>
				              </tr>
				              <!-- End Line -->

				              <tr >
				                <td>
					                <table  border="0" cellspacing="0" cellpadding="0">
					                    <!--tr>
					                      <td width="150" style="cursor: pointer;" height="24" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_20.png" onclick="openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','T1','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style7">ประเมินเดือนปัจจุบัน</div></td>
					                      <td width="150" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_21.png" onclick="openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','T2','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style8">ประเมินเดือนถัดไป</div></td>
					                      <td width="149" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_22.png" onclick="openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','T3','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style9">สรุปผล</div></td>
					                    </tr-->
					                    
					                    <tr>
					                      <?php if ($this->_tpl_vars['yearNow'] > $this->_tpl_vars['fix_year']): ?>
					                      <td width="150" style="cursor: pointer;" height="24" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_20.png" onclick="javascript:tabSubmit('pitab','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearPrv']; ?>
','T1');"><div align="center" class="style7">ประเมินในปี <?php echo $this->_tpl_vars['yearPrv']; ?>
</div></td>
					                      <?php else: ?>
					                      <td width="150" style="cursor: pointer;" height="24" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_20.png" onclick="javascript:_alert('Can\'t display history year '+<?php echo $this->_tpl_vars['yearPrv']; ?>
+' on this page.');"><div align="center" class="style7">ประเมินในปี <?php echo $this->_tpl_vars['yearPrv']; ?>
</div></td>
					                      <?php endif; ?>
					                      <td width="150" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_21.png" onclick="javascript:tabSubmit('pitab','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['year']; ?>
','T2');"><div align="center" class="style8">ประเมินในปี <?php echo $this->_tpl_vars['year']; ?>
</div></td>
					                      <td width="149" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_22.png" onclick="javascript:tabSubmit('pitab','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNext']; ?>
','T3');"><div align="center" class="style9">ประเมินในปี <?php echo $this->_tpl_vars['yearNext']; ?>
</div></td>
					                    </tr>
					                    <!-- <tr>
					                      <td width="150" style="cursor: pointer;" height="24" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_20.png" onclick="openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','T1','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearPrv']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style7">ประเมินในปี <?php echo $this->_tpl_vars['yearPrv']; ?>
</div></td>
					                      <td width="150" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_21.png" onclick="openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','T2','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['year']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style8">ประเมินในปี <?php echo $this->_tpl_vars['year']; ?>
</div></td>
					                      <td width="149" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_22.png" onclick="openLinkPage('PI','<?php echo $this->_tpl_vars['user']; ?>
','T3','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNext']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style9">ประเมินในปี <?php echo $this->_tpl_vars['yearNext']; ?>
</div></td>
					                    </tr> -->
					                </table>
				                </td>
				              </tr>
				              <tr><td>&nbsp;</td></tr>
			            	</table>
			            	<table width="50%" border="0" cellspacing="0" cellpadding="0">
				              <tr>
				             	
				                <td width="50px"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Arrow-Left.gif" width="40" height="40" /></td>
				                				              	<?php if ($this->_tpl_vars['status'] == 'W'): ?>
				             	<td width="30%" class="style15" style="font-size:18px;">View History PI >> </td>
								<?php endif; ?>
				              	<td align="left">&nbsp;&nbsp;&nbsp;<span class="style15"><?php echo $this->_tpl_vars['TabName']; ?>
</span></td>
				              </tr>
			            	</table>
			            </td>
			          </tr>
			          <tr>
			            <td>
							<table width="100%" cellspacing="1" cellpadding="0" border="0">
									<tr bgcolor="#ffffff" height="30">
								    	<td valign="top" class="font11b" width="15%" align="left" >&nbsp;Evaluate Objective :</td>
								    	<td class="font12" align="left" ><?php echo $this->_tpl_vars['headArr']['mph_objective']; ?>
</td>
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
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
								    	<td class="font11" width="6%" align="center" style="cursor: pointer;" title="<?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['i']]; ?>
"><b>ครั้ง <?php echo $this->_tpl_vars['i']; ?>
</b><br><?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['i']]; ?>
</td <?php echo $this->_tpl_vars['i']++; ?>
>
								    	<?php endfor; endif; ?>
										<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'R' && $this->_tpl_vars['status'] != 'W'): ?>
								    	<td class="font11b" width="7%" align="center" >คะแนนที่ได้ <font color="#EE2C2C">*</font></td>
								    	<?php endif; ?>
								    	<td class="font11b" width="7%" align="center" >คะแนนรวม</td>
								    	<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
								    	
								    	<!-- Hidden for view history PI #natcha --><?php if ($this->_tpl_vars['status'] != 'W'): ?>
								    	<td class="font11b" width="5%" align="center" >Action</td>
								    	<?php endif; ?>
								    	
								    	<?php endif; ?>
									</tr>
									<?php if ($this->_tpl_vars['dataRows']): ?>
									<?php $this->assign('i', 0); ?>
									<?php $_from = $this->_tpl_vars['dataRows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['head2']):
?>
										<?php $_from = $this->_tpl_vars['head2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['head']):
?>
											<?php if ($this->_tpl_vars['key'] == 'subject'): ?>
											<tr bgcolor="#DAECF4" id="main_<?php echo $this->_tpl_vars['i']; ?>
" height="20" >
												<td class="font11" align="center" width="3%"><?php echo $this->_tpl_vars['i']+1; ?>
</td>
												<td class="font11" align="left" ><?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>

													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][mpl_id]" id="id_<?php echo $this->_tpl_vars['i']; ?>
" size="10" value="<?php echo $this->_tpl_vars['head']['mpl_id']; ?>
">
													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][mpl_type]" id="type_<?php echo $this->_tpl_vars['i']; ?>
" size="10" value="<?php echo $this->_tpl_vars['head']['mpl_type']; ?>
">
													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][mpl_status]" id="status_<?php echo $this->_tpl_vars['i']; ?>
" size="10" value="<?php echo $this->_tpl_vars['head']['mpl_status']; ?>
">
													<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][mpl_subject]" id="subject_<?php echo $this->_tpl_vars['i']; ?>
" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>
">
												</td>
												<td class="font11b" align="center" >
													<?php if ($this->_tpl_vars['column'] || $this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>
														<?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>

														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][mpl_weight]" size="5" readonly id="mwscoll_<?php echo $this->_tpl_vars['i']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
">
													<?php else: ?>
														<input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][mpl_weight]" size="5" <?php if ($this->_tpl_vars['head']['mpl_weight'] == -1): ?>readonly<?php endif; ?> id="mwscoll_<?php echo $this->_tpl_vars['i']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['head']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
" onKeyup="ChkIntNoDot(this)">												
													<?php endif; ?>
												</td>
												<?php $this->assign('i2', 1); ?>
									    		<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
												<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'R' && $this->_tpl_vars['status'] != 'W'): ?>
												<td class="font11" align="left" ></td>
												<?php endif; ?>
												<td class="font11" align="left" ></td>
												<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
												
												<!-- Hidden for view history PI #natcha --><?php if ($this->_tpl_vars['status'] != 'W'): ?>
												<td class="font11" align="center" >												
													<a href="javascript:void(0)" onClick="AddRowsParent('<?php echo $this->_tpl_vars['i']; ?>
');">
														<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/add.gif" border="0" >
													</a>												
												</td>
												<?php endif; ?>
												
												<?php endif; ?>
											</tr>										
											<?php elseif ($this->_tpl_vars['key'] == 'detail'): ?>
												<?php $this->assign('ii', 1); ?>
												<?php $_from = $this->_tpl_vars['head']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
												<tr id="sub_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#F9FAFB"), $this);?>
">
													<td class="font11" align="left" width="3%">&nbsp;</td>
													<td class="font11" align="left" >
													<?php if ($this->_tpl_vars['column'] || $this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>
														<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>

														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_subject]" id="subject_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>
">
													<?php else: ?>
														<?php if ($this->_tpl_vars['status'] == 'V'): ?>
														<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>

														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_subject]" id="subject_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>
">
														<?php else: ?>
														<input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_subject]" id="subject_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="70" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>
">
														<?php endif; ?>
													<?php endif; ?>
														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_id]" id="id_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="10" value="<?php echo $this->_tpl_vars['item']['mpl_id']; ?>
">
														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_type]" id="type_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="10" value="D">
														<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_status]" id="status_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="10" value="N">
													</td>
													<td class="font11" align="center" >
														<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'F' && $this->_tpl_vars['headArr']['mph_status'] != 'R'): ?>
															<?php if ($this->_tpl_vars['column']): ?>
																<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>
																<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_weight]" id="wscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" readonly value="<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
															<?php else: ?>
																<?php if ($this->_tpl_vars['status'] == 'V'): ?>
																	<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>
																		<?php if ($this->_tpl_vars['headArr']['mph_user'] == $this->_tpl_vars['headArr']['user_first_recive']): ?>
																			<!-- 01input--<?php echo $this->_tpl_vars['i']; ?>
-<?php echo $this->_tpl_vars['ii']; ?>
 --><input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_weight]" id="wscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" onKeyup="ChkIntNoDot(this);chkRangeWeight(this, '<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
');_SumW();_SumT('<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
');" value="<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
																		<?php else: ?>
																			02<input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_weight]" id="wscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" <?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?>readonly<?php endif; ?> onKeyup="ChkIntNoDot(this);_SumW();_SumT('<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
');" value="<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
																		<?php endif; ?>
																	<?php else: ?>
																		<input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_weight]" id="wscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" <?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?>readonly<?php endif; ?> onKeyup="ChkIntNoDot(this);_SumW();_SumT('<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
');" value="<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">																	
																	<?php endif; ?>
																<?php else: ?>
																	<input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_weight]" id="wscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" onKeyup="ChkIntNoDot(this);_SumW();_SumT('<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
');" value="<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">												
																<?php endif; ?>
															<?php endif; ?>
														<?php else: ?>	
															<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>	
																<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>
																<input type="hidden" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_weight]" id="wscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" readonly value="<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">													
															<?php else: ?>		
																<input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_weight]" id="wscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" readonly value="<?php if ($this->_tpl_vars['item']['mpl_weight'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">																
															<?php endif; ?>
														<?php endif; ?>
													</td>
													<?php $this->assign('i2', 0); ?>
										    		<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
														<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['subCol'][$this->_tpl_vars['i2']]['sl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>

													</td <?php echo $this->_tpl_vars['i2']++; ?>
>
													<?php endfor; endif; ?>
													<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'R' && $this->_tpl_vars['status'] != 'W'): ?>
													<td class="font11" align="center" >
														<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>
															<?php if ($this->_tpl_vars['item']['mpl_point'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>
														<?php elseif ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>
															<?php if ($this->_tpl_vars['headArr']['mph_user'] == $this->_tpl_vars['headArr']['user_first_recive']): ?>
															<!-- 111 --><input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_point]" id="rscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" onKeyup="ChkIntNoDot(this);CheckRangeScore(this);_SumT('<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
');" value="<?php if ($this->_tpl_vars['item']['mpl_point'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
															<?php endif; ?>
														<?php else: ?>
														<input type="text" name="detail[<?php echo $this->_tpl_vars['i']; ?>
][line][<?php echo $this->_tpl_vars['ii']; ?>
][mpl_point]" id="rscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" onKeyup="ChkIntNoDot(this);CheckRangeScore(this);_SumT('<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
');" value="<?php if ($this->_tpl_vars['item']['mpl_point'] > 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
														<?php endif; ?>
													</td>
													<?php endif; ?>
													
													<td class="font11" align="center" >
														<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'F'): ?>
															<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>		
																<?php if ($this->_tpl_vars['headArr']['mph_user'] == $this->_tpl_vars['headArr']['user_first_recive']): ?>
																<input type="text" id="tscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" readonly value="<?php if ($this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point']>0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
																<?php endif; ?>
															<?php else: ?>
															
															<?php if ($this->_tpl_vars['status'] != 'W'): ?>
															<input type="text" id="tscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" readonly value="<?php if ($this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point']>0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php endif; ?>">
															<?php else: ?>
															<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>

															<?php endif; ?>

															<?php endif; ?>
														<?php else: ?>
														<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>

														<input type="hidden" id="tscoll_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['ii']; ?>
" size="5" readonly value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
">
														<?php endif; ?>
													</td>
													<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
													<?php if ($this->_tpl_vars['status'] != 'W'): ?>
													<td class="font11" align="center" >
														<a href="javascript:void(0)" onClick="DelRowParent('<?php echo $this->_tpl_vars['i']; ?>
','<?php echo $this->_tpl_vars['ii']; ?>
');">
															<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/deletep.gif" border="0" >
														</a>
													</td>
													<?php endif; ?>
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
								    	<td align="center" ><span id="weight"><?php echo ((is_array($_tmp=$this->_tpl_vars['sum_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
</span></td>
								     	<?php $this->assign('t', 1); ?>
								     	<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
								     	<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['totalLine'][$this->_tpl_vars['t']]['scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td <?php echo $this->_tpl_vars['t']++; ?>
>
								     	<!-- natcharee hidden grade @2014-04-07 -->
								     	<!--td align="center">:</td -->
								     	<?php endfor; endif; ?>
								     	<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'R' && $this->_tpl_vars['status'] != 'W'): ?>
								    	<td align="center" ><span id="point"></span></td>
								    	<?php endif; ?>
								    	<!-- natcharee hidden grade @2014-04-07 -->
								    	<td align="center" ><span id="point_grade" style="display:none"><?php if ($this->_tpl_vars['headArr']['mph_grade']): ?><?php echo $this->_tpl_vars['headArr']['mph_grade']; ?>
:<?php endif; ?></span><span id="point_total"><?php if ($this->_tpl_vars['sum_point']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['sum_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
<?php endif; ?></span></td>
								    	<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
								    	
								    	<!-- Hidden for view history PI #natcha --><?php if ($this->_tpl_vars['status'] != 'W'): ?>
								    	<td align="center" ></td>
								    	<?php endif; ?>
								    	
								    	<?php endif; ?>
									</tr>
							</table>
						</td>
			          </tr>
			          <?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>
			          <tr>
			             <td>
				            <table width="60%" border="0" align="left" cellpadding="0" cellspacing="0">
				                <tr>
						             <td width="60%">
						              <fieldset >
						             	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							                <tr height="20">
								                <td align="left" colspan="4" class="font12b">&nbsp; เพิ่มข้อมูล </td>
							                </tr>
							                <tr height="25">
								                <td valign="top" align="right" width="18%" class="font12">หัวข้อการประเมิน :</td>
								                <td align="left" colspan="3">
								                    <input type="text" name="subject" id="subject" class="textfield_7c">
								                    <a href="javascript:void(0)" onClick="AddRows();">
													<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/add.gif" border="0" >
													</a>
								                </td>
							                </tr>
							                <tr height="25">
								                <td valign="top" align="right" width="18%" class="font12">น้ำหนักคะแนน :</td>
								                <td align="left" colspan="3">
								                    <input type="text" name="wscoll" id="wscoll" class="textfield_3c" onKeyup="ChkIntNoDot(this);">
								                </td>
							                </tr>
							            </table>
				           			 </fieldset >
				            		</td>
				                </tr>
				            </table>
			             </td>
			        </tr>
			        <?php endif; ?>
			        <tr>
			             <td valign="top">
				            <table valign="top" width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				               <tr valign="top">
						             <td width="65%" valign="top">
						              	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
						              		<tr>
								                <td valign="top" align="left" class="font12">
								                	<table height="40" width="100%" valign="top" border="0" cellpading="0" cellspacing="0">
								                		<tr>
								                			<td class="font12" style="color:#0000CD;font-weight:bold;line-height:22px;"><font color="#EE2C2C">*</font> เกณฑ์การให้คะแนน </br>&nbsp;&nbsp;&nbsp;0-ไม่ดำเนินการ , 1-บางส่วนแล้วเสร็จ 60% , 2-ส่วนใหญ่แล้วเสร็จ 80% , 3-แล้วเสร็จ 100% , <br/>&nbsp;&nbsp; 4-ทำได้สูงกว่าเป้าหมาย 120% , 5-ทำได้สูงกว่าเป้าหมายมาก 150%</td>
								                		</tr>
								                	</table>
								                </td>
								            </tr>
							                <tr>
								                <td valign="top" align="left" class="font12">&nbsp; Remark : (ประเมินตนเองคะแนน เท่ากับหรือมากกว่า 3 กรุณาใส่รายละเอียดเพิ่มเติม)</td>
								            </tr>
							                <tr>
								                <td valign="top" align="left" class="font12">&nbsp;
								                    <textarea name="head[mph_desc]" id="detail" rows="7" class="textfield_10c"><?php echo ((is_array($_tmp=$this->_tpl_vars['headArr']['mph_desc'])) ? $this->_run_mod_handler('replace', true, $_tmp, "||", "'") : smarty_modifier_replace($_tmp, "||", "'")); ?>
</textarea>
								            	</td>
								            </tr>
								            <tr>
							                	<td align="left">
							                	<br>&nbsp; หมายเหตุ : คะแนนในช่อง คะแนนรวม เป็นคะแนนรวมทั้งหมดที่กรอกเข้าไป ล่าสุด
							                	<br><dd>ปุ่ม save คือ การบันทึกข้อมูลไว้ โดยที่สถานะใบประเมินยังอยู่ที่ตนเองถ้าต้องการส่ง ต้องทำการคลิกปุ่ม Send to
							                	<br><dd>ปุ่ม Send to คือ การส่งต่อข้อมูลไปให้คนที่เราเลือกให้รับใบประเมิน
							                	<br><dd>สำหรับ คนที่มีหน้าที่ใส่รายละเอียดในใปประเมิน การคลิกปุ่ม send to คือการส่งหาเจ้าของใบประเมินนั้นโดยที่ไม่ต้องเลือกคนรับใบประเมิน
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
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
/form/user.png" title="[ <?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['u']]; ?>
 ]" border="0" width="20" height="20">
							            				<?php $this->assign('u', $this->_tpl_vars['u']+1); ?>
							            				<?php endfor; endif; ?>
							            				<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'P'): ?>
							            				<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/next.gif" border="0" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/pink.png" title="[ <?php echo $this->_tpl_vars['user_flow']['user_name']; ?>
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
			        <tr ><td colspan="2"height="20"></td></tr>
			    <?php if ($this->_tpl_vars['status'] != 'W' && $this->_tpl_vars['status'] != 'O'): ?>
					<?php if ($this->_tpl_vars['headArr']): ?>
					<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'F' || $this->_tpl_vars['headArr']['mph_status'] == 'R'): ?>
					<?php if ($this->_tpl_vars['_profile']->user_header == 'Y'): ?>
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
						<?php if ($this->_tpl_vars['status'] == 'B' && $this->_tpl_vars['headArr']['mph_status'] == 'F' && $this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
							<input id="btn_list" title="Send to" class="btn_tools" value="  Send to" onclick="openPopup('workflow/evaluate/userpopup/pageview/pi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
');" type="button">
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/backward');"  value="  Back" type="button">
						<?php else: ?>
							<!--input id="btn_copy" title="copy" class="btn_tools" onclick="copyData('<?php echo $this->_tpl_vars['headArr']['mph_id']; ?>
','PI','<?php echo $this->_tpl_vars['copy_to']; ?>
');" value="   Copy" type="button"-->
							<input id="btn_copy" title="copy" class="btn_tools" onclick="copyDataTo('<?php echo $this->_tpl_vars['headArr']['mph_id']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
','PI','<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
');" value="   Copy" type="button">
							
						<?php endif; ?>
						</td>
					</tr>
					<?php endif; ?>
					
					<?php else: ?>
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<?php if ($this->_tpl_vars['status'] != 'E'): ?>
							<input id="btn_save" title="Save" class="btn_tools" onclick="javascript:if(checkTotalBeforeSave())sendDataToSave('<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
','pi','<?php echo $this->_tpl_vars['status']; ?>
','save');" value="   Save" type="button">
							<?php endif; ?>
							<?php if (! $this->_tpl_vars['Finish']): ?>
								<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>
									<?php if ($this->_tpl_vars['headArr']['mph_user'] == $this->_tpl_vars['headArr']['user_first_recive']): ?>
										<input id="btn_list" title="Send to" class="btn_tools" value="  Send to" onclick="chkScoll('weight','workflow/evaluate/userpopup/pageview/pi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
');" type="button">
									<?php else: ?>
										<input id="btn_list" title="Send to Owner" class="btn_tools" value="  Send to Owner" onclick="chkScollSend('weight','P','pi','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
','workflow/evaluate/userpopup/pageview/pi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
');" type="button">
									<?php endif; ?>
								<?php else: ?>
									<?php if ($this->_tpl_vars['level'] > 11): ?>
										<input id="btn_list" title="Send to" class="btn_tools" value="  Send to" onclick="chkScoll('weight','workflow/evaluate/userpopup/pageview/pi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
');" type="button">
										<input id="btn_accept" title="Approve" class="btn_tools" onclick="sendDataToSave('F','pi','<?php echo $this->_tpl_vars['status']; ?>
','finish');" value="  Approve" type="button">
									<?php else: ?>
										<input id="btn_list" title="Send to" class="btn_tools" value="  Send to" onclick="chkScoll('weight','workflow/evaluate/userpopup/pageview/pi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
');" type="button">							
									<?php endif; ?>									
								<?php endif; ?>
							<?php else: ?>
								<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>
									<input id="btn_list" title="Send to Owner" class="btn_tools" value="  Send to Owner" onclick="chkScollSend('weight','P','pi','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
','workflow/evaluate/userpopup/pageview/pi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
');" type="button">
								<?php else: ?>
									<input id="btn_list" title="Send to approve" class="btn_tools" value="  Send to approve" onclick="chkScoll('weight','workflow/evaluate/userpopup/pageview/pi/status/<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
');" type="button">
									<input id="btn_accept" title="Approve" class="btn_tools" onclick="sendDataToSave('F','pi','<?php echo $this->_tpl_vars['status']; ?>
','finish');" value="  Approve" type="button">
								<?php endif; ?>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['status'] == 'V'): ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');"  value="  Back" type="button">
							<?php elseif ($this->_tpl_vars['status'] == 'E'): ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/history');"  value="  Back" type="button">
							<?php elseif ($this->_tpl_vars['status'] == 'A'): ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/accept/type/PI/my/<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
');"  value="  Back" type="button">
							<?php else: ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/view/type/PI/user/<?php echo $this->_tpl_vars['_profile']->user_code; ?>
/status/<?php echo $this->_tpl_vars['status']; ?>
');"  value="  Back" type="button">
							<?php endif; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php endif; ?>
				<?php else: ?>
					<!-- <?php if ($this->_tpl_vars['status'] == 'W'): ?>
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/summary/incentive/type/PI/my/<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
');"  value="  Back" type="button">
						</td>
					</tr>
					<?php endif; ?> -->
				<?php endif; ?>
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
<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>  
	<?php if ($this->_tpl_vars['headArr']['mph_user'] == $this->_tpl_vars['headArr']['user_first_recive']): ?>
		<input type="hidden" name="owner_create" id="owner_create" value="Y">
	<?php endif; ?>
<?php endif; ?>
<input type="hidden" name="sum_weight" id="sum_weight" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sum_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
">
<input type="hidden" name="loopCol" id="loopCol" value="<?php echo $this->_tpl_vars['column']; ?>
">
<input type="hidden" name="receive_old" id="receive_old" value="<?php echo $this->_tpl_vars['headArr']['mph_user_flow']; ?>
">
<input type="hidden" name="user_recive" id="user_recive" value="<?php echo $this->_tpl_vars['headArr']['mph_user_flow']; ?>
">
<input type="hidden" name="user_send" id="user_send" value="<?php echo $this->_tpl_vars['user_send']; ?>
">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="checksend" id="checksend">
<input type="hidden" name="change" id="change" value="<?php echo $this->_tpl_vars['change']; ?>
">
<input type="hidden" name="page_status" id="page_status" value="<?php echo $this->_tpl_vars['status']; ?>
">
<input type="hidden" name="copy_to" value="<?php echo $this->_tpl_vars['copy_to']; ?>
">
<input type="hidden" name="level_user" value="<?php echo $this->_tpl_vars['headArr']['org_position_level']; ?>
">
<input type="hidden" name="head[mph_id]" value="<?php echo $this->_tpl_vars['headArr']['mph_id']; ?>
">
<input type="hidden" name="head[mph_month]" value="<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
">
<input type="hidden" name="head[mph_status]" id="status" value="<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
">
<input type="hidden" name="head[mph_user]" value="<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
">
<input type="hidden" name="old_status" id="old_status" value="<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
">
</table>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js,".($this->_tpl_vars['_js'])."/action.js,".($this->_tpl_vars['_js'])."/_pi.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>

<form id="pitab" action="/<?php echo $this->_tpl_vars['projectName']; ?>
/workflow/evaluate/pifrm" method="POST">
	<input type="hidden" name="user" value="<?php echo $this->_tpl_vars['user']; ?>
" />
	<input type="hidden" name="tab" id="tabyear" value="" />
	<input type="hidden"  name="m" id="tabmonth" value="" />
	<input type="hidden" name="status" value="<?php echo $this->_tpl_vars['status']; ?>
" />
	<input type="hidden" name="copy_to" value="<?php echo $this->_tpl_vars['copy_to']; ?>
" />
	<!-- 'PI','<?php echo $this->_tpl_vars['user']; ?>
','','01<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
 @@@/iceworkflow/workflow/evaluate/pifrm/user/1510583/tab//m/032013/status/W/copy_to/3207-->
</form>

<script>
<?php echo '
	function tabSubmit(_frm, _m, _y){
		document.getElementById("tabmonth").value = _m;
		document.getElementById("tabyear").value = _y;
		document.getElementById(_frm).submit();
	}
'; ?>

</script>
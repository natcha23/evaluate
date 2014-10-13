<?php /* Smarty version 2.6.19, created on 2014-08-22 15:46:38
         compiled from backward.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'backward.tpl', 32, false),array('function', 'cycle', 'backward.tpl', 68, false),array('function', 'add_script', 'backward.tpl', 119, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data">
	<input type="hidden" name="backwardaction" id="backwardaction" value=""/>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
				    	<td colspan="9" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;Backward Process Approve</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
					  
					  <tr bgcolor="#EBEBEB" height="25">
					  
				    	<td class="font11b" colspan="3" align="left" >
				    		<input id="btn_back" title="ย้อนกลับ Process" class="btn_tools" onclick="backwardLine('delhis');" value="&nbsp;&nbsp;Backward" type="button">
						</td>
						
						<td class="font11" align="right" colspan="2" ><b>Department :</b>
							<select name="group" id="group" class="selectBox22" onchange="jsChange(this.value);" >
								<option value="">-- Show all --</option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

							</select>&nbsp;&nbsp;
			   			 </td>
				    			
						<td class="font11" align="right" colspan="3" ><b>Month :</b>
	    					<select name="search[month]" id="month" class="selectBox10" >
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['monthOp'],'selected' => $this->_tpl_vars['month']), $this);?>

							</select>
									
							<select name="search[year]" id="year" class="selectBox7"  >
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yearOp'],'selected' => $this->_tpl_vars['year']), $this);?>

							</select>
							<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">

	    				</td>
			   			
		 			</tr>
					 			
				    <tr>
				    	<td colspan="9" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="3%" align="center" >
				    			 		<input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);">
				    			 	</td>
									<td class="font11b" width="10%" align="center" >Type of flow</td>
									<td class="font11b" width="15%" align="center" >Form Month</td>
									<td class="font11b" width="15%" align="center" >User Owner</td>
									<td class="font11b" width="15%" align="center" >User Receive</td>
									<td class="font11b" width="15%" align="center" >Send Date</td>
									<td class="font11b" width="10%" align="center" >Status</td>
<!-- 									<td class="font11b" width="10%" align="center" >Action</td> -->
								</tr>
								<?php if ($this->_tpl_vars['items']): ?>
								<?php $this->assign('loopH', 1); ?>
								<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['data']):
?>
								<tr height="20" <?php if ($this->_tpl_vars['data']['mph_status'] == 'C'): ?>bgcolor="#FFE7F6" <?php else: ?>bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" <?php endif; ?>id="tr_<?php echo $this->_tpl_vars['data']['mph_id']; ?>
">
									<td class="font12" align="center" >
										<input type='checkbox' class="border0" name="mph_id[]" id="<?php echo $this->_tpl_vars['data']['mph_id']; ?>
" value='<?php echo $this->_tpl_vars['data']['mph_id']; ?>
'>
									</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['mph_type']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['mph_month']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['user_name_owner']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['user_name']; ?>
</td>
									<td class="font12" align="center" ><?php echo $this->_tpl_vars['data']['mph_datetime']; ?>
</td>
									<td class="font12" align="center" >
									<?php if ($this->_tpl_vars['data']['mph_status'] == 'C'): ?>Create
									<?php elseif ($this->_tpl_vars['data']['mph_status'] == 'P'): ?>Process
									<?php elseif ($this->_tpl_vars['data']['mph_status'] == 'F'): ?>Finish
									<?php elseif ($this->_tpl_vars['data']['mph_status'] == 'R'): ?>Delay
									<?php endif; ?>
									</td>
									<!-- td align="center" class="font12" id="txt_link_user">
										<input id="btn_back" title="backward" class="btn_tools" onclick="openPageEvaluate('<?php echo $this->_tpl_vars['data']['mph_type']; ?>
','<?php echo $this->_tpl_vars['data']['mph_id']; ?>
','<?php echo $this->_tpl_vars['data']['mph_user']; ?>
','<?php echo $this->_tpl_vars['data']['mph_month']; ?>
','B');" value="   backward" type="button">
									</td-->
								</tr <?php echo $this->_tpl_vars['loopH']++; ?>
>
								<?php endforeach; endif; unset($_from); ?>
								<?php endif; ?>
				    		</table>
				    	</td>
					<!--tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openLinkMenu('workflow/evaluate/urecive');" value="   Back " type="button">
						</td>
					</tr-->
				  <tr align="right">
				   		<td colspan="9">
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

<script type="text/javascript">
<?php echo '
function backwardLine(act){
 	var param_code = \'\';
 	var chk = \'\';
 	$(\':checkbox\',$(\'#content-container\').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){
  	      chk = \'1\';
 		}
 	});
 	if(chk == \'1\'){
 		_confirm("Are you sure to backward process ?",function(){
 	 		$(\'#backwardaction\').val(\'1\');

 			document.forms[0].submit();

 			
// 	 		$(\':checkbox\',$(\'#content-container\').get(0)).each(function() {
// 		 		var reg = /([0-9a-zA-Z]+)$/i;
// 		 		if( this.checked==true && this.id.match(reg)){
// 		  	       id = this.value;
// 		   	        var data = {
// 		  	    		\'product\' :this.value
// 		  	       }
// 		  	     if(param_code == "") param_code = data.product;
// 		 	     else param_code += ","+data.product;

// 		  	     $("#tr_"+id).remove();
// 		 		}
// 		 	});
// 	 		jsDeleteHis(param_code,act);
 		},{icon:\'question\'});
 	}else{
 		_alert(\'Please select data.\');
 		return;
 	}
 }
'; ?>

</script>
</div>
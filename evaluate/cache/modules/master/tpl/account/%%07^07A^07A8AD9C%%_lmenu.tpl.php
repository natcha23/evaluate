<?php /* Smarty version 2.6.19, created on 2014-06-18 14:43:56
         compiled from C:%5CAppServ%5Cwww%5Ciceworkflow/modules/systemapi/templates/default/tpl/_lmenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_treemenu', 'C:\\AppServ\\www\\iceworkflow/modules/systemapi/templates/default/tpl/_lmenu.tpl', 88, false),array('function', 'add_script', 'C:\\AppServ\\www\\iceworkflow/modules/systemapi/templates/default/tpl/_lmenu.tpl', 217, false),)), $this); ?>
<div id="left-menu-container">
<table width="98%" border="0" cellpadding="2"><!--class="box"-->
<!-- Box menu Genaral -->
    <tr>
    	<td width="10"></td>
        <td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-top.gif"></td></tr>
				<tr>
					<td align="center" valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-center.gif">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic.png" width="100%">
							        <table width="100%" border="0" cellpadding="0" cellspacing="0">
							            <tr>
							                <td align="left" width="7"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic-left.png"></td>
							                <td align="left" width="50"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/general.png"></td>
							                <td width="100" style="color:#FFFFFF;font-size:14px;font-weight:bold;">General</td>
							                <td align="right"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic-right.png"></td>
							            </tr>
							        </table>
								</td>
							</tr>
							<tr>
								<td>
							        <table width="100%" cellspacing="5" cellpadding="0" border="0">
							            <tr >
							                <td> &#8226; <a href="javascript:app.gotoview('/workflow/evaluate/urecive');">Home</a></td>
							            </tr>
							            <tr >
							                <td> &#8226; <a href="javascript:app.gotoview('/master/account/accfrm/id/<?php echo $this->_tpl_vars['_profile']->user_id; ?>
/mode/edit');">Account</a></td>
							            </tr>
							            <tr style="display:none">
							                <td> &#8226; <a href="javascript:app.gotoview('/master/account/changepwd');">Change Password</a></td>
							            </tr>
							            <?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
							            <tr>
							                <td> &#8226; <a href="javascript:app.gotoview('/master/menu/list/type/front');">Menu Management</a></td>
							            </tr>
							            <tr>
							                <td> &#8226; <a href="javascript:app.gotoview('/master/mtmenu/display');">Menu Authen</a></td>
							            </tr>
							            <?php endif; ?>
							            <tr >
							                <td> &#8226; <!--a href="javascript:app.gotoview('/workflow/evaluate/pifrm/user/<?php echo $this->_tpl_vars['_profile']->user_code; ?>
/status/W');"--><a href="javascript:formSubmit('pifrm');">View History PI</a></td>
							            </tr>
							            <tr >
							                <td> &#8226; <!--a href="javascript:app.gotoview('/workflow/evaluate/mifrm/user/<?php echo $this->_tpl_vars['_profile']->user_code; ?>
/status/O');"--><a href="javascript:formSubmit('mifrm');">View History MI</a></td>
							            </tr>
							            
							        </table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-buttom.gif"></td></tr>
			</table>
        </td>
        <td width="15"></td>
    </tr>
<!-- Box menu Module -->
	<tr>
		<td></td>
        <td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-top.gif"></td></tr>
				<tr>
					<td align="center" valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-center.gif">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic.png" width="100%">
							        <table width="100%" border="0" cellpadding="0" cellspacing="0">
							            <tr background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic.png" width="100%">
							                <td align="left" width="7"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic-left.png"></td>
							                <td align="left" width="50"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/module.png"></td>
							                <td width="100" style="color:#FFFFFF;font-size:14px;font-weight:bold;">Module</td>
							                <td align="right"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic-right.png"></td>
							            </tr>
							        </table>
								</td>
							</tr>
							<tr>
								<td>
							        <table width="100%" cellspacing="0" cellpadding="0" border="0">
							            <tr>
							                <td class="left-bg" width="1">&nbsp;</td>
							                <td><?php echo $this->_plugins['function']['html_treemenu'][0][0]->html_treemenu(array('id' => '__leftmenu','class' => 'filetree'), $this);?>
</td>
							                <td class="right-bg" width="1">&nbsp;</td>
							            </tr>
							            <tr>
								             <td height="11" colspan="4"><div align="center"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/line2.gif" width="148" height="12" /></div></td>
								        </tr>
							        </table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-buttom.gif"></td></tr>
			</table>
        </td>
        <td></td>
    </tr>
 <?php if ($this->_tpl_vars['_profile']->lookup_code == 'AM'): ?>
    <tr>
		<td></td>
        <td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-top.gif"></td></tr>
				<tr>
					<td align="center" valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-center.gif">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic.png" width="100%">
							        <table width="100%" border="0" cellpadding="0" cellspacing="0">
							            <tr background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic.png" width="100%">
							                <td align="left" width="7"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic-left.png"></td>
							                <!-- <td align="left" width="50"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/ser.png"></td> -->
							                <td width="100" style="color:#FFFFFF;font-size:14px;font-weight:bold;">&nbsp;<?php echo $this->_tpl_vars['_monthPIOp'][$this->_tpl_vars['curMonth']]; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['yearOpt'][$this->_tpl_vars['curYear']]; ?>
</td>
							                <td align="right"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic-right.png"></td>
							            </tr>
							        </table>
								</td>
							</tr>
							<tr>
								<td>
							        <table width="100%" cellspacing="0" cellpadding="0" border="0">
							            <tr>
							                <td class="left-bg" width="1">&nbsp;</td>
							                
							                
							                <td class="right-bg" width="1">&nbsp;</td>
							            </tr>
							            <tr>
								             <!-- <td height="11" colspan="4"><div align="center"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/line2.gif" width="148" height="12" /></div></td> -->
								             <td height="11" colspan="4"><div align="center">
								             <table width="90%" cellspacing="0" cellpadding="0" border="0">
								             
								             <?php if ($this->_tpl_vars['badge']['final'] || $this->_tpl_vars['badge']['unfinal']): ?>
							            	<tr class="sum">
							            		<td align="center" class="final">
							            			Final = <?php echo $this->_tpl_vars['badge']['final']; ?>

												</td>
												<td width="20px"></td>
												<td align="center" class="proceed">
													Proceed = <?php echo $this->_tpl_vars['badge']['unfinal']; ?>

							            		</td>
							            	</tr>
							            	<?php else: ?>
							            	<tr>
							            		<td align="center">
							            		The process has not started
							            		</td>
							            	</tr>
							            	<?php endif; ?>
								             </table>
								             
								             </div></td>
								        </tr>
								        
							        </table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-buttom.gif"></td></tr>
			</table>
        </td>
        <td></td>
    </tr>
<?php endif; ?>
<!-- Box menu Service -->
    <!--tr>
    	<td></td>
        <td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-top.gif"></td></tr>
				<tr>
					<td align="center" valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-center.gif" bgcolor="#000000">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic.png" width="100%">
							        <table width="100%" border="0" cellpadding="0" cellspacing="0">
							            <tr background="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic.png" width="100%">
							                <td align="left" width="7"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic-left.png"></td>
							                <td align="left" width="50"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/ser.png"></td>
							                <td width="100" style="color:#FFFFFF;font-size:14px;font-weight:bold;">Service</td>
							                <td align="right"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-topic-right.png"></td>
							            </tr>
							        </table>
								</td>
							</tr>
							<tr>
								<td>
							        <table width="100%" cellspacing="0" cellpadding="0" border="0">
							            <tr>
							                <td class="left-bg" width="1">&nbsp;</td>
							                <td></td>
							                <td class="right-bg" width="1">&nbsp;</td>
							            </tr>
							        </table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/bg-buttom.gif"></td></tr>
			</table>
        </td>
        <td></td>
    </tr-->
</table>
</div>
<div id="left-menu-container-open" style="display: none;border: 1px solid #b9b9b9;background-color:#f1f1f1;"><span id="toggle-left-menu-open" src="<?php echo $this->_tpl_vars['g_image']; ?>
/arrow-right.gif" style="font-size: 10pt;">&nbsp;&raquo;&nbsp;</span></div>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('js' => ($this->_tpl_vars['g_js'])."/menu.js"), $this);?>


<textarea style="display:none" id="tmpFormText">
<form name="pifrm" action="/<?php echo $this->_tpl_vars['projectName']; ?>
/workflow/evaluate/pifrm" method="POST">
	<input type="hidden" name="user" value="<?php echo $this->_tpl_vars['_profile']->user_code; ?>
"/>
	<input type="hidden" name="status" value="W"/>
</form>
<form name="mifrm" action="/<?php echo $this->_tpl_vars['projectName']; ?>
/workflow/evaluate/mifrm" method="POST">
	<input type="hidden" name="user" value="<?php echo $this->_tpl_vars['_profile']->user_code; ?>
"/>
	<input type="hidden" name="status" value="O"/>
</form>
</textarea>

<script >
<?php echo '

function formSubmit(_frm)
{
	$(\'form[name=\'+ _frm + \']\').submit();
}

$(function() {
	var html= $(\'#tmpFormText\').text();
	$(document.body).append(html);
});

'; ?>

</script>

<style>
<?php echo '

.sum {
	color:white;
   	height:18px;
   	border-radius:10%;
   	box-shadow:0 0 1px #333;
   	margin: 10px;
}

'; ?>

</style>
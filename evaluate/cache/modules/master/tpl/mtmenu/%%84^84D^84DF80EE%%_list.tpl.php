<?php /* Smarty version 2.6.19, created on 2014-06-06 17:51:11
         compiled from C:%5CAppServ%5Cwww%5Ciceworkflow/modules/master%5Ctemplates/default/tpl//mtmenu/_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'C:\\AppServ\\www\\iceworkflow/modules/master\\templates/default/tpl//mtmenu/_list.tpl', 39, false),array('modifier', 'date_format', 'C:\\AppServ\\www\\iceworkflow/modules/master\\templates/default/tpl//mtmenu/_list.tpl', 43, false),)), $this); ?>
<div id="mst_list">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    		<tr>
    			<td bgcolor="#EBEBEB">
					<table width="100%">
    					<tr>
    						<td>
                            	<input id="btn_new" title="Create New" class="btn_tools" onclick="app.gotoview('/master/mtmenu/form/_m/new')" value="&nbsp;Create New" type="button">
                                <input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine();" value="&nbsp;Delete" type="button">

                            </td>
                            <td align="right">
                              	<input type="text" name="keyword" id="keyword" value="<?php echo $this->_tpl_vars['params']['keyword']; ?>
" >
			    				<input id="btn_search" title="Search" class="btn_tools" onclick="document.forms[0].submit();"  value=" Search" type="button">
                             </td>
						</tr>
					</table>
    			</td>
    		</tr>
	      <tr>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
			          <tr>
				    	<td colspan="2" align="center">
				    		<table cellpadding="0" cellspacing="0" width="100%" border="0"  >
				    			<tr bgcolor="#C6DCFF" height="25" align="right">
				    				<td class="font12b" align="center" width="3%"><input class="border0" type="checkbox" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font12b" align="center" width="8%">Code </td>
				    				<td class="font12b" align="center" width="15%"> Name </td>
				    				<td class="font12b" align="center" width="15%"> Last Update </td>
				    				<td class="font12b" align="center" width="15%"> Action </td>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['dataArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" id="tr_<?php echo $this->_tpl_vars['item']['lookup_code']; ?>
">
				    				<td align="center" class="font12"><input class="border0" type='checkbox' id="<?php echo $this->_tpl_vars['item']['lookup_code']; ?>
" value='<?php echo $this->_tpl_vars['item']['lookup_code']; ?>
'></td>
				    				<td align="center" class="font12" ><?php echo $this->_tpl_vars['item']['lookup_code']; ?>
</td>
				    				<td align="left" class="font12"><?php echo $this->_tpl_vars['item']['lookup_name']; ?>
</td>
				    				<td align="center" class="font12"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['lookup_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d-%m-%Y %H:%M:%S")); ?>
</td>
				    				<td align="center" class="font12" id="txt_link_user">
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="editmenu('<?php echo $this->_tpl_vars['item']['lookup_code']; ?>
');" value="&nbsp;Edit" type="button">
                                    	<input id="btn_view" title="View" class="btn_tools" onclick="viewmenu('<?php echo $this->_tpl_vars['item']['lookup_code']; ?>
');" value="&nbsp;View" type="button">
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
</div>
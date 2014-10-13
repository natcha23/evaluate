<?php /* Smarty version 2.6.19, created on 2014-08-21 16:33:40
         compiled from account/_salary.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'account/_salary.tpl', 48, false),array('function', 'html_pagination', 'account/_salary.tpl', 74, false),array('function', 'add_script', 'account/_salary.tpl', 89, false),array('modifier', 'number_format', 'account/_salary.tpl', 51, false),array('modifier', 'date_format', 'account/_salary.tpl', 53, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="mst_list">
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
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr height="25" >
					    			<td colspan="2" align="left" >
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="openSalary('','<?php echo $this->_tpl_vars['account']['user_code']; ?>
','new');" value= "Create New" type="button">
					    			</td>
					    			<td colspan="4" align="right">
					    				<input type="text" name="keyword" id="keyword" value="<?php echo $this->_tpl_vars['keyword']; ?>
" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#EBEBEB" height="25">
									<td colspan="6" align="left" class="font12b">
										&nbsp;<?php if ($this->_tpl_vars['account']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['account']['user_code']; ?>
<?php endif; ?> :: <?php echo $this->_tpl_vars['account']['user_name']; ?>
 &nbsp;[<?php echo $this->_tpl_vars['account']['org_position_name_th']; ?>
]
									</td>
								</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="4%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="10%"> วันที่เปลี่ยนแปลง </td>
				    				<td class="font11b" align="center" width="12%"> เงินเดือน </td>
				    				<td class="font11b" align="center" > หมายเหตุ </td>
				    				<td class="font11b" align="center" width="10%"> Time update </td>
				    				<td class="font11b" align="center" width="7%"> Action </td>
				    			</tr>
				    			<?php $this->assign('loopH', 1); ?>
				    			<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				    			<tr height="20" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBF5"), $this);?>
" id="tr_<?php echo $this->_tpl_vars['item']['sal_id']; ?>
">
				    				<td align="center" class="font11"><?php echo $this->_tpl_vars['loopH']; ?>
</td>
				    				<td align="center" class="font11" ><?php echo $this->_tpl_vars['item']['date_upsalary']; ?>
</td>
				    				<td align="right" class="font11" ><?php echo ((is_array($_tmp=$this->_tpl_vars['dataArr'][$this->_tpl_vars['key']][$this->_tpl_vars['item']['user_code']])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
&nbsp;</td>
				    				<td align="left" class="font11" >&nbsp;<?php echo $this->_tpl_vars['item']['note']; ?>
</td>
				    				<td align="center" class="font11"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['updatetime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
				    				<td align="center" class="font11" id="txt_link_user" nowrap>
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="openSalary('<?php echo $this->_tpl_vars['item']['sal_id']; ?>
','<?php echo $this->_tpl_vars['item']['user_code']; ?>
','edit');" value="  Edit" type="button">
				    				</td>
				    			</tr <?php echo $this->_tpl_vars['loopH']++; ?>
>
					    		<?php endforeach; endif; unset($_from); ?>
					    		<tr bgcolor="#EBEBEB">
									<td colspan="6" align="right" >
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/account/index');" value=" Back " type="button">
										&nbsp;
									</td>
								</tr>
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
</td>
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
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/account.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
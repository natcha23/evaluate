<?php /* Smarty version 2.6.19, created on 2014-09-02 15:59:59
         compiled from report/graph_department.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'report/graph_department.tpl', 27, false),array('function', 'add_script', 'report/graph_department.tpl', 82, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
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
				    			<tr bgcolor="#EBEBEB" height="25">
				    				<td class="font11" align="left" ><b>Month :</b>
				    					<select name="search[month]" id="month" class="selectBox10" >
				    					<option value="">-- Month --</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['monthOp'],'selected' => $this->_tpl_vars['month']), $this);?>

										</select>
										<select name="search[year]" id="year" class="selectBox7"  >
										<option value="">-- Year --</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yearOp'],'selected' => $this->_tpl_vars['year']), $this);?>

										</select>
										<b>Department :</b>
										<select name="search[group]" id="group" class="selectBox25" >
										<option value="">-- Show all --</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupBUOp'],'selected' => $this->_tpl_vars['group']), $this);?>

										</select>
										<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch1();">
				    				</td>
				    			</tr>
				    			<tr bgcolor="#cccccc" height="25">
					    			<td>
					    			</td>
				    			</tr>
				    			<?php if ($this->_tpl_vars['graph']): ?>
				    			<tr>
									<td width="100%" align="center"><?php echo $this->_tpl_vars['graph']; ?>
</td>
  								<tr>
  								<?php else: ?>
  								<tr>
									<td width="100%" height="30" class="font12b" align="center"><font color="red">Data Empty !!!!!!!!!!</font></td>
  								<tr>
  								<?php endif; ?>

							</table>
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
</table>
</form>
</div>
<?php echo $this->_tpl_vars['graphmap']; ?>

<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>